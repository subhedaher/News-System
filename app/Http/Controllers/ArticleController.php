<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Status_Articles;
use App\Models\User;
use App\Models\Writer;
use App\Notifications\StatusArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session('guard') === 'admin') {
            $articles = Article::with('writer')->paginate(10);
        } else {
            $articles = Article::where('writer_id', '=', auth()->user()->id)->paginate(10);
        }
        return view('cms.articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('cms.articles.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'category_id' => 'required|numeric|exists:categories,id',
            'slug' => 'required|string|unique:articles,slug',
            'title' => 'required|string|min:3|max:45',
            'short_info' => 'required|string|min:3',
            'info' => 'required|string',
            'image' => 'required|image|mimes:png,jpg',
        ]);

        if (!$validator->fails()) {
            $article = new Article();
            $article->category_id = $request->input('category_id');
            $article->slug = $request->input('slug');
            $article->title = $request->input('title');
            $article->short_info = $request->input('short_info');
            $article->info = $request->input('info');
            $image = $request->file('image');
            $imageName = $image->store('articles', ['disk' => 'public']);
            $article->image = $imageName;
            $article->writer_id  = $request->user()->id;
            $article->status  = 'wating';
            $saved = $article->save();
            if ($saved) {
                $status_article = new Status_Articles();
                $status_article->status = 'wating';
                $status_article->notes = 'Waiting for approval';
                $status_article->article_id = $article->id;
                $status_article->save();
            }
            return response()->json([
                'status' => $saved,
                'message' => $saved ? "Waiting for approval" : "Article Added Failed!"
            ], $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Article $article)
    {
        if (session('guard') === 'writer') {
            DB::table('notifications')->where('data->article_slug', '=', $article->slug)->update(['read_at' => now()]);
        }
        $status_article = Status_Articles::where('article_id', '=', $article->id)->orderBy('id', 'desc')->first();
        return view('cms.articles.show', ['article' => $article, 'notes' => $status_article->notes]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Category::all();

        return view('cms.articles.edit', ['article' => $article, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        if ($article->status === 'rejected') {
            $validator = Validator($request->all(), [
                'category_id' => 'required|numeric|exists:categories,id',
                'slug' => 'required|string|unique:articles,slug,' . $article->id,
                'title' => 'required|string|min:3|max:45',
                'short_info' => 'required|string|min:3',
                'info' => 'required|string',
                'image' => 'nullable|image|mimes:png,jpg',
            ]);

            if (!$validator->fails()) {
                $article->category_id = $request->input('category_id');
                $article->slug = $request->input('slug');
                $article->title = $request->input('title');
                $article->short_info = $request->input('short_info');
                $article->info = $request->input('info');
                if ($request->hasFile('image')) {
                    Storage::delete($article->image);
                    $image = $request->file('image');
                    $imageName = $image->store('articles', ['disk' => 'public']);
                    $article->image = $imageName;
                }
                $article->writer_id  = $request->user()->id;
                $article->status  = 'wating';
                $saved = $article->save();
                if ($saved) {
                    $status_article = new Status_Articles();
                    $status_article->status = 'wating';
                    $status_article->notes = 'Waiting for approval';
                    $status_article->article_id = $article->id;
                    $status_article->save();
                }
                return response()->json([
                    'status' => $saved,
                    'message' => $saved ? "Waiting for approval" : "Article Added Failed!"
                ], $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => $validator->getMessageBag()->first()
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' =>  'Can Not be Updated'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->status === 'rejected' || session('guard') == 'admin') {
            $countRowDeleted = Article::destroy($article->id);
            return response()->json([
                'status' => $countRowDeleted,
                'message' => $countRowDeleted ? "Article has been Moved to Trash Successfully" : "Article has been Moved to Trash Failed!"
            ], $countRowDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Can Not be Deleted'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function trash(Request $request)
    {
        $this->authorize('Trash-Articles', $request->user());
        $trashArticles = Article::onlyTrashed()->get();
        return view('cms.articles.trash', ['trashArticles' => $trashArticles]);
    }

    public function restore($id)
    {
        $this->authorize('restore', Article::onlyTrashed()->findOrFail($id));
        $article = Article::onlyTrashed()->find($id);
        $restored = $article->restore();
        return response()->json([
            'status' => $restored,
            'message' => $restored ? "Article Restore Successfully" : "Article Restore Failed!"
        ], $restored ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    public function forcedelete($id)
    {
        $this->authorize('forceDelete', Article::onlyTrashed()->findOrFail($id));
        $article = Article::onlyTrashed()->find($id);
        $forceDeleted = $article->forceDelete();
        if ($forceDeleted) {
            Storage::delete($article->image);
        }
        return response()->json([
            'status' => $forceDeleted,
            'message' => $forceDeleted ? "Article Deleted Successfully" : "Article Deleted Failed!"
        ], $forceDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    public function approved(Request $request, Article $article)
    {
        $article->status = 'approved';
        $article->date_publish = now();
        $saved = $article->save();
        if ($saved) {
            $status_article = new Status_Articles();
            $status_article->status = 'approved';
            $status_article->notes = 'has been published';
            $status_article->article_id = $article->id;
            $status_article->admin_id = $request->user()->id;
            $status_article->save();
            Notification::send(Writer::where('id', '=', $article->writer->id)->first(), new StatusArticle($article->slug, $status_article->admin->full_name, $status_article->notes, $article->title, $status_article->created_at));
        }
        return response()->json([
            'status' => $saved,
            'message' => $saved ? "Update Successfully" : "Update Failed!"
        ], $saved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    public function rejected(Request $request, Article $article)
    {
        $validator = validator($request->all(), [
            'rejectednotes' => 'required|string'
        ]);

        if (!$validator->fails()) {
            $article->status = 'rejected';
            $saved = $article->save();
            if ($saved) {
                $status_article = new Status_Articles();
                $status_article->status = 'rejected';
                $status_article->notes = $request->input('rejectednotes');
                $status_article->article_id = $article->id;
                $status_article->admin_id = $request->user()->id;
                $status_article->save();
                Notification::send(Writer::where('id', '=', $article->writer->id)->first(), new StatusArticle($article->slug, $status_article->admin->full_name, $status_article->notes, $article->title, $status_article->created_at));
            }
            return response()->json([
                'status' => $saved,
                'message' => $saved ? "Update Successfully" : "Update Failed!"
            ], $saved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function hardRejected(Request $request, Article $article)
    {
        $validator = validator($request->all(), [
            'hardRejectednotes' => 'required|string'
        ]);

        if (!$validator->fails()) {
            $article->status = 'hard rejected';
            $saved = $article->save();
            if ($saved) {
                $status_article = new Status_Articles();
                $status_article->status = 'hard rejected';
                $status_article->notes = $request->input('hardRejectednotes');
                $status_article->article_id = $article->id;
                $status_article->admin_id = $request->user()->id;
                $status_article->save();
                Notification::send(Writer::where('id', '=', $article->writer->id)->first(), new StatusArticle($article->slug, $status_article->admin->full_name, $status_article->notes, $article->title, $status_article->created_at));
            }
            return response()->json([
                'status' => $saved,
                'message' => $saved ? "Update Successfully" : "Update Failed!"
            ], $saved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function seeAll(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
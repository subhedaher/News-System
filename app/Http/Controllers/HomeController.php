<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    function index()
    {
        $categories = Category::all();

        $lastThreeNews = Article::where('status', '=', 'approved')
            ->take(3)
            ->orderBy('date_publish', 'desc')
            ->get();

        $lastThreeLocalNews = Article::where('status', '=', 'approved')->with('category')
            ->whereHas('category', function ($query) {
                $query->where('name', 'local news');
            })
            ->orderBy('date_publish', 'desc')
            ->take(3)
            ->get();

        $lastThreeSportNews = Article::where('status', '=', 'approved')->with('category')
            ->whereHas('category', function ($query) {
                $query->where('name', 'sport news');
            })
            ->orderBy('date_publish', 'desc')
            ->take(4)
            ->get();

        $lastThreeInternationalNews = Article::where('status', '=', 'approved')->with('category')
            ->whereHas('category', function ($query) {
                $query->where('name', 'international news');
            })
            ->orderBy('date_publish', 'desc')
            ->take(3)
            ->get();

        return view('index', [
            'lastThreeNews' => $lastThreeNews,
            'lastThreeLocalNews' => $lastThreeLocalNews,
            'lastThreeSportNews' => $lastThreeSportNews,
            'lastThreeInternationalNews' => $lastThreeInternationalNews,
            'categories' => $categories
        ]);
    }

    public function category(Request $request, Category $category)
    {
        $last4news = Article::where('category_id', '=', $category->id)->orderBy('date_publish', 'desc')->paginate(4);
        $categories = Category::all();
        return view('category', ['categories' => $categories, 'last4news' => $last4news]);
    }

    public function article(Request $request, Article $article)
    {
        $categories = Category::all();
        $article->views++;
        $article->save();
        $comments = Comment::where('article_id', '=', $article->id)->get();
        return view('article', ['categories' => $categories, 'article' => $article, 'comments' => $comments]);
    }

    public function comment(Request $request)
    {
        $validator = validator($request->all(), [
            'full_name' => 'required|string',
            'content' => 'required|string',
            'article_id' => 'required|numeric|exists:articles,id',
        ]);

        if (!$validator->fails()) {
            Comment::create([
                'full_name' => $request->input('full_name'),
                'content' => $request->input('content'),
                'article_id' => $request->input('article_id'),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Send Message Successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function getComments(Request $request)
    {
        $this->authorize('Read-Comments', $request->user());
        $comments = Comment::all();
        return view('cms.comments.index', ['comments' => $comments]);
    }

    public function deleteComment(Request $request, $id)
    {
        $this->authorize('Delete-Message');
        $countRows = Comment::destroy($id);
        return response()->json([
            'status' => $countRows,
            'message' => $countRows ? 'Deleted Comment Successfully' : 'Deleted Comment Failed!'
        ], $countRows ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}

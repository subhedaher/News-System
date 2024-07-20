<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Article;
use App\Models\Category;
use App\Models\Message;
use App\Models\Writer;

class IndexController extends Controller
{
    function index()
    {
        $countAdmins = Admin::count();
        $countWriters = Writer::count();
        $countCategories = Category::count();
        $countArticles = Article::where('status', '=', 'approved')->count();
        $totalArticles = Article::count();
        $countArticlesWriter = Article::where('status', '=', 'approved')->Where('writer_id', '=', auth()->user()->id)->count();
        return view('cms.home', [
            'countAdmins' => $countAdmins,
            'countWriters' => $countWriters,
            'countCategories' => $countCategories,
            'countArticles' => $countArticles,
            'totalArticles' => $totalArticles,
            'countArticlesWriter' => $countArticlesWriter,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use mysql_xdevapi\Collection;
use function PHPUnit\TestFixture\func;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query();
        $articles->when(request('q'), function($q) {
            $q->where('title', 'like', '%'.request('q').'%' );
        });
        $articles->when(request('category'), function($q) {
            $q->where('section', request('category'));
        });
        $articles->when(request('source'), function($q) {
            $q->where('source', request('source'));
        });
        $articles->when(request('fromDate'), function($q) {
            $q->whereDate('published_at', '>=' , request('fromDate'));
        });
        $articles->when(request('toDate'), function($q) {
            $q->whereDate('published_at', '<=' , request('toDate'));
        });
        $articles = $articles->get();

        return ArticleResource::collection($articles);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function retrieve(Request $request)
    {
        $article  = Article::with('author')->paginate(10);
        return $article;
    }

    public function retrieveById($id)
    {
        $article  = Article::where('id', $id)->FirstOrFail();
        return $article;
    }

    public function create(Request $request)
    {
        $article  = new Article();
        $article->title = $request->title;
        $article->text = $request->text;
        $article->author_id = $request->author_id;
        $article -> save();
        return Article::where('id', $article->id)->with('author')->FirstOrFail();
    }

    public function update($id ,Request $request)
    {
        $article  = Article::where('id', $id)->with('author')->FirstOrFail();
        $article->title = $request->title;
        $article->text = $request->text;
        $article->author_id = $request->author_id;
        $article->save();
        return $article;
    }

    public function delete($id)
    {
        $article  = Article::where('id',$id)->delete();
        return response(200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorController extends Controller
{
    public function retrieve(Request $request)
    {
        $authors  = Author::paginate(10);
        return $authors;
    }

    public function retrieveById($id)
    {
        $author  = Author::where('id', $id)->FirstOrFail();
        return $author;
    }

    public function create(Request $request)
    {
        $author = new Author();
        $author->name = $request->name;
        $author->save();
        return $author;
    }

    public function update($id ,Request $request)
    {
        $author  = Author::where('id', $id)->FirstOrFail();
        $author->name = $request->name;
        $author->save();
        return $author;
    }

    public function delete($id)
    {
        $author  = Author::where('id',$id)->delete();
        return response(200);
    }
}

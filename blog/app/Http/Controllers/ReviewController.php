<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class ReviewController extends Controller
{
    public function retrieve(Request $request)
    {
        $reviews  = Review::paginate(10);
        return $reviews;
    }

    public function retrieveById($id)
    {
        $review  = Review::where('id', $id)->FirstOrFail();
        return $review;
    }

    public function create(Request $request)
    {
        $review = new Review();
        $review->name = $request->name;
        $review->save();
        return $review;
    }

    public function update($id ,Request $request)
    {
        $review  = Review::where('id', $id)->FirstOrFail();
        $review->name = $request->name;
        $review->save();
        return $review;
    }

    public function delete($id)
    {
        $review  = Review::where('id',$id)->delete();
        return response(200);
    }
}

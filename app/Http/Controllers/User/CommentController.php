<?php

namespace App\Http\Controllers\User;

use App\Models\Blog;
use App\Models\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CreateRequest;

class CommentController extends Controller
{
  
    public function store(CreateRequest $request){

        $blogs=Comments::create($request->validated());
        return redirect()->route('blog.index')->with('success', 'Comment created successfully!');
    }

    public function show($id){

        $blog= Blog::with('comments.replies')->where('id',$id)->first(); 
         return view('blog.show', compact('blog'));

    }


    public function update(Request $request, $id){
    
        $blog = Comments::where('id',$id)->update(['content'=>$request->content]);
        return redirect()->route('blog.index')->with('success', 'Comment Updated successfully!');

    }
    public function destroy(Comments $comment)
    {
    
        $comment->delete(); 
        return response()->json(['message' => 'Comment deleted successfully.']);
      
    }


    
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Interfaces\BlogInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\BlogCreateRequest;
use App\Http\Requests\Blog\BlogUpdateRequest;

class BlogController extends Controller
{
    public $action;
    
    public function index(){

        $blogs=Blog::get();
        
       return view('blog.index', compact('blogs'));
    }

    public function create(){

        return view('blog.create');
    
    }

    public function store(BlogCreateRequest $request){
    
        $data=$request->validated();
        $data['image']=$request->image->store('images', 'public'); 
        Blog::create($data);
        return redirect()->route('blog.index')->with('success', 'Blog created successfully!');
    }

    public function edit($id){
        
        $blog = Blog::findOrFail($id);
        return view('blog.edit', compact('blog')); 

    }

    public function update(BlogUpdateRequest $request, $id){
       
        $data=$request->validated();
        $blog = Blog::where('id',$id)->first();

        if ($request->hasFile('image'))
            $data['image'] = $request->image->store('images', 'public');
        
        $blog->update($data);
        return redirect()->route('blog.index')->with('success', 'Blog updated successfully!');

    }

    public function destroy(Blog $blog){
     
        $blog->delete();
        return response()->json(['message' => 'blog deleted successfully.']);
        
    }
    
}

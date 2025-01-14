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
    
    // public function __construct(BlogInterface $action){

    //    $this->action=$action;

    // }

    public function index(){

        $blogs=Blog::get();
        
       return view('blog.index', compact('blogs'));
    }

    public function create(){
        return view('blog.create');
    }

    public function store(BlogCreateRequest $request){

        $blogs=Blog::create($request->validated());
        return redirect()->route('blog.index')->with('success', 'Blog created successfully!');
    }

    public function edit($id){
        
        $blog = Blog::findOrFail($id);
        return view('blog.edit', compact('blog')); 

    }

    public function update(BlogUpdateRequest $request, $id){

        $blog = Blog::where('id',$id)->update($request->validated());
        return redirect()->route('blog.index')->with('success', 'Blog updated successfully!');

    }

    public function delete(Request $request){
     
        $deleted = Blog::where('id', $request->id)->delete();
        return response()->json(['success' => 'Blog deleted successfully.'], 200);
        
    }
    
}

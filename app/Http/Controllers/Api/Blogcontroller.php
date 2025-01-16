<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Blog\BlogCollection;

class Blogcontroller extends Controller
{
    public function index(){

        return new BlogCollection(Blog::get());
   
    }
}

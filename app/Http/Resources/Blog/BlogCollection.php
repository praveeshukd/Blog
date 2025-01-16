<?php

namespace App\Http\Resources\Blog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BlogCollection extends ResourceCollection
{

    public function toArray(Request $request): array
    {
        return [
            'status' => 'success',
            'message'=>'Blog List',
            'data' => $this->collection->toArray()
        ];
      
    }
}

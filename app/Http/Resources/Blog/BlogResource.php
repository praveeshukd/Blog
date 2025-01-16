<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return[

            'id'        => $this->id,
            'post_title'=> $this->name,
            'author'    => $this->author,
            'content'   => $this->content,
            'image'     => $this->image,
            'date'      => $this->created_at
            
         ];
    }
}

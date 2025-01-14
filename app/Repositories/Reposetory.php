<?php

namespace App\Repositories;

class  Reposetory
{
    public function index(){
        $this->model::get();
    }

    public function find(){
        $this->model::where('id',$id)->first();
    }

    public function store(){

    }

    public function update(){
        
    }
}

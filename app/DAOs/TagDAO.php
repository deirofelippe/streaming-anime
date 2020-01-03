<?php

namespace App\DAOs;

use App\Models\Anime\Tag;

class TagDAO {

    public function add($name){
        return Tag::create(['nome' => $name]);
    }

    public function findAll(){}

    public function findById(){}

    public function update(){}

    public function delete(){}

    public function findByName($name){
        return Tag::where('nome', $name)->first();
    }
}

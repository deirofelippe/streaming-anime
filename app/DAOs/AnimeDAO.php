<?php

namespace App\DAOs;

use App\Models\Anime\Anime;

class AnimeDAO {

    public function add($data){
        return Anime::create($data);
    }

    public function findAll(){
        return Anime::all();
    }

    public function findByName($name){
        $name = "%{$name}%";
        return Anime::where('nome', 'like', $name)->get();
    }

    public function update($data){}

    public function delete($id){}

    public function findById($id){
        return Anime::where('id', $id)->first();
    }

    public function uploadThumbnail($request, $caminho, $nomeArquivo){
        return $request->thumbnail->storeAs($caminho, $nomeArquivo,'public');
    }
}

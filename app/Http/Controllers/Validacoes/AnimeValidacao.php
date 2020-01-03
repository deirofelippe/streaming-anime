<?php

namespace App\Http\Controllers\Validacoes;

use App\Http\Controllers\Validacoes\InterfaceValidacao;
use App\DAOs\AnimeDAO;
use Illuminate\Support\Facades\Validator;

class AnimeValidacao implements InterfaceValidacao {
    public function validar($request){
        $validator = $this->gerarInstanciaDoValidator($request);

        if($request->status == -1){
            $validator->errors()->add('status','Selecione o status');
        }

        if(strlen($request->ano_lancamento) != 4){
            $validator->errors()->add('ano_lancamento', 'O campo deve conter 4 números');
        }

        $nome = $request->nome;
        if(!is_null($nome)){
            $repository = new AnimeDAO();
            $animeExiste = $repository->findByName($nome);
            if(!is_null($animeExiste)){
                $validator->errors()->add('nome','Anime com este nome já foi criado');
            }
        }

        return $validator;
    }

    public function gerarInstanciaDoValidator($request){
        $regras = [
            'nome'=>'required',
            'descricao'=>'required',
            'estudio'=>'required',
            'ano_lancamento'=>'required|integer',
            'thumbnail'=>'file|image|nullable'
        ];
        $mensagens = [
            'required'=>'Este campo precisa ser preenchido',
            'integer'=>'O campo deve conter apenas números',
            'file'=>'O arquivo falhou, envie de novo',
            'image'=>'O arquivo deve ser uma imagem/gif'
        ];
        return Validator::make($request->all(), $regras, $mensagens);
    }
}

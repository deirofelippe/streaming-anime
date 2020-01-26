<?php

namespace App\Http\Controllers\Validacoes;

use App\Http\Controllers\Validacoes\InterfaceValidacao;
use App\DAOs\AnimeDAO;
use Illuminate\Support\Facades\Validator;

class AnimeValidacao implements InterfaceValidacao {
    public function validar($request){
        $validator = $this->gerarInstanciaDoValidator($request);

        if($validator->fails()){
            return $validator;
        }

        return null;
    }

    public function gerarInstanciaDoValidator($request){
        $regras = [
            'nome'=>[
                'required',
                function($attribute, $value, $fail){
                    $repository = new AnimeDAO();
                    $animeExiste = $repository->findByName($value);
                    if(sizeof($animeExiste) != 0){
                        $fail("O anime '{$value}' já existe");
                    }
                }
            ],
            'sinopse'=>'required',
            'estudio'=>'required',
            'ano_lancamento'=> [
                'required',
                'integer',
                function($attribute, $value, $fail){
                    if(strlen($value) != 4){
                        $fail('O campo deve conter 4 números');
                    }
                }
            ],
            'thumbnail'=>'file|image|nullable',
            'status'=>
                function($attribute, $value, $fail){
                    if($value == -1){
                        $fail('Selecione algum status');
                    }
                }
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

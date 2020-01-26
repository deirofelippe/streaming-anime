<?php

namespace App\Http\Controllers\Validacoes;

use App\DAOs\EpisodioDAO;
use App\Http\Controllers\Validacoes\InterfaceValidacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EpisodioValidacao implements InterfaceValidacao {
    public function validar(Request $request){
        $validator = $this->gerarInstanciaDoValidator($request);

        if($validator->fails()){
            return $validator;
        }

        return null;
    }

    public function gerarInstanciaDoValidator(Request $request){
        $regras = [
            'titulo'=>'required',
            'num_episodio'=>['required','integer','min:1',
            function($attribute, $value, $fail) use ($request){
                $dao = new EpisodioDAO();

                $animeId = $request->anime_id;
                $temporada = $request->num_temporada;
                $episodio = $request->num_episodio;

                $numeroEhTemporadaExiste = $dao->findByNumeroEpisodio($animeId, $temporada, $episodio);
                if(!is_null($numeroEhTemporadaExiste)){
                    $fail("O episódio {$episodio} da temporada {$temporada} já existe");
                }
            }
        ],
            'num_temporada'=>'required|integer|min:1',
            'video'=>'required|file',
            'thumbnail'=>'nullable|file|image'
        ];
        $mensagens = [
            'required'=>'Este campo precisa ser preenchido',
            'video.required'=>'É preciso enviar um arquivo',
            'integer'=>'O campo deve conter apenas números',
            'min'=>'O valor deve ser no mínimo :min',
            'image'=>'O arquivo deve ser uma imagem/gif',
            'file'=>'O arquivo falhou, envie de novo'
        ];
        return Validator::make($request->all(), $regras, $mensagens);
    }
}

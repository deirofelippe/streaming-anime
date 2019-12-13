<?php

namespace App\Http\Controllers;

use App\Models\EmbedVideo;
use App\Models\Episodio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmbedController extends Controller
{
    public function list($idEpisodio){
        $episodio = Episodio::find($idEpisodio);
        return view('anime.embed-list')->with('episodio', $episodio);
    }

    public function form($idEpisodio){
        $episodio = Episodio::find($idEpisodio);
        return view('anime.embed-form')->with('episodio', $episodio);
    }

    public function add(Request $request){
        $request->validate([
            'nome'=>'required',
            'codigo_embed'=>'required'
        ]);

        $idEpisodio = $request->episodio_id;
        $nome = $request->nome;
        $resolucao = $request->resolucao;
        $sub_dub = $request->sub_dub;
        $codigo = $request->codigo_embed;

        if($resolucao == 0 || $sub_dub == 0){
            return redirect()->action('EmbedController@form', ['id' => $idEpisodio]);
        }

        $embed = DB::table('embed_videos')->where([
            ['nome', $nome],
            ['resolucao', $resolucao],
            ['sub_dub', $sub_dub]
        ])->first();

        if(!is_null($embed)){
            return redirect()->action('EmbedController@form', ['id' => $idEpisodio]);
        }

        $data = [
            'nome'=> $nome,
            'codigo_embed'=> $codigo,
            'resolucao'=> $resolucao,
            'sub_dub'=> $sub_dub,
            'episodio_id'=> $idEpisodio
        ];

        $embedVideo = EmbedVideo::create($data);

        return redirect()->action('EmbedController@list', ['id' => $idEpisodio]);
    }

    public function show($id){
    }

    public function edit($id){
    }

    public function update(Request $request, $id){
    }

    public function destroy($id){
    }
}

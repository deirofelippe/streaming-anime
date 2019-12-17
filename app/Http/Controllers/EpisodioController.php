<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Episodio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EpisodioController extends Controller{

    public function list($id){
        return view('anime.episodio-list')->with('anime', Anime::find($id));
    }

    public function form($id){
        return view('anime.episodio-form')->with('anime', Anime::find($id));
    }

    public function add(Request $request){
        $request->validate([
            'titulo'=>['required']
        ]);

        $episodio = $this->criarEpisodio($request);
        if(is_null($episodio)){
            return redirect()->action('EpisodioController@list', ['id' => $request->anime_id])->with('error','Dados invalidos ou ja foi criado');
        }

        $id = $episodio->anime_id;

        return redirect()->action('AnimeController@list', ['id' => $id]);
    }

    private function criarEpisodio($request){
        $titulo = $request->titulo;

        $episodioExiste = DB::table('episodios')->where('titulo', $titulo)->first();

        if(!is_null($episodioExiste)){
            return null;
        }

        $num_episodio = $request->num_episodio;
        $num_temporada = $request->num_temporada;

        $numeroEhTemporadaExiste = DB::table('episodios')->where([
            ['num_episodio', $num_episodio],
            ['num_temporada', $num_temporada]
        ])->first();

        if(!is_null($numeroEhTemporadaExiste)){
            return null;
        }

        $nomeGerado = uniqid(date('HisYmd'));
        $thumbnail = $this->uploadThumbnail($request, $nomeGerado);
        $video = $this->uploadVideo($request, $nomeGerado);

        $data = [
            'anime_id' => $request->anime_id,
            'thumbnail' => $thumbnail,
            'titulo' => $titulo,
            'num_episodio' => $num_episodio,
            'num_temporada' => $num_temporada,
            'video' => $video
        ];

        $episodio = Episodio::create($data);
        return Episodio::find($episodio->id);
    }

    private function uploadVideo($request, $nome){
        $valido = $request->file('thumbnail')->isValid();
        $existe = $request->hasFile('thumbnail');
        if(!$valido || !$existe){
            return null;
        }

        $extensao = $request->video->extension();
        $nomeArquivo = "{$nome}.{$extensao}";
        $caminho = 'video';
        $upload = $request->video->storeAs($caminho, $nomeArquivo, 'public');

        if(!$upload){
            return null;
        }

        return $nomeArquivo;
    }

    private function uploadThumbnail($request, $nome){
        $valido = $request->file('thumbnail')->isValid();
        $existe = $request->hasFile('thumbnail');
        if(!$valido || !$existe){
            return null;
        }

        $extensao = $request->thumbnail->extension();
        $nomeArquivo = "{$nome}.{$extensao}";
        $caminho = 'thumbnail/episodio';
        $upload = $request->thumbnail->storeAs($caminho, $nomeArquivo, 'public');

        if(!$upload){
            return null;
        }
        return $nomeArquivo;
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

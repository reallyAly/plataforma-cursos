<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\VideoUsuario;
use App\Models\InfoVideo;

class VideoUsuarioController extends Controller
{
    public function adicionarVideo(Request $request)
    {

        $videoUsuario = new VideoUsuario(); 
        $InfoVideo = InfoVideo::where(["id_video" => $request->id_video])->get()->first();

        $videoUsuario->id_curso = $InfoVideo->id_curso;
        $videoUsuario->id_video = $request->id_video;
        $videoUsuario->id_usuario = $request->id_usuario;

        try{
            $videoUsuario->save();
        }catch(\Exception $e){
            return response()->json([
                "message" => "Erro ao adicionar video: {$e->getMessage()}",
                "code" => intval($e->getCode()),
                "success" => false
            ], 500);
        }

        return response()->json([
            "message" => "O video foi adicionado com sucesso",
            "code" => 201,
            "success" => true
        ], 201);

    }
}

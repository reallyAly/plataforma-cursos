<?php

namespace App\Http\Controllers\Api;

use App\Models\Cursos;
use Illuminate\Http\Request;
use App\Models\InfoVideo;
use Illuminate\Routing\Controller;

class InfoVideoController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllVideosDoCurso($id_curso)
    {
        $videosCollection = InfoVideo::where(['id_curso' => $id_curso])->get();
        return response()->json($videosCollection->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function salvar(Request $request)
    {
        $novoVideo = new InfoVideo();

        $novoVideo->nome_video = $request->nome_video;
        $novoVideo->url_video = $request->url_video;
        $novoVideo->id_curso = $request->id_curso;
        $novoVideo->id_etapa = $request->id_etapa;

        try{
            $novoVideo->save();
        }catch(\Exception $e){
            return response()->json([
                "message" => "Erro ao salvar video: {$e->getMessage()}",
                "code" => intval($e->getCode()),
                "success" => false
            ], 500);
        }

        return response()->json([
            "message" => "O video foi salvo com sucesso",
            "code" => 201,
            "success" => true
        ], 201);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletar(Request $request)
    {
        try{
            InfoVideo::where(['id_video' => $request->id_video])->first()->delete();
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage(),
                'code' => $e->getCode(),
                'success' => false
            ]);
        }

        return response()->json([
            "message" => 'Vídeo deletado com sucesso',
            "code" => 201,
            "success" => true
        ]);
    }

    /**
     * @param Request $request
     */
    public function atualizar(Request $request)
    {
        try{

            $video = InfoVideo::where("id_video", $request->id_video)->first();

            if(empty($video)){
                return response()->json([
                    "message" => 'Video não encontrado',
                    'code' => 404,
                    'success' => false
                ]);
            }

            $video->nome_video = $request->nome_curso;
            $video->url_video = $request->url_video;
            $video->id_curso = $video->id_curso;
            $video->id_etapa = $request->id_etapa;

            $video->save();
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage(),
                'code' => $e->getCode(),
                'success' => false
            ]);
        }

        return response()->json([
            "message" => 'O video foi atualizado com sucesso',
            "code" => 201,
            "success" => true
        ]);
    }

    /**
     * @param $email
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVideo($id_video)
    {
        try{
            $response = response()->json(InfoVideo::where(['id_video' => $id_video])->first());

            if(!empty($response)){
                return $response;
            }
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage(),
                'code' => $e->getCode(),
                'success' => false
            ]);
        }

        return response()->json([
            "message" => 'Vídeo não encontrado',
            'code' => 0,
            'success' => false
        ]);
    }
}

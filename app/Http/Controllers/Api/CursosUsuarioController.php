<?php

namespace App\Http\Controllers\Api;

use App\Models\CursosUsuario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class CursosUsuarioController
 * @package App\Http\Controllers\Api
 */
class CursosUsuarioController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCursosDoUsuario(Request $request)
    {
        return response()->json(CursosUsuario::where(['id_usuario', $request->id_usuario])->get());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function atualizarProgresso(Request $request)
    {
        $cursoUsuario = CursosUsuario::where([
            'id_curso' => $request->id_curso,
            'id_usuario' => $request->id_usuario
        ])->first();

        $cursoUsuario->id_video = $request->id_video;
        $cursoUsuario->id_curso = $cursoUsuario->id_curso;
        $cursoUsuario->id_usuario = $cursoUsuario->id_usuario;

        try{
            $cursoUsuario->save();
        }catch(\Exception $e){
            return response()->json([
                "message" => "Erro ao atualizar progresso: {$e->getMessage()}",
                "code" => intval($e->getCode()),
                "success" => false
            ], 500);
        }

        return response()->json([
            "message" => "O progresso foi atualizado com sucesso",
            "code" => 201,
            "success" => true
        ], 201);

    }

    /**
     * @param $idCurso
     * @param $IdUsuario
     * @return \Illuminate\Http\JsonResponse
     */
    public function salvar($idCurso, $IdUsuario)
    {
        $novoCursoUsuario = new CursosUsuario();

        $novoCursoUsuario->id_curso = $idCurso;
        $novoCursoUsuario->id_usuario = $IdUsuario;
        $novoCursoUsuario->id_video = 0;

        try{
            $novoCursoUsuario->save();
        }catch(\Exception $e){
            return response()->json([
                "message" => "Erro ao salvar curso para usuário: {$e->getMessage()}",
                "code" => intval($e->getCode()),
                "success" => false
            ], 500);
        }

        return response()->json([
            "message" => "O curso para o usuário foi salvo com sucesso",
            "code" => 201,
            "success" => true
        ], 201);
    }
}

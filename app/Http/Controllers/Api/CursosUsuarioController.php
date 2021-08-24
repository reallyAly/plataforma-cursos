<?php

namespace App\Http\Controllers\Api;

use App\Models\CursosUsuario;
use Illuminate\Routing\Controller;
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
    public function getAllCursosDoUsuario($id_usuario)
    {
        $cursos = CursosUsuario::where(['id_usuario' => $id_usuario])->get();
        $ids = [];

        foreach($cursos as $curso){
            array_push($ids, $curso['id_curso']);
        }

        return response()->json($ids);
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

<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCursos()
    {
        $cursosCollection = Cursos::all();
        return response()->json($cursosCollection->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function salvar(Request $request)
    {
        $novoCurso = new Cursos();

        $novoCurso->nome_curso = $request->nome_curso;
        $novoCurso->preco_curso = $request->preco_curso;
        $novoCurso->periodo_curso = $request->periodo_curso;
        $novoCurso->descricao_curso = $request->descricao_curso;

        try{
            $novoCurso->save();
        }catch(\Exception $e){
            return response()->json([
                "message" => "Erro ao salvar curso: {$e->getMessage()}",
                "code" => intval($e->getCode()),
                "success" => false
            ], 500);
        }

        return response()->json([
            "message" => "O curso foi salvo com sucesso",
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
            Cursos::where(['id_curso' => $request->id_curso])->first()->delete();
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage(),
                'code' => $e->getCode(),
                'success' => false
            ]);
        }

        return response()->json([
            "message" => 'Curso deletado com sucesso',
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

            $curso = Cursos::where("id_curso", $request->id_curso)->first();

            if(empty($usuario)){
                return response()->json([
                    "message" => 'Curso não encontrado',
                    'code' => 404,
                    'success' => false
                ]);
            }

            $curso->nome_curso = $request->nome_curso;
            $curso->preco_curso = $request->preco_curso;
            $curso->periodo_curso = $request->periodo_curso;
            $curso->descricao_curso = $request->descricao_curso;

            $curso->save();
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage(),
                'code' => $e->getCode(),
                'success' => false
            ]);
        }

        return response()->json([
            "message" => 'O usuário foi atualizado com sucesso',
            "code" => 201,
            "success" => true
        ]);
    }

    /**
     * @param $email
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCurso($id)
    {
        try{
            return response()->json(Cursos::where(['id_curso' => $id])->first());
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage(),
                'code' => $e->getCode(),
                'success' => false
            ]);
        }

        return response()->json(array());
    }
}

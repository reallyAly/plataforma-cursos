<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Etapas;

class EtapasController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllEtapasDoCurso($id_curso)
    {
        $etapasCollection = Etapas::where(['id_curso' => $id_curso])->get();
        return response()->json($etapasCollection->toArray());
    }

     /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllNomesEtapasDoCurso($id_curso)
    {
        $etapasArray = Etapas::where(['id_curso' => $id_curso])->get()->toArray();
        $nomes = [];

        foreach($etapasArray as $etapa){
            array_push($nomes,$etapa['nome_etapa']);
        }

        return response()->json($nomes);
    }

    public function salvar(Request $request){
        $novaEtapa = new Etapas();

        try{

            $novaEtapa->nome_etapa = $request->nome_etapa;
            $novaEtapa->id_curso = $request->id_curso;
            $novaEtapa->save();

        }catch(\Exception $e){
            return response()->json([
                "message" => "Erro ao registrar etapa: {$e->getMessage()}",
                "code" => intval($e->getCode()),
                "success" => false
            ], 500);
        }
        
        return response()->json([
            "message" => "A etapa foi registrada com sucesso!",
            "code" => 201,
            "success" => true
        ], 201);
    }

    public function atualizar(Request $request){
        $etapa = Etapas::where(['id_etapa' => $request->id_etapa])->first();

        try{
            $etapa->nome_etapa = $request->nome_etapa;
            $etapa->save();
        }catch(\Exception $e){
            return response()->json([
                "message" => "Erro ao atualizar etapa: {$e->getMessage()}",
                "code" => intval($e->getCode()),
                "success" => false
            ], 500);
        }
        
        return response()->json([
            "message" => "A etapa foi atualizada com sucesso!",
            "code" => 201,
            "success" => true
        ], 201);
    }

    public function deletar(Request $request)
    {
        try{
            Etapas::where(['id_etapa' => $request->id_etapa])->first()->delete();
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage(),
                'code' => $e->getCode(),
                'success' => false
            ]);
        }

        return response()->json([
            "message" => 'Etapa deletada com sucesso',
            "code" => 201,
            "success" => true
        ]);
    }

}

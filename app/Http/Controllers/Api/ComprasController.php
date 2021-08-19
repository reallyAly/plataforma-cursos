<?php

namespace App\Http\Controllers\Api;

use App\Models\Compras;
use App\Models\Cursos;
use Illuminate\Http\Request;

class ComprasController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCompras()
    {
        $comprasCollection = Compras::all();
        return response()->json($comprasCollection->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function salvar(Request $request)
    {
        $novaCompra = new Compras();
        $curso = Cursos::find($request->id_curso);

        $novaCompra->id_usuario = $request->id_usuario;
        $novaCompra->id_curso = $request->id_curso;
        $novaCompra->tipo_compra = $request->tipo_compra;
        $novaCompra->valor_compra = $curso->preco_curso;
        $novaCompra->data_compra = date('Y-m-d');
        $novaCompra->hashboleto_compra = '0000001';

        try{
            $novaCompra->save();
        }catch(\Exception $e){
            return response()->json([
                "message" => "Erro ao salvar compra: {$e->getMessage()}",
                "code" => intval($e->getCode()),
                "success" => false
            ], 500);
        }

        return response()->json([
            "message" => "A compra foi salva com sucesso",
            "code" => 201,
            "success" => true
        ], 201);

    }

    /**
     * @param $email
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCompra($id)
    {
        try{
            return response()->json(Compras::where(['id_compras' => $id])->first());
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

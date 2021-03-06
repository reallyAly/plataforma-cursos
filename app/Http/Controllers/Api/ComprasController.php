<?php

namespace App\Http\Controllers\Api;

use App\Models\Compras;
use App\Models\Cursos;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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

        $size = 13;
        $seed = time();

        $novaCompra->id_usuario = $request->id_usuario;
        $novaCompra->id_curso = $request->id_curso;
        $novaCompra->tipo_compra = $request->tipo_compra;
        $novaCompra->valor_compra = $curso->preco_curso;
        $novaCompra->data_compra = date('Y-m-d');
        $novaCompra->hashboleto_compra = substr(sha1($seed), 40 - min($size,40));

        $novaCompra->rua_endereco = $request->rua_endereco;
        $novaCompra->numero_endereco = $request->numero_endereco;
        $novaCompra->complemento_endereco = $request->complemento_endereco;
        $novaCompra->bairro_endereco = $request->bairro_endereco;
        $novaCompra->estado_endereco = $request->estado_endereco;
        $novaCompra->cidade_endereco = $request->cidade_endereco;
        $novaCompra->cep_endereco = $request->cep_endereco;

        try{
            $novaCompra->save();
            $controller = new CursosUsuarioController();
            $var = $controller->salvar($request->id_curso, $request->id_usuario);
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
    public function getCompra($id_compra)
    {
        try{
            return response()->json(Compras::where(['id_compras' => $id_compra])->first());
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

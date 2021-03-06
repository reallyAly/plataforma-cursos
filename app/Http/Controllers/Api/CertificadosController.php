<?php

namespace App\Http\Controllers\Api;

use App\Models\Certificados;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CertificadosController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCertificados()
    {
        $cursosCollection = Certificados::all();
        return response()->json($cursosCollection->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function salvar(Request $request)
    {
        $novoCertificado= new Certificados();

        $size = 10;
        $seed = time();

        $novoCertificado->hash_certificado = substr(sha1($seed), 40 - min($size,40));
        $novoCertificado->id_usuario = $request->id_usuario;
        $novoCertificado->id_curso = $request->id_curso;

        try{
            $novoCertificado->save();
        }catch(\Exception $e){
            return response()->json([
                "message" => "Erro ao salvar certificado: {$e->getMessage()}",
                "code" => intval($e->getCode()),
                "success" => false
            ], 500);
        }

        return response()->json([
            "message" => "O certificado foi salvo com sucesso",
            "code" => 201,
            "success" => true
        ], 201);

    }

    /**
     * @param $email
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCertificado($hash_certificado)
    {
        try{
            return response()->json(Certificados::where(['id_certificado' => $id_certificado])->first());
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage(),
                'code' => $e->getCode(),
                'success' => false
            ]);
        }

        return response()->json(array());
    }

    public function validaCertificado($hash_certificado)
    {
        try{
            $response = Certificados::where(['hash_certificado' => $hash_certificado])->first();

            if(!empty($response)){
                return response()->json(['certificado_valido' => true]);
            }

        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage(),
                'code' => $e->getCode(),
                'success' => false
            ]);
        }

        return response()->json(['certificado_valido' => false]);
    }
}

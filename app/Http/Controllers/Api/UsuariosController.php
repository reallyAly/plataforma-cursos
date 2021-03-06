<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use Illuminate\Routing\Controller;

/**
 * Class UsuariosController
 * @package App\Http\Controllers\Api
 */
class UsuariosController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUsuarios()
    {
        $usuariosCollection = Usuarios::all();
        return response()->json($usuariosCollection->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function salvar(Request $request)
    {
        $novoUsuario = new Usuarios();

        $novoUsuario->nome_usuario = $request->nome_usuario;
        $novoUsuario->cpf_usuario = $request->cpf_usuario;
        $novoUsuario->email_usuario = $request->email_usuario;
        $novoUsuario->senha_usuario = $request->senha_usuario;
        $novoUsuario->tipo_usuario = $request->tipo_usuario;

        try{
            $novoUsuario->save();
        }catch(\Exception $e){
            return response()->json([
                "message" => "Erro ao salvar usuário: {$e->getMessage()}",
                "code" => intval($e->getCode()),
                "success" => false
            ], 500);
        }

        return response()->json([
            "message" => "O usuário foi salvo com sucesso",
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
            Usuarios::where(['email_usuario' => $request->email_usuario])->first()->delete();
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage(),
                'code' => $e->getCode(),
                'success' => false
            ]);
        }

        return response()->json([
            "message" => 'Usuário deletado com sucesso',
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

            $usuario = Usuarios::where("email_usuario", $request->email_usuario)->first();

            if(empty($usuario)){
                return response()->json([
                    "message" => 'Usuário não encontrado',
                    'code' => 404,
                    'success' => false
                ]);
            }

            $usuario->nome_usuario = $request->nome_usuario;
            $usuario->email_usuario = $request->email_usuario;
            $usuario->senha_usuario = $request->senha_usuario;

            $usuario->save();
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
     * @param Request $request
     */
    public function autenticar(Request $request)
    {
        $usuario = Usuarios::where([
            'email_usuario' => $request->email_usuario,
            'senha_usuario' => $request->senha_usuario
        ])->first();

        $size = 50;
        $seed = time();

        if(!empty($usuario)){
            $usuario = $usuario->toArray();

            return response()->json([
                'email_usuario' => $usuario['email_usuario'],
                'nome_usuario' => $usuario['nome_usuario'],
                'tipo_usuario' => $usuario['tipo_usuario'],
                'token_usuario' => substr(sha1($seed), 40 - min($size,40))
            ]);
        }

        return response()->json([
            'message' => 'Credenciais inválidas',
            'code' => 0,
            'success' => false
        ]);
    }


    public function validarUsuario(Request $request)
    {
        $usuario = Usuarios::where([
            'email_usuario' => $request->email_usuario,
            'senha_usuario' => $request->senha_usuario
        ])->first();

        if(!empty($usuario)){
            return response()->json([
                'isValid' => true
            ]);
        }

        return response()->json([
            'isValid' => false
        ]);
    }

    /**
     * @param $email
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsuario($email)
    {
        try{
            $response = response()->json(Usuarios::where(['email_usuario' => $email])->get());

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
            "message" => 'Usuário não encontrado',
            'code' => 0,
            'success' => false
        ]);
    }

}

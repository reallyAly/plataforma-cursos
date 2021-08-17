<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Routing\Controller;

/**
 * Class UsersController
 * @package App\Http\Controllers\Api
 */
class UsersController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUsers()
    {
        $usersCollection = Users::all();
        return response()->json($usersCollection->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $newUser = new Users();

        $newUser->nome_usuario = $request->nome_usuario;
        $newUser->cpf_usuario = $request->cpf_usuario;
        $newUser->email_usuario = $request->email_usuario;
        $newUser->senha_usuario = $request->senha_usuario;

        try{
            $newUser->save();
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
    public function delete(Request $request)
    {
        try{
            Users::where(['email_usuario' => $request->email_usuario])->first()->delete();
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
    public function update(Request $request)
    {
        try{

            $user = Users::where("email_usuario", $request->email_usuario)->first();

            if(empty($user)){
                return response()->json([
                    "message" => 'Usuário não encontrado',
                    'code' => 404,
                    'success' => false
                ]);
            }

            $user->nome_usuario = $request->nome_usuario;
            $user->email_usuario = $request->email_usuario;
            $user->cpf_usuario = $request->cpf_usuario;
            $user->senha_usuario = $request->senha_usuario;

            $user->save();
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
    public function auth(Request $request)
    {
        return;
    }

    /**
     * @param Request $request
     */
    public function validateSession(Request $request)
    {
        return;
    }

    /**
     * @param $email
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser($email)
    {
        try{
            return response()->json(Users::where(['email_usuario' => $email])->get());
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

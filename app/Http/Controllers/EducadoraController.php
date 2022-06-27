<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Educadora;
use App\Models\carrinha;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class EducadoraController extends Controller{
   
    /**
     * Registro de educadora
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|min:4',
            'usuario' => 'required|email',
            'senha' => 'required|min:8',
        ]);
  
        $user = Educadora::create([
            'nome' => $request->nome,
            'usuario' => $request->usuario,
            'senha' => bcrypt($request->senha)
        ]);
  
        $token = $user->createToken('Laravel8PassportAuth')->accessToken;
  
        return response()->json(['token' => $token], 200);
    }

    /**
     * Login de educadora
     */
    public function login(Request $request)
    {
        /*$data = [
            'usuario' => $request->usuario,
            'senha' => $request->senha
        ];

        $user = Educadora::where('usuario', $request->usuario)->first();

        if (auth()->attempt($data)) {
            $token = auth()->$user->createToken('Laravel8PassportAuth')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }*/

        $fields = $request->validate([
            'usuario' => 'required|string',
            'senha' => 'required|string'
        ]);

        $user = Educadora::where('usuario', $fields['usuario'])->first();

       if(!$user || !Hash::check($fields['senha'], $user->senha)){
            return response([
                'message' => 'Unrecognized Credentials'
            ], 401);
        }

        $token = $user->createToken('Laravel8PassportAuth')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return \response($user, 201);
    }

    /**
     * obter carrinhas associadas a uma determinada educadora
    */
    public function getCarrinha($id){
        $carrinha = carrinha::where('id_educadora', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return \response($carrinha, 201);
    } 
   
    
}

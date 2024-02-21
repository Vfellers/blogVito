<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
    * @OA\Post(
    *    path="/Auth",
    *    tags={"Auth"},
    *    summary="Get token of autentication",
    *    description="Return tis bearer token",
    *    @OA\Parameter(
    *      name="email",
    *      in="query",
    *      required=true,
    *    @OA\Schema(type="string")
    *    ),
    *
    *    @OA\Parameter(
    *     name="password",
    *     in="query",
    *     required=true,
    *    @OA\Schema(type="string")
    *    ),
    *
    *    @OA\Response(
    *       response="200",
    *       description="token autentication"
    *    ),
    *   
    *  
    *  )
    */

    public function auth(Request $request){
        $user = User::where("email", $request->email)->first();
        
        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                "status" => "error",    //Error ou Success
                "message" => "Credenciais inválidas"
            ]);
        }


        //Gerar um Token para o ususario que conseguir logar
        $token = $user->createToken($request->deviceName)->plainTextToken;
    
        return response()->json([
            "token" => $token
        ]);
    }
}

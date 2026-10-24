<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller {
      public function view () {

        return view("AuthSys.Login");
    }

    public function login( Request $request) {

        $dados = $request->validate([
            'email' => "required|string",
            "password" =>'required|string'
        ]);

        if ( $user = User::where('email',$dados['email'])->first()) {

            if ( Auth::attempt($dados) ) {

                $user = Auth::user();

               $myToken =  $user->createToken('api-token')->plainTextToken;

               return response()->json(['mytoken' => $myToken]);
            }

        }

        else{

            throw validationException::WithMessages([
                
                'email' => 
                    ['the provide credentials are incorect']]);
        }

    }

    public function logout(Request $request) {
        
        $request->user()->Tokens()->delete();

            return [
                    'msg'=>'voce esta desloado'];
    }

}

<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Login",
     *     tags={"login"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(     *
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"email": "musk@email.com","password": "password1234"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *
     *     )
     * )
     */
    public function login(Request $request){
        $credentials = $request->only('email','password');

        if(!auth()->attempt($credentials))
            abort(401,"Invalid Credentials");

        $token = auth()->user()->createToken("auth_token");

        return response()->json([
            'data' => [
                'token' => $token->plainTextToken
            ]
        ]);
    }


    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="Logout",
     *     security={{"bearerAuth":{}}},
     *     tags={"login"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *
     *     )
     * )
     */
    public function logout(){
        auth()->user()->tokens()->delete(); //remove todos os tokens

       // auth()->user()->currentAccessToken()->delete(); // remove o da requisição
    }





}





























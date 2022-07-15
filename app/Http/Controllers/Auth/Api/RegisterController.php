<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     summary="Register",
     *     tags={"login"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(     *
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"name":"Musk","email": "musk@email.com","password": "password1234"}
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
    public function register(Request $request, User $user){
        $user_data = $request->only('name','email','password');
        $user_data['password'] = bcrypt( $user_data['password']);

//        dd($user_data);

        if(!$user = $user->create($user_data))
            abort(500, "Error in create new user");



        return response()->json([
            'data' => [
                'user' => $user
            ]
        ]);
    }
}

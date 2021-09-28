<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class LoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/register",
     *     summary="Add a new user",
     *     tags={"User"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
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
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     	   @OA\Schema(type="integer"),
     *                     }
     *                 ),
     *                 example={"name": "a", "email": "a@a.com", "password": 12345678}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *         )
     *     )
     * )
     */
    public function register(Request $request){
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);
        
        return response([
            'message' => 'User has been register'
        ]);
    }
    /**
     * @OA\Post(
     * path="/login",
     * summary="Sign in",
     * description="Login by email, password",
     * operationId="login",
     * tags={"Login"},
     * @OA\RequestBody(
     *      @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     	   @OA\Schema(type="integer"),
     *                     }
     *                 ),
     *                 example={"email": "a@a.com", "password": 12345678}
     *             )
     *         )
     *     ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *  ),
     * @OA\Response(
     *    response=401,
     *    description="Invalid crendentials!",
     *     )
     * )
    */
    public function login(Request $request){

        if(!Auth::attempt($request->only('email', 'password'))){
            return response([
                'message' => 'Invalid crendentials!'
            ], Response::HTTP_UNAUTHORIZED);
        }
    
        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        return response([
            'message' => 'Login Successfully',
            'name' => $user["name"],
            'email' => $user["email"],
            'token' => $token
        ]);

    }

    public function user(){
        return Auth::user();
    }
    /**
     * @OA\Get(
     *     path="/delete/{id}",
     *     tags={"User"},
     *     summary="show",
     *     description="Delete specific User",
     *     operationId="Delete",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             maximum=10,
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Delete User Sucessfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User Not Exist",
     *     ),
     * )
     */
    public function destory($id){
        $user = User::find($id);
        if (!$user){
            return response(['message' => 'User Not Exist'], Response::HTTP_NOT_FOUND);
        }

        $user->delete();

        return response([
            'message' => 'Delete User Sucessfully'
        ]);
    }

    public function logout(){
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response(["message" => "Logout Successfully"]);
    }

}

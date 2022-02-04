<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    /**
     * Register user api endpoint
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
            'success' => false,
            'message' => $validator->messages()->toArray()], 500);
        }

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        $accessToken = $user->createToken('auth_token')->plainTextToken;

        $responseMessage = "Registration Successful";

        return response()->json([
            "success" => true,
            "message" => $responseMessage,
            "data" => new UserResource($user),
            "token" => $accessToken,
            "token_type" => "bearer",
        ], 200);
    }

    /**
     * Login User api Endpoint
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|min:6',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->messages()->toArray()
            ], 500);
        }

        $credentials = $request->only(["email","password"]);
        $user = User::where('email', $credentials['email'])->first();
        if ($user) {
            if (!auth()->attempt($credentials)) {
                $responseMessage = "Invalid username or password";
                
                return response()->json([
                    "success" => false,
                    "message" => $responseMessage,
                    "error" => $responseMessage
                ], 422);
            }
            
            $accessToken = $user->createToken('auth_Token')->plainTextToken;
            $responseMessage = "Login Successful";

            return response()->json([
                        "success" => true,
                        "message" => $responseMessage,
                        "data" => new UserResource($user),
                        "token" => $accessToken,
                        "token_type" => "bearer",
                    ], 200);
        } else {
            $responseMessage = "Sorry, this user does not exist";
            return response()->json([
                "success" => false,
                "message" => $responseMessage,
                "error" => $responseMessage
            ], 422);
        }
    }


    /**
     * user profile information Endpoint
     */
    public function profile()
    {
        $responseMessage = "user profile";
        return response()->json([
            "success" => true,
            "message" => $responseMessage,
            "data" =>  new UserResource(Auth::user())
        ], 200);
    }

    /**
     * Logout user Endpoint
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        $responseMessage = "successfully logged out";
        return response()->json([
            'success' => true,
            'message' => $responseMessage
        ], 200);
    }
}

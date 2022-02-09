<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\RegisterRequest;

class AuthController extends Controller
{
    /**
     * Register user api endpoint
     */
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $validated["password"] = Hash::make($validated["password"]);
        $user = User::create($validated);
        $accessToken = $user->createToken('auth_token')->plainTextToken;
        return $this->success("Registration Successful", new UserResource($user), $accessToken);
    }

    /**
     * Login User api Endpoint
     */
    public function login(LoginRequest $request)
    {
        $request->validated();
        $credentials = $request->only(["email","password"]);
        $user = User::where('email', $credentials['email'])->first();
        if ($user) {
            if (!auth()->attempt($credentials)) {
                $responseMessage = "Invalid username or password";
                return $this->failure($responseMessage, $responseMessage);
            }
            $accessToken = $user->createToken('auth_Token')->plainTextToken;
            $responseMessage = "Login Successful";
            return $this->success("Login Successful", new UserResource($user), $accessToken);
        } else {
            $responseMessage = "Sorry, this user does not exist";
            return $this->failure($responseMessage, $responseMessage);
        }
    }

    /**
     * user profile information Endpoint
     */
    public function profile()
    {
        return $this->success("User Profile", new UserResource(Auth::user()));
    }

    /**
     * Logout user Endpoint
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->success("Successfully Logged Out");
    }
}

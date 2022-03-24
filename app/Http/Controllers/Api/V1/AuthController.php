<?php
namespace App\Http\Controllers\Api\V1;

use Auth;
use Validator;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Exception\ClientException;

class AuthController extends Controller
{
    use ApiResponser;

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return $this->error('The provided credentials are incorrect', 400);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 'Login successfully');
    }

    public function refresh(Request $request)
    {
        $request->user()->tokens()->delete();
        $token = $request->user()->createToken('auth_token')->plainTextToken;

        return $this->success([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 'Refresh token successfully');
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->success(
            [], //data
            'Log out successfully'
        );
    }

    // social authentication
    public function redirectToProvider($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $e) {
            return $this->error('The provided credentials are incorrect', 400);
        }

        $userCreated = User::firstOrCreate(
            [
                'email' => $user->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $user->getName(),
                'account_type' => $provider,
                'avatar' => $user->getAvatar()
            ]
        );
        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar()
            ]
        );

        $token = $userCreated->createToken('auth_token')->plainTextToken;

        return $this->success(
            [
                'user' => $userCreated,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ], 'Record successfully retrieved', 200
        );
    }

    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'google'])) {
            return $this->error('Please login using facebook or google', 400);
        }
    }
}

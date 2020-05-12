<?php
/**
 * @author smaosa@strathmore.edu
 *
 */
namespace App\Traits;

use App\Repos\ApiAuth;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait AuthenticatesApiUsers
{
    protected $ldap;
    public function __construct(ApiAuth $auth)
    {
        $this->ldap = $auth;
    }

    public function login(Request $request) {
        try {
            $request->validate([
                "username" => ["required", "string"],
                "password" => ["required", "min:3"],
                "device_name" =>["required","string"]
            ]);
            if (str_contains($request->username,"@")) {
                $creds = [
                    "email" => $request->username,
                    "password" => $request->password,
                ];
                $user = User::whereEmail($request->username)->first();
            } else {
                $creds = [
                    "username" => $request->username,
                    "password" => $request->password,
                ];
                $user = User::whereUsername(trim($request->username))->first();
            }
            if (!$user) {
                throw new NotFoundHttpException("The user could not be found in this system.");
            }
            if (!$this->ldap->auth($user->username,$request->password)) {
                throw ValidationException::withMessages([
                    'username' => ['Either the username or password is incorrect'],
                ]);
            } else {
                $token = $user->createToken($request->device_name)->plainTextToken;
                logUserLogin($user,'api');
                return jsonRes(true, "Login successful", ["token" => $token, "user" => $user]);
            }
        } catch (ValidationException $exception) {
            return jsonRes(false, $exception->validator->messages()->first(), $exception->errors(),422);
        } catch (AuthorizationException $exception) {
            return jsonRes(false, $exception->getMessage(), [],403);
        } catch (AuthenticationException $exception) {
            return jsonRes(false, $exception->getMessage(), [],401);
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return jsonRes(false, $exception->getMessage(), [],400);
        }
    }

    public function logout(Request $request) {
        if (!$request->has('device_name'))
            return jsonRes(false,  "The device name is required for you to logout.",[],422);
        $res = $request->user()->tokens()->where('name', $request->device_name)->delete();
        if (!$res) {
            return jsonRes(false, "Logout unsuccessful. Did you get the device name right?",[],400);
        }
        return jsonRes(true, "You have been logged out on this device.",["result" => $res],200);
    }
    public function logoutAll(Request $request) {
        $res = $request->user()->tokens()->delete();
        if (!$res) {
            return jsonRes(false, "The logout was not successful",[],400);
        }
        return jsonRes(true, "You have been logged out on all devices",[],200);
    }
    public function authCheck(Request $request) {
        return response(['authenticated' => \Auth::guard('sanctum')->check()]);
    }
}

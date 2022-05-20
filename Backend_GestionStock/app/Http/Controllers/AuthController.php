<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\ErrorSeccuss;
use Illuminate\Contracts\Auth\Guard;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{  
    use ErrorSeccuss;
    // /**
    //  * Create a new AuthController instance.
    //  *
    //  * @return void
    //  */
    // public function __construct() {
    //     $this->middleware('checkAdminToken:admin', ['except' => ['login', 'register']]);
    // }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        //---validation
        $validator= Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }   
        //--login
        $token = Auth('admin')->attempt($validator->validated());
        if (!$token){
            return $this->errorMessage('Unauthorized');
        }
        //--return token
        $user=auth::guard('admin')->user();
        $user->token=$token;
        return $this->returnData('admin',$user);
        //return $this->createNewToken($token);
    //=====================
        /*     $user=$request->only('email','password');
            $token=auth::guard('admin')->attempt($user);
            if (!$token) {
                return $this->errorMssage('email et password inccorect !!');
            }
            //--if return data dyal admin ==>$data=auth::guard('admin')->user();
            return $this->returnData('admin',$token);*/
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request) {

       // auth()->logout();
        //return $this->seccussMessage('User successfully signed out');
        
        $token=$request->header('token');
        if($token){
            try{
        JWTAuth::setToken($token)->invalidate();//supprimer token
        return $this->seccussMessage('User successfully signed out');
        }catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
            return $this->errorMessage('INVALID TOKEN');
        }
        }else{
            return $this->errorMessage('some thing is wrong');
        }
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        $newtoken=auth::refresh();
        return $this->createNewToken($newtoken);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
            $user=JWTAuth::parseToken()->authenticate();
            // $user=auth()guard('admin')->->user();
            // if($user)
                return $this->returnData('admin',$user);
        
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth::factory()->getTTL() * 60,
            'user' => auth()->guard('admin')->user()
        ]);
    }
}




// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Tymon\JWTAuth\Contracts\Providers\JWT;
// use Tymon\JWTAuth\Facades\JWTAuth;

// class AuthController extends Controller
// {
//     /**
//      * Create a new AuthController instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         $this->middleware('auth:api', ['except' => ['login']]);
//     }
//     /**
//      * Get a JWT via given credentials.
//      *
//      * @return \Illuminate\Http\JsonResponse
//      */
//     public function login()
//     {
//         $credentials = request(['email', 'password']);
//         if (! $token = auth()->attempt($credentials)) {
//             return response()->json(['error' => 'email or password inccorect'], 401);
//         }
//         // if (! $token = JWTAuth::attempt($credentials)) {
//         //     return response()->json(['error' => 'email or password inccorect'], 401);
//         // }

//         return $this->respondWithToken($token);
//     }

//     /**
//      * Get the token array structure.
//      *
//      * @param  string $token
//      *
//      * @return \Illuminate\Http\JsonResponse
//      */
//     protected function respondWithToken($token)
//     {
//         return response()->json([
//             'access_token' => $token,
//             'token_type' => 'bearer',
//             // 'expires_in' => auth()->factory()->getTTL() * 60
//             //'expires_in' => auth('api')->factory()->getTTL() * 60
//         ]);
//     }
// }

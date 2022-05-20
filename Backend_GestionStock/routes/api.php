<?php
use App\Http\Controllers\factureController;
use App\Http\Controllers\commandController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\produitsController;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//-----------> Token admin/Login<-------
Route::group(['middleware' =>['api']], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

});  
//-------------- check admin token -----------------
Route::group(['middleware'=>['authguard:admin']],function(){
    //--------> ADMINS
    Route::group(['prefix'=>'admin'],function(){
    Route::get('/user-profile', [AuthController::class, 'userProfile']); 
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);});
});

//-------> PRODUITS
//Route::group(['middleware'=>['authguard:admin']],function(){
Route::apiResource('/produits',produitsController::class);
//});
//-------> COMMANDS
// Route::group(['middleware'=>['authguard:admin']],function(){
Route::apiResource('/commands',commandController::class);
//});

//--------> FACTURES
//Route::group(['middleware'=>['authguard:admin']],function(){
    Route::apiResource('/factures',factureController::class);
//});





/*
Route::group(['middleware'=>'check'],function(){
Route::post('produits',[produitsController::class,'index']);
Route::put('/produit/modifier/{id}',[produitController::class,'update']);
Route::delete('/produit/supprimer/{id}',[produitController::class,'distroy']);
});
*/








// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//-------> LOGIN / LOGOUT
// Route::post('login', [AuthController::class,'login']);
// Route::post('logout', [AuthController::class,'logout']);
// Route::post('refresh', [AuthController::class,'refresh']);
// Route::post('me', [AuthController::class,'me']);
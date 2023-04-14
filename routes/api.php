<?php


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
//login
//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/dhasboard', function(Request $request) {
        return auth()->user();
    });

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});

//Page1
Route::get('/page1', '\App\Http\Controllers\Page1Controller@index');
Route::post('/page1', '\App\Http\Controllers\Page1Controller@create');
Route::put('/page1/{id}', '\App\Http\Controllers\Page1Controller@update');
Route::delete('/page1/{id}', '\App\Http\Controllers\Page1Controller@soft_delete');
Route::get('/page1/{id}', '\App\Http\Controllers\Page1Controller@show');
Route::get('page1/{id}', '\App\Http\Controllers\Page1Controller@getDetail');
Route::post('/Page1/{id}', '\App\Http\Controllers\Page1Controller@restore');

//sosmed
Route::get('/sosmed', '\App\Http\Controllers\SosmedController@index');
Route::post('/sosmed', '\App\Http\Controllers\SosmedController@create');
Route::put('/sosmed/{id}', '\App\Http\Controllers\SosmedController@update');
Route::delete('/sosmed/{id}', '\App\Http\Controllers\SosmedController@soft_delete');
Route::get('/sosmed/{id}', '\App\Http\Controllers\SosmedController@show');
Route::get('/sosmed/{id}', '\App\Http\Controllers\SosmedController@getDetail');
Route::post('/sosmed/{id}', '\App\Http\Controllers\SosmedController@restore');


//users
Route::get('/user', '\App\Http\Controllers\UsersController@index');
Route::post('/user', '\App\Http\Controllers\UsersController@create');
Route::put('/user{id}', '\App\Http\Controllers\UsersController@update');
Route::get('/user/{id}', '\App\Http\Controllers\UsersController@getDetail');

//page2
Route::get('/page2', '\App\Http\Controllers\Page2Controller@index');
Route::post('/page2', '\App\Http\Controllers\Page2Controller@create');
Route::get('/page2/{id}', '\App\Http\Controllers\Page2Controller@getDetail');
Route::put('/page2/{id}', '\App\Http\Controllers\Page2Controller@update');
// Route::delete('/page2/{id}', '\App\Http\Controllers\Page2Controller@soft_delete');
// Route::post('/Page2/{id}', '\App\Http\Controllers\Page2Controller@restore');



//about
Route::get('/about', '\App\Http\Controllers\AboutController@index');
Route::post('/about', '\App\Http\Controllers\AboutController@create');
Route::get('/about/{id}', '\App\Http\Controllers\AboutController@show');
Route::put('/about/{id}', '\App\Http\Controllers\AboutController@update');
Route::delete('/about/{id}', '\App\Http\Controllers\AboutController@soft_delete');


//page3
Route::post('/page3', '\App\Http\Controllers\Page3Controller@create');
Route::get('/page3', '\App\Http\Controllers\Page3Controller@index');
Route::put('/page3/{id}', '\App\Http\Controllers\Page3Controller@update');
Route::get('/page3/{id}', '\App\Http\Controllers\Page3Controller@getDetail');


// page4
Route::post('/page4', '\App\Http\Controllers\Page4Controller@create');
Route::get('/page4', '\App\Http\Controllers\Page4Controller@index');
Route::put('/page4/{id}', '\App\Http\Controllers\Page4Controller@update');
Route::get('/page4/{id}', '\App\Http\Controllers\Page4Controller@getDetail');

// work
Route::post('/work', '\App\Http\Controllers\WorkController@create');
Route::get('/work', '\App\Http\Controllers\WorkController@index');
Route::put('/work/{id}', '\App\Http\Controllers\WorkController@update');
Route::get('/work/{id}', '\App\Http\Controllers\WorkController@getDetail');

// Time_line
Route::post('/time_line', '\App\Http\Controllers\Time_lineController@create');
Route::get('/time_line', '\App\Http\Controllers\Time_lineController@index');
Route::put('/time_line/{id}', '\App\Http\Controllers\Time_lineController@update');
Route::get('/time_line/{id}', '\App\Http\Controllers\Time_lineController@getDetail');


// Video
Route::post('/video', '\App\Http\Controllers\VideoController@create');
Route::get('/video', '\App\Http\Controllers\VideoController@index');
Route::put('/video/{id}', '\App\Http\Controllers\VideoController@update');
Route::get('/video/{id}', '\App\Http\Controllers\VideoController@getDetail');

// about
Route::post('/about', '\App\Http\Controllers\AboutController@create');
Route::get('/about', '\App\Http\Controllers\AboutController@index');
Route::put('/about/{id}', '\App\Http\Controllers\AboutController@update');
Route::get('/about/{id}', '\App\Http\Controllers\AboutController@getDetail');

// produk
Route::post('/produk', '\App\Http\Controllers\ProdukController@create');
Route::get('/produk', '\App\Http\Controllers\ProdukController@index');
Route::put('/produk/{id}', '\App\Http\Controllers\ProdukController@update');
Route::get('/produk/{id}', '\App\Http\Controllers\ProdukController@getDetail');
Route::delete('/about/{id}', '\App\Http\Controllers\AboutController@delete');

// merchan
Route::post('/merchan', '\App\Http\Controllers\MerchanController@create');
Route::get('/merchan', '\App\Http\Controllers\MerchanController@index');
Route::put('/merchan/{id}', '\App\Http\Controllers\MerchaController@update');
Route::get('/merchan/{id}', '\App\Http\Controllers\MerchaController@getDetail');
Route::delete('/merchan/{id}', '\App\Http\Controllers\MerchatController@delete');

//addvideo
Route::post('/addvideo', '\App\Http\Controllers\AddvideoController@create');
Route::get('/addvideo', '\App\Http\Controllers\AddvideoController@index');
Route::put('/addvideo/{id}', '\App\Http\Controllers\AddvideoController@update');
Route::get('/addvideo/{id}', '\App\Http\Controllers\AddvideoController@getDetail');
Route::delete('/addvideo/{id}', '\App\Http\Controllers\AddvideoController@delete');

// Video1
Route::post('/video1', '\App\Http\Controllers\Video1Controller@create');
Route::get('/video1', '\App\Http\Controllers\Video1Controller@index');
Route::put('/video1/{id}', '\App\Http\Controllers\Video1Controller@update');
Route::get('/video1/{id}', '\App\Http\Controllers\Video1Controller@getDetail');

// Video2
Route::post('/video2', '\App\Http\Controllers\Video2Controller@create');
Route::get('/video2', '\App\Http\Controllers\Video2Controller@index');
Route::put('/video2/{id}', '\App\Http\Controllers\Video2Controller@update');
Route::get('/video2/{id}', '\App\Http\Controllers\Video2Controller@getDetail');

// Video3
Route::post('/vide3', '\App\Http\Controllers\Video3Controller@create');
Route::get('/video3', '\App\Http\Controllers\Video3Controller@index');
Route::put('/video3/{id}', '\App\Http\Controllers\Video3Controller@update');
Route::get('/video3/{id}', '\App\Http\Controllers\Video3Controller@getDetail');

// Video4
Route::post('/video4', '\App\Http\Controllers\Video4Controller@create');
Route::get('/video4', '\App\Http\Controllers\Video4Controller@index');
Route::put('/video4/{id}', '\App\Http\Controllers\Video4Controller@update');
Route::get('/video4/{id}', '\App\Http\Controllers\Video4Controller@getDetail');

// Video5
Route::post('/video5', '\App\Http\Controllers\Video5Controller@create');
Route::get('/video5', '\App\Http\Controllers\Video5Controller@index');
Route::put('/video5/{id}', '\App\Http\Controllers\Video5Controller@update');
Route::get('/video5/{id}', '\App\Http\Controllers\Video5Controller@getDetail');
<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Route::get('/hello', function () {
  return 'Hello';
});

Route::redirect('/world', '/hello');

Route::fallback(function () {
  return '404';
});

Route::view('/page', 'hello', ['name' => 'Idham']);

Route::view('/child', 'parent.children', ['name' => 'Roy']);

Route::get('/products/{id}', function ($productId) {
  return "Product $productId";
})->where('id', '[0-9]+')->name('product.detail');

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
  return "Product: $productId, Item: $itemId";
})->name('product.item.detail');

Route::get('/users/{id?}', function (string $userId = '404') {
  return "User: $userId";
})->name('user.detail');

Route::get('/produk/{id}', function ($id) {
  $link = route('product.detail', ['id' => $id]);
  return "Link $link";
});

Route::get('/controller/hello', [HelloController::class, 'hello']);

Route::get('/controller/hello/request', [HelloController::class, 'request']);

Route::get('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello/first', [InputController::class, 'helloFirst']);
Route::post('/input/hello/input', [InputController::class, 'helloInput']);
Route::get('/input/hello/input', [InputController::class, 'helloInput']);
Route::post('/input/hello/array', [InputController::class, 'helloArray']);
Route::post('/input/type', [InputController::class, 'inputType']);
Route::post('/input/filter/only', [InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [InputController::class, 'filterExcept']);
Route::post('/input/filter/merge', [InputController::class, 'filterMerge']);

Route::post('/file/upload', [FileController::class, 'upload']);

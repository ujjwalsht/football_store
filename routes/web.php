<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CamisetaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\APICompraController;
use App\Http\Controllers\APICategoriaController;
use App\Http\Controllers\APICamisetaController;

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

Route::get('/', [HomeController::class, 'showHomeStats'])->middleware(['auth', 'verified'])->name('home');
Route::get('/home', [HomeController::class, 'showHomeStats'])->middleware(['auth', 'verified'])->name('home');

// Rutas clientes
Route::get('/clientes', [ClienteController::class, 'index'])->middleware(['auth', 'verified'])->name('clientes');
Route::get('/clientes/{id}', [ClienteController::class, 'show'])->middleware(['auth', 'verified']);

// Rutas camisetas
Route::get('/camisetas', [CamisetaController::class, 'index'])->middleware(['auth', 'verified'])->name('camisetas');
Route::get('/camisetas/categoria/{id}', [CamisetaController::class, 'indexByCategory'])->middleware(['auth', 'verified']);
Route::get('/camisetas/new', [CamisetaController::class, 'create'])->middleware(['auth', 'verified']);
Route::post('/camisetas/new', [CamisetaController::class, 'store'])->middleware(['auth', 'verified']);
Route::get('/camisetas/{id}/edit', [CamisetaController::class, 'edit'])->middleware(['auth', 'verified']);
Route::patch('/camisetas/{id}/edit', [CamisetaController::class, 'update'])->middleware(['auth', 'verified']);
Route::patch('/camisetas/{id}/stock', [CamisetaController::class, 'updateStock'])->middleware(['auth', 'verified']);
Route::get('/camisetas/{id}/delete', [CamisetaController::class, 'delete'])->middleware(['auth', 'verified']);
Route::delete('/camisetas/{id}/delete', [CamisetaController::class, 'destroy'])->middleware(['auth', 'verified']);

// Rutas categorias
Route::get('/categorias', [CategoriaController::class, 'index'])->middleware(['auth', 'verified'])->name('categorias');
Route::get('/categorias/new', [CategoriaController::class, 'create'])->middleware(['auth', 'verified']);
Route::post('/categorias/new', [CategoriaController::class, 'store'])->middleware(['auth', 'verified']);
Route::get('/categorias/{id}/delete', [CategoriaController::class, 'delete'])->middleware(['auth', 'verified']);
Route::delete('/categorias/{id}/delete', [CategoriaController::class, 'destroy'])->middleware(['auth', 'verified']);

// Rutas compras y pedidos
Route::get('/compras', [CompraController::class, 'index'])->middleware(['auth', 'verified'])->name('compras');
Route::get('/compras/{id}', [CompraController::class, 'show'])->middleware(['auth', 'verified']);
Route::get('/compras/{id}/edit', [CompraController::class, 'edit'])->middleware(['auth', 'verified']);
Route::patch('/compras/{id}/edit', [CompraController::class, 'update'])->middleware(['auth', 'verified']);

// Rutas perfil/auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de API para que anden en Vercel
Route::prefix('_api')->group(function () {
    //Camisetas
    Route::get('/camisetas', [APICamisetaController::class, 'getCamisetas']);
    Route::get('/camisetas/categoria/{categoria}', [APICamisetaController::class, 'getCamisetasByCategoria']);

    //Categorias
    Route::get('/categorias', [APICategoriaController::class, 'getCategorias']);

    //Cliente/Compras
    Route::get('/compras/{email}', [APICompraController::class, 'getComprasByCliente']);
    Route::post('/comprar/auth', [APICompraController::class, 'autorizarPago']);
    Route::post('/comprar', [APICompraController::class, 'createCompra']);
});

require __DIR__ . '/auth.php';
<?php

// use App\Http\Controllers\ProfileController;

// Route::get('/', function () {
//     return view('welcome');
// });


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/role-create',[RoleController::class,'create'])->name('role.create');
Route::get('/role-store',[RoleController::class,'store'])->name('role.store');

Route::middleware('check')->group(function(){
    
    Route::get('/roles',[RoleController::class,'index'])->name('role.index');
    Route::get('/role-edit/{role}',[RoleController::class,'edit'])->name('role.edit');
    Route::put('/role-update/{role}',[RoleController::class,'update'])->name('role.update');
    Route::post('/role-create',[RoleController::class,'store'])->name('role.store');

    Route::put('/roles/{role}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
    Route::get('/users',[UserController::class,'index'])->name('user.index');
    Route::put('/user-rolechange/{id}', [UserController::class, 'changeUserRole']);
    Route::get('/user-edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user-update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/user-store',[UserController::class,'store'])->name('user.store');
    Route::delete('/user-delete/{user}',[UserController::class,'destroy'])->name('user.destroy');

});


Route::middleware('check:post,admin')->group(function(){

    Route::get('/posts',[PostController::class,'index'])->name('post.index');
    Route::get('/post-edit/{post}',[PostController::class,'edit'])->name('post.edit');

    Route::get('/post-create',[PostController::class,'create'])->name('post.create');
    Route::post('/post-store',[PostController::class,'store'])->name('post.store');
    Route::get('/post-show/{post}',[PostController::class,'show'])->name('post.show');

    Route::put('/post-update/{id}',[PostController::class,'update'])->name('post.update');

});


Route::middleware('check:student,admin')->group(function(){

    Route::get('/students',[StudentController::class,'index'])->name('student.index');
    Route::get('/student-create',[StudentController::class,'create'])->name('student.create');
    Route::post('/student-store',[StudentController::class,'store'])->name('student.store');
    Route::get('/student-show/{student}',[StudentController::class,'show'])->name('student.show');
    Route::get('/student-edit/{student}',[StudentController::class,'edit'])->name('student.edit');
    Route::put('/student-update/{id}',[StudentController::class,'update'])->name('student.update');
    Route::delete('/student-delete/{id}',[StudentController::class,'destroy'])->name('student.destroy');
});


Route::middleware('check:company,admin')->group(function(){
    Route::get('/companies',[CompanyController::class,'index'])->name('company.index');
    Route::delete('/company-delete/{company}',[CompanyController::class,'destroy'])->name('company.destroy');    
});


Route::middleware('check:category,admin')->group(function(){

    Route::get('/categories',[CategoryController::class,'index'])->name('category.index');
    Route::delete('/category-delete/{category}',[CategoryController::class,'destroy'])->name('category.destroy');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__.'/auth.php';

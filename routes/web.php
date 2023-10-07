<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/' , [HomeController::class,'index']);

Route::get('/home' , [HomeController::class,'redirect'])->middleware('auth','verified');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/add_doctor_view' , [AdminController::class,'addView']);
Route::post('/upload_doctor', [AdminController::class, 'upload']);

Route::post('/appoitement', [HomeController::class,'appoitement']);
Route::get('/myappointment', [HomeController::class,'myappointment']);
Route::get('/cancel_appoint/{id}', [HomeController::class,'cancel_appoint']);

Route::get('/showappointmet' , [AdminController::class,'showappointmet']);

Route::get('/approve/{id}' , [AdminController::class,'approve']);

Route::get('/cancel/{id}' , [AdminController::class,'cancel']);
Route::get('/showdoctor' , [AdminController::class,'showdoctor']);
Route::get('/delete_doctor/{id}' , [AdminController::class,'deletedoctor']);
Route::get('/Update_doctor/{id}' , [AdminController::class,'Updatedoctor']);
Route::post('/editdoctor/{id}' , [AdminController::class,'editdoctor']);

Route::get('/emailView/{id}' , [AdminController::class,'emailView']);
Route::post('/sendemail/{id}' , [AdminController::class,'sendEmail']);

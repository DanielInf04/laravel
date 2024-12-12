<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DefaultController;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::get('/', [DefaultController::class, 'home'])->name('home');

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->stateless()->user();

    // Verificar si ya existe un usuario con el correo electrónico
    $user = User::where('email', $user_google->email)->first();

    // Si el usuario no existe, crear uno nuevo
    if (!$user) {
        $user = User::create([
            'google_id' => $user_google->id,
            'name' => $user_google->name,
            'email' => $user_google->email,
            'password' => bcrypt('password_temporal'),  // Contraseña temporal
        ]);
    } else {
        // Si ya existe, solo actualiza el google_id (por si es necesario)
        $user->update([
            'google_id' => $user_google->id,
        ]);
    }

    Auth::login($user);

    return redirect('/');
});

Route::get('/dashboard', [DefaultController::class, 'home'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/bank.php';
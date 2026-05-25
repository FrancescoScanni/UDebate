<?php
use App\Http\Controllers\DebateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\SearchController;



Route::view('/', 'welcome');

/*Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Mostra la dashboard
    Route::get('/dashboard', [DebateController::class, 'index'])->name('dashboard');
    // Rotta nascosta per salvare il dibattito (quando premi "Crea")
    Route::post('/debates', [DebateController::class, 'store'])->name('debates.store');
    //elimino e modifico i dibattiti
    Route::patch('/debates/{debate}', [App\Http\Controllers\DebateController::class, 'update'])->name('debates.update');
    Route::delete('/debates/{debate}', [App\Http\Controllers\DebateController::class, 'destroy'])->name('debates.destroy');
    Route::post('/debates/{debate}/likes', [LikeController::class, 'toggle'])->name('likes.toggle');
    Route::post('/debates/{debate}/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');



Route::get('/moderator', [ModeratorController::class, 'index'])
    ->middleware(['auth', 'moderator'])
    ->name('moderator.dashboard');
Route::middleware(['auth', 'moderator'])->prefix('moderator')->name('moderator.')->group(function () {
    Route::get('/',        [ModeratorController::class, 'index'])->name('dashboard');
    Route::get('/users',   [ModeratorController::class, 'users'])->name('users');
    Route::get('/debates', [ModeratorController::class, 'debates'])->name('debates');
});


Route::post('/moderator/update-topic', [ModeratorController::class, 'updateTopic'])
    ->name('admin.updateTopic');
   

Route::get('/cerca', [SearchController::class, 'search'])->name('search.index');
    
require __DIR__.'/auth.php';

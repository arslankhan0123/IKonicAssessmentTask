<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Notification;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    $notifications = Notification::all();
    return view('dashboard', compact('notifications'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/Feedback', [FeedbackController::class, 'index'])->name('feedback');
    Route::get('/Feedback/Create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/Feedback/Srore', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('/Feedback/Edit/{id}', [FeedbackController::class, 'edit'])->name('feedback.edit')->middleware('admin');
    Route::post('/Feedback/Update/{id}', [FeedbackController::class, 'update'])->name('feedback.update')->middleware('admin');
    Route::get('/Feedback/Delete/{id}', [FeedbackController::class, 'delete'])->name('feedback.delete')->middleware('admin');

    Route::group(['prefix' => '/user/profile'], function () {
        Route::get('/', [UserProfileController::class, 'index'])->name('user.profile');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/User', [UserController::class, 'index'])->name('user');
        Route::get('/User/Create', [UserController::class, 'create'])->name('user.create');
        Route::post('/User/Store', [UserController::class, 'store'])->name('user.store');
        Route::get('/User/Edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/User/Store/{id}', [UserController::class, 'update'])->name('user.store');
        Route::get('/User/Delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    });

    Route::post('/feedback/vote/{feedback}', [FeedbackController::class, 'vote'])->name('feedback.vote');
    Route::get('/User/Comments/Setting', [UserCommentController::class, 'CommentsSetting'])->name('comments.setting')->middleware('admin');
    Route::post('/User/Comments/Setting/Store', [UserCommentController::class, 'CommentsSettingStore'])->name('user.comments.setting.store')->middleware('admin');

    Route::get('/User/Comments/RichTextEditing', [UserCommentController::class, 'RichTextEditing'])->name('rich.text.editing');
    Route::post('/User/Comments/RichTextEditing/store', [UserCommentController::class, 'RichTextEditingStore'])->name('rich.text.editing.store');

    Route::middleware(['auth', 'comment.access'])->group(function () {
        Route::get('/User/Comments/{id}', [UserCommentController::class, 'UserComments'])->name('user.comments');
        Route::post('/feedback/{feedback}/comments', [UserCommentController::class, 'store'])->name('comment.store');
        Route::get('/User/Comment/Edit/{id}', [UserCommentController::class, 'edit'])->name('user.comments.edit')->middleware('admin');
        Route::post('/User/Comment/Update/{comment}', [UserCommentController::class, 'update'])->name('user.comments.update')->middleware('admin');
        Route::get('/User/Comment/Delete/{id}', [UserCommentController::class, 'delete'])->name('user.comments.delete')->middleware('admin');
    });


    Route::post('/getUserNotifications', [NotificationController::class, 'markNotificationsAsRead'])->name('getUserNotifications');
    


});

require __DIR__.'/auth.php';

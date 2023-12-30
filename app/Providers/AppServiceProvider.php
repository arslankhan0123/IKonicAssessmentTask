<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;
use App\Models\Comment;
use App\Models\Notification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        View::composer('layouts.navbar', function ($view) {
            $loggedInUserId = Auth::user()->id;
            // $notifications = Notification::where('user_id', Auth::user()->id)->latest()->take(5)->get();
            $notifications = Notification::whereHas('comment.feedback.user', function ($query) use ($loggedInUserId) {
                $query->where('users.id', $loggedInUserId);
            })->where('read_status', 0)->get();
            
            // dd($notifications);
            $notificationCount = Notification::where('user_id', Auth::user()->id)->count();
            
            $view->with('notifications', $notifications)
                 ->with('notificationCount', $notificationCount);
        });
    }
}

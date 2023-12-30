<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Feedback;

class UserProfileController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::where('user_id', Auth::user()->id)->paginate(1);
        return view('users.profile.index', compact('feedbacks'));
    }
}

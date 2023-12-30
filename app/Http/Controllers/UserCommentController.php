<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Comment;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailNotification;
use Illuminate\Support\Facades\Auth;


class UserCommentController extends Controller
{
    public function UserComments($id)
    {
        $feedback = Feedback::find($id);
        $comments = Comment::where('feedback_id', $feedback->id)->orderBy('created_at', 'desc')->paginate(1);

        return view('UserComments.index', compact('feedback', 'comments'));
    }

    public function store(Request $request, Feedback $feedback)
    {
        // dd($request->all());
        $request->validate([
            'comment' => 'required',
        ]);
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->feedback_id = $feedback->id;
        $comment->user_id = auth()->user()->id;
        $comment->created_at = now();
        $comment->save();

        // Get User Email that create this Feedback and then send an email notification
        $feedback = Feedback::find($feedback->id);
        $user = $feedback->user;
        $userEmail = $user->email;
        
        $notification = new Notification();
        $notification->comment_id = $comment->id;
        $notification->feedback_id = $feedback->id;
        $notification->user_id = auth()->user()->id;
        $notification->save();

        $notification = [
            'UserName'=>Auth::user()->name,
            'Feedback'=>$feedback->title,
            'comment'=>$request->comment,
        ];


        // Send Email Verification OTP
        Mail::to($userEmail)->send(new EmailNotification($notification));

        return redirect()->back()->with('success', 'Commented on Feedback successfully!');
    }

    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('UserComments.edit', compact('comment'));
    }

    public function update(Request $request, $comment)
    {
        $request->validate([
            'comment' => 'required',
        ]);
        $comment = Comment::find($comment);
        $comment->comment = $request->comment;
        $comment->update();
        return redirect()->back()->with('success', 'User Comment updated successfully!');
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->back()->with('error', 'User Comment deleted successfully!');
    }

    public function CommentsSetting()
    {
        $users =  User::all();
        return view('UserComments.enabledDisable', compact('users'));
    }

    public function CommentsSettingStore(Request $request)
    {
        $userId = $request->user_id;
        $user =  User::find($userId);
        
        $user->comments_enabled = $request->comment_setting;
        $user->save();
        return redirect()->back()->with('success', 'User Comment Settings updated successfully!');
    }

    public function RichTextEditing()
    {
        $feedback = Feedback::find(1);
        $comments = Comment::orderBy('created_at', 'desc')->paginate(2);

        return view('UserComments.RichTextEditing', compact('feedback', 'comments'));
    }

    public function RichTextEditingStore()
    {
        return redirect()->back()->with('error', 'The form is not submitting because I just ImpleMent the Rich Text Editor  due to short of time');
    }
}

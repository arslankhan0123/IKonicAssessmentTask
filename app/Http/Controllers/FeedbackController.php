<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::latest()->get();
        return view('feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        return view('feedback.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'feedback_category' => 'required',
        ];
        $messages = [
            'title.required' => 'Title is required.',
            'description.required' => 'Description is required.',
            'feedback_category.required' => 'Feedback category is required.',
        ];
        $validatedData = $request->validate($rules, $messages);

        $feedback = new Feedback();
        $feedback->title = $request->title;
        $feedback->user_id = Auth::user()->id;
        $feedback->description = $request->description;
        $feedback->feedback_category = $request->feedback_category;
        $feedback->save();
        return redirect('/Feedback')->with('success', 'Feedback created successfully!');
    }

    public function vote(Request $request, Feedback $feedback)
    {
        $user = auth()->user();
        $voteType = $request->input('vote_type');

        $existingVote = $feedback->votes()->where('user_id', $user->id)->first();

        if ($existingVote) {
            $existingVote->update(['vote_type' => $voteType]);
            return redirect()->back()->with('success', 'Already Voted on this Feedback!');
        } else {
            $feedback->votes()->create([
                'user_id' => $user->id,
                'vote_type' => $voteType,
            ]);
        }

        return redirect()->back()->with('success', 'Vote on this Feedback created successfully!');
    }

    public function edit($id)
    {
        $feedback = Feedback::find($id);
        return view('feedback.edit', compact('feedback'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'feedback_category' => 'required',
        ];
        $messages = [
            'title.required' => 'Title is required.',
            'description.required' => 'Description is required.',
            'feedback_category.required' => 'Feedback category is required.',
        ];
        $validatedData = $request->validate($rules, $messages);
        $feedback = Feedback::find($id);
        $feedback->title = $request->title;
        $feedback->user_id = Auth::user()->id;
        $feedback->description = $request->description;
        $feedback->feedback_category = $request->feedback_category;
        $feedback->save();
        return redirect('/Feedback')->with('success', 'Feedback updated successfully!');
    }

    public function delete($id)
    {
        $feedback = Feedback::find($id);
        $feedback->delete();
        return redirect()->back()->with('error', 'Feedback deleted successfully!');
    }
}

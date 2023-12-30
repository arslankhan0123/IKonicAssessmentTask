@extends('layouts.main')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Feedback Listing</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Feedback Listing</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h3 class="card-title">All Feedbacks</h3>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{route('feedback.create')}}" class="nav-link">
                            <p>Add FeedBack</p>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Feedback Category</th>
                            <th>Description</th>
                            <th>User Name</th>
                            <th>Vote Count</th>
                            <th>Vote</th>
                            <th>Leave Comment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $feedback)
                        <tr>
                            <td>{{$feedback->title}}</td>
                            <td>{{$feedback->feedback_category}}</td>
                            <td>{{$feedback->description}}</td>
                            <td>{{$feedback->user->name}}</td>
                            <td>
                                <?php
                                $votes = json_decode($feedback->votes);
                                $upvoteCount = 0;

                                foreach ($votes as $vote) {
                                    if ($vote->vote_type == 1) {
                                        $upvoteCount++;
                                    }
                                }
                                echo $upvoteCount;
                                ?>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('feedback.vote', ['feedback' => $feedback->id]) }}">
                                    @csrf
                                    <button class="btn btn-primary" type="submit" name="vote_type" value="1">Click to Vote</button>
                                </form>
                            </td>
                            <td>
                                <a href="{{url('/User/Comments/'.$feedback->id)}}" class="nav-link"><i class="fa fa-comments-o" style="font-size:30px; color:red"></i></a>
                            </td>
                            <td>
                                <a href="{{url('/Feedback/Edit/'. $feedback->id)}}"><i class="fas fa-edit" style="font-size:20px"></i> </a>
                                <a href="{{url('/Feedback/Delete/'. $feedback->id)}}"><i class="fa fa-trash" style="font-size:20px"></i> </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.main')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">All Comments on Feedback</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">All Comments on Feedback</li>
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
                    <div class="col-md-6">
                        <p><b style="color: #0e81ff;">Feedback Title: </b> <b>{{$feedback->title}}</b></p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p><b style="color: #0e81ff;">Feedback User Name: </b> <b>{{$feedback->user->name}}</b></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b style="color: #0e81ff;">Feedback Category: </b> <b>{{$feedback->feedback_category}}</b></p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p><b style="color: #0e81ff;">Feedback Date: </b>{{$feedback->created_at}}</p>
                    </div>
                </div>
                <p><b style="color: #0e81ff;">Feedback Description: </b>{{$feedback->description}}</p>
            </div>
            <div class="card-body">
                <form id="commentForm" action="{{ route('comment.store', ['feedback' => $feedback]) }}" method="post">
                    @csrf
                    <div class="card-body">
                        {{-- <div class="form-group">
                            <label for="comment">Comment</label>
                            <input type="text" name="comment" class="form-control" id="comment" placeholder="Write Comment">
                            @error('comment')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <label for="comment">Comment using Rich Text Editor</label>
                            <textarea id="summernote" name="comment"></textarea>
                            @error('comment')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
                <h1>All Comments</h1>
                @foreach($comments as $comment)
                <div class="row" style="background-color: #e8f1fa; margin-top:10px">
                    <div class="col-md-3">
                        <p><b style="color: #0e81ff;">Content: </b> {!!$comment->comment!!}</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <p><b style="color: #0e81ff;">User Name: </b> <b>{{$comment->user->name}}</b></p>
                    </div>
                    <div class="col-md-3 text-center">
                        <p><b style="color: #0e81ff;">Comment Date: </b>{{$comment->created_at}}</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <a href="{{url('/User/Comment/Edit/'. $comment->id)}}"><i class="fas fa-edit" style="font-size:20px"></i> </a>
                        <a href="{{url('/User/Comment/Delete/'. $comment->id)}}"><i class="fa fa-trash" style="font-size:20px"></i> </a>
                    </div>
                </div>
                @endforeach
            </div>
            {{$comments->links()}}
        </div>
    </div>
</div>
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>

<script>
    jQuery(document).ready(function($) {
        $('#comment').emojioneArea({
            pickerPosition: 'center'
        });
    });
</script>


<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- include libraries(jQuery, bootstrap) -->
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

<!-- include summernote css/js -->
<!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $('#summernote').summernote();
});
</script> -->


<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- include libraries(jQuery, bootstrap) -->
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $('#summernote').summernote();
});
</script>
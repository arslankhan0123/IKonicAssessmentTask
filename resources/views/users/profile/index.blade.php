@extends('layouts.main')
@section('content')
    {{-- <div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">Your all Feedbacks</h3>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            <td>
                                <a href="{{url('/User/Edit/'. $user->id)}}"><i class="fas fa-edit" style="font-size:20px"></i> Edit</a>
                                <a href="{{url('/User/Delete/'. $user->id)}}"><i class="fa fa-trash" style="font-size:20px"></i> Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> --}}

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Your all Feedbacks</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Feedback Listing</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="list-group">
                        @foreach ($feedbacks as $feedback)
                            <div class="list-group-item mt-2">
                                <div class="row">
                                    <div class="col px-4">
                                        <div>
                                            <div class="float-right"><b>Created at: </b>{{ $feedback->created_at }}</div>
                                            <p class="mb-0"><b>Feedback name: </b>{{ $feedback->title }}</p>
                                            <p class="mb-0"><b>Feedback Category: </b>{{ $feedback->feedback_category }}
                                            </p>
                                            <p class="mb-0"><b>User Name: </b>{{ $feedback->user->name }}</p>
                                            <p class="mb-0"><b>Description: </b>{{ $feedback->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-2">
                        {{ $feedbacks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

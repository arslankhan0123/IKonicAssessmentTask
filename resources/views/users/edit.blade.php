@extends('layouts.main')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">User Edit</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('user')}}">Users Listing</a></li>
                    <li class="breadcrumb-item active">User Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">User Edit</h3>
                    </div>
                    <form id="userForm" action="{{url('User/Store/'. $user->id)}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}" placeholder="Enter Name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Email</label>
                                <input type="email" name="email" class="form-control" value="{{$user->email}}" id="email" placeholder="Enter Email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Select User Role</label>
                                <select class="form-control select2" name="user_role" style="width: 100%;">
                                    <option value="Admin" selected="selected">Admin</option>
                                    <option value="User">User</option>
                                </select>
                                @error('user_role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>
</section>
@endsection
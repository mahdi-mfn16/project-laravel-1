@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/blogs/edit.css') }}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create New Admin') }}</div>
                <form action="{{ route('create-admin') }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="mt-2 col-md-2 col-form-label text-md-center">Username</label>
                        <div class="col-md-9">
                            <input id="name" type="text" class="mr-2 mt-3 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="title" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="mt-2 col-md-2 col-form-label text-md-center">Email</label>
                        <div class="col-md-9">
                            <input id="email" type="email" class="mt-2 mr-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <label for="password" class="mt-2 col-md-2 col-form-label text-md-center">{{ __('Password') }}</label>

                        <div class="col-md-9">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password-confirm" class="mt-2 col-md-2 col-form-label text-md-center">{{ __('Confirm Password') }}</label>
                        <div class="col-md-9">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="permission" class="mt-2 col-md-2 col-form-label text-md-center">Permissions</label>
                        <div class="col-md-9">

                            @foreach ($permissions as $permission)
                            <label for="permissions" class="mt-2 col-md-2 col-form-label text-md-right">{{ $permission->label }}</label>
                            <input name="permissions[]" type="checkbox" value="{{ $permission->label }}">

                            @endforeach


                            @error('permissions')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-success col-md-6 ml-4">Store User</button>

                </form>

                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/blogs/edit.js') }}"></script>

@endsection
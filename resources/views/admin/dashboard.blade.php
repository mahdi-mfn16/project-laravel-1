@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Admin Management Panel ') }}
                <button class="btn float-right"><a href="{{ route('index-admin') }}">Admin Dashboard</a></button>
                <button class="btn float-right"><a href="{{ route('index-user') }}">User Dashboard</a></button>
                <button class="btn float-right"><a href="{{ route('admin-index') }}">Blog Dashboard</a></button>
                </div>

                <div class="card-body">
                    

            


                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
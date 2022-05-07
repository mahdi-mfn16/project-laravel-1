@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Users Dashboard List') }}
                <button class="btn btn-success float-right"><a href="{{ route('create-user') }}">Create User</a></button>
                </div>

                <div class="card-body">
                    <table class="table table-striped shadow-sm p-3 mb-5 bg-white rounded">
                        <thead class="thead-dark">
                            <tr>

                                <th scope="col">id</th>
                                <th scope="col">name</th>
                                <th scope="col">email</th>
                                <th scope="col">privilege</th>
                                <th scope="col">created_at</th>
                                <th scope="col">updated_at</th>
                                <th scope="col">edit</th>
                                <th scope="col">delete</th>


                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                            <tr>
                                <th scope="col">{{$user->id}}</th>
                                <th scope="col">{{$user->name}}</th>
                                <th scope="col">{{$user->email}}</th>
                                <th scope="col">
                                    @if ($user->privilege)
                                        Admin
                                    @else
                                        Bloger
                                    @endif
                                </th>
                                <th scope="col">{{ $user->garegorian2jalali($user->created_at) }}</th>
                                <th scope="col">{{ $user->garegorian2jalali($user->updated_at) }}</th>
                                <th scope="col">
                                    <button class="btn btn-primary"><a href="{{ route('edit-user', ['user'=>$user->id]) }}">edit</a></button>
                                </th>

                                <th scope="col">
                                    <form method="POST" action="{{ route('delete-user', ['user'=>$user->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">delete</button>
                                    </form>
                                    
                                </th>
                            </tr>
                            @endforeach

                            <style>
                                button.btn a {
                                    color:white; 
                                    text-decoration: none;
                                }
                            </style>

                        </tbody>
                    </table>

                    {{ $users->links() }}


                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
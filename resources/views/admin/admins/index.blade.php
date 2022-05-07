@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Admins Dashboard List') }}
                <button class="btn btn-success float-right"><a href="{{ route('create-admin') }}">Create Admin</a></button>
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

                            @foreach ($admins as $admin)
                            <tr>
                                <th scope="col">{{$admin->id}}</th>
                                <th scope="col">{{$admin->name}}</th>
                                <th scope="col">{{$admin->email}}</th>
                                <th scope="col">
                                    @if ($admin->privilege)
                                        Admin
                                    @else
                                        Bloger
                                    @endif
                                </th>
                                <th scope="col">{{ $admin->garegorian2jalali($admin->created_at) }}</th>
                                <th scope="col">{{ $admin->garegorian2jalali($admin->updated_at) }}</th>
                                <th scope="col">
                                    <button class="btn btn-primary"><a href="{{ route('edit-admin', ['admin'=>$admin->id]) }}">edit</a></button>
                                </th>

                                <th scope="col">
                                    <form method="POST" action="{{ route('delete-admin', ['admin'=>$admin->id]) }}">
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

                    {{ $admins->links() }}


                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
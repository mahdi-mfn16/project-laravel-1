@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Blogs Dashboard List') }}</div>

                <div class="card-body">
                    <table class="table table-striped shadow-sm p-3 mb-5 bg-white rounded">
                        <thead class="thead-dark">
                            <tr>

                                <th scope="col">id</th>
                                <th scope="col">title</th>
                                <th scope="col">description</th>
                                <th scope="col">publisher</th>
                                <th scope="col">Status</th>
                                <th scope="col">created_at</th>
                                <th scope="col">updated_at</th>
                                <th scope="col">edit</th>
                                <th scope="col">delete</th>


                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($blogs as $blog)
                            <tr>
                                <th scope="col">{{$blog->id}}</th>
                                <th scope="col">{{$blog->title}}</th>
                                <th scope="col">{{$blog->description}}</th>
                                <th scope="col">{{$blog->user->name}}</th>
                                <th scope="col">
                                    @if ($blog->status)
                                        Active
                                    @else
                                        Draft
                                    @endif
                                </th>
                                <th scope="col">{{ $blog->garegorian2jalali($blog->created_at) }}</th>
                                <th scope="col">{{ $blog->garegorian2jalali($blog->updated_at) }}</th>
                                <th scope="col">
                                    <button class="btn btn-primary"><a href="{{ route('admin-edit-blog', ['blog'=>$blog->id]) }}">edit</a></button>
                                </th>

                                <th scope="col">
                                    <form method="POST" action="{{ route('admin-delete-blog', ['blog'=>$blog->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">delete</button>
                                    </form>
                                    
                                </th>
                                <style>
                                button.btn a {
                                    color:white; 
                                    text-decoration: none;
                                }
                            </style>
                            </tr>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
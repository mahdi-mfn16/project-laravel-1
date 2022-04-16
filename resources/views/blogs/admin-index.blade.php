@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard List') }}</div>

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
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
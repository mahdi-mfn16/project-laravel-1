@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/blogs/edit.css') }}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create New Blog') }}</div>
                <form action="{{ route('create-blog') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="title" class="mt-2 col-md-2 col-form-label text-md-center">Title</label>
                        <div class="col-md-9">
                            <input id="title" type="text" class="mr-2 mt-3 form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}"  autocomplete="title" autofocus>
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="mt-2 col-md-2 col-form-label text-md-center">Description</label>
                        <div class="col-md-9">
                            <input id="description" type="text" class="mt-2 mr-2 form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="description" autofocus>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-md-2 col-form-label text-md-center">Status</label>
                        <div class="col-md-6 mt-2">
                            <select name="status" id="status">
                                <option value="0">Draft</option>
                                <option value="1">Publish</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label for="images" class="col-md-2 col-form-label text-md-center">Images</label>

                        <div class="col-md-8 ">
                        <span class="add-image" onclick="addImage(this)" >add Image</span>

                            @if ($errors->has('files'))
                            @foreach ($errors->get('files') as $error)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $error }}</strong>
                            </span>
                            @endforeach
                            @endif

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="body" class="col-md-2 col-form-label text-md-center">Content</label>
                        <div class="col-md-11 ml-4">
                            <textarea id="body" type="text" class="form-control ckeditor  @error('body') is-invalid @enderror" name="body" value="{{ old('body') }}" required autocomplete="body" autofocus>
                            </textarea>
                            @error('body')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('.ckeditor').ckeditor();
                            });
                        </script>
                    </div>

                    <button class="btn btn-success col-md-6 ml-4">Store Blog</button>

                </form>

                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/blogs/edit.js') }}"></script>

@endsection
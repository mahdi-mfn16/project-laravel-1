@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/blogs/edit.css') }}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Blog') }}</div>
                <form action="{{ route('edit-blog', ['blog'=>$blog->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="title" class="mt-2 col-md-2 col-form-label text-md-center">Title</label>
                        <div class="col-md-9">
                            <input id="title" type="text" class="mr-2 mt-3 form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ? old('title') : $blog->title }}" required autocomplete="title" autofocus>
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
                            <input id="description" type="text" class="mt-2 mr-2 form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ? old('description') : $blog->description }}" required autocomplete="description" autofocus>
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
                                <option {{ $blog->status === 0 ? "selected": "" }} value="0">Draft</option>
                                <option {{ $blog->status === 1 ? "selected": "" }} value="1">Publish</option>
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
                        <div class="col-md-8 ">
                            <ul id="imgs">
                                @foreach ($images as $image)
                                <li>
                                    <img data-blog="{{ $image->blog_id }}" id="{{ $image->id }}" src="{{ asset($image->path) }}" alt="">
                                    <a class="float-left btn btn-danger" data-image="{{ $image->id }}" onclick="deleteImage(this)" class="exit-x">X</a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <label for="body" class="col-md-2 col-form-label text-md-center">Content</label>
                        <div class="col-md-11 ml-4">
                            <textarea id="body" type="text" class="form-control ckeditor  @error('body') is-invalid @enderror" name="body" value="{{ old('body') ? old('body') : $blog->body }}" required autocomplete="body" autofocus>
                            {{ old('body') ? old('body') : $blog->body }}
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

                    <button class="btn btn-primary col-md-6 ml-4">Update Blog</button>

                </form>

                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/blogs/edit.js') }}"></script>
<script type="text/javascript">
   var ajaxRoute = "{{ route('delete-image') }}";
</script>
@endsection
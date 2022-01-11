@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        Post Create
                    </div>

                    <div class="card-body">
                        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <lable class="form-label">Post Title</lable>
                                <input type="text" class="form-control @error('title')
                                    is-invalid
                                @enderror" name="title" value="{{ old('title') }}">
                                @error('title')
                                    <span class="small text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Select Category</label>
                                <select class="form-select @error('category') is-invalid @enderror" name="category">
                                    @foreach (\App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <lable class="form-label">Photos</lable>
                                <input type="file" class="form-control @error('photo')
                                    is-invalid
                                @enderror" name="photo[]" value="{{ old('photo') }}" multiple>
                                @error('photo')
                                    <span class="small text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Post Description</label>
                                <textarea type="text" rows="10" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                                    {{ old('description') }}
                                </text-area>
                                @error('description')
                                    <span class="samll text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" required>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Confirm</label>
                                </div>
                                <button class="btn btn-lg btn-primary">Create Post</button>
                            </div>
                        </form>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

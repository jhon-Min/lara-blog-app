@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <a href="{{ route('tag.index') }}" class="btn btn-success">Tag Lists</a>
                </div>

                <div class="card">
                    <div class="card-header">
                        Edit tag
                    </div>

                    <div class="card-body">
                        <form action="{{ route('tag.update', $tag->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-8 col-md-4">
                                    <input type="text" class="form-control @error('title')
                                        is-invalid
                                    @enderror" name="title" value="{{ old('title', $tag->title) }}">
                                    @error('title')
                                        <span class="bold text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-4">
                                    <button class="btn btn-primary">Update Tag</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

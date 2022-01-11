@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        {{ $post->title }}
                    </div>

                    <div class="card-body py-4">
                        <p class="mb-0 ">{{ $post->description }}</p>
                    </div>
                </div>

                <a href="{{ route('post.index') }}" class="btn btn-secondary mt-4">Back to</a>
            </div>
        </div>
    </div>
@endsection

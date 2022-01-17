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

                        <div class="mt-3">
                            @foreach ($post->tags as $tag)
                            <span class="badge bg-primary small">
                                <i class="fas fa-hashtag"></i>
                                {{ $tag->title }}
                            </span>
                            @endforeach
                        </div>
                    </div>

                </div>

                <a href="{{ route('post.index') }}" class="btn btn-secondary mt-4">Back to</a>
            </div>
        </div>
    </div>
@endsection

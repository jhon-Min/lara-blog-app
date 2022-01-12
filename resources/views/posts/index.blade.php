@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Post Lists
                    </div>

                    <div class="card-body">

                       <div class="d-flex justify-content-between">
                            <div class="mb-3">
                                <a href="{{ route('post.create') }}" class="btn btn-primary">Create Post</a>

                                @isset(request()->search)
                                <a href="{{ route('post.index') }}" class="btn btn-outline-primary ms-3">
                                    <i class="feather-list"></i>
                                    All Post
                                </a>
                                <span>Search By : " {{ request()->search }} "</span>
                            @endisset
                            </div>

                            <form method="get" class="w-25">
                                <div class="input-group ">
                                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search Something">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search fa-fw"></i>
                                    </button>
                                </div>
                            </form>
                       </div>

                        @if (session('status'))
                            <p class="alert alert-success">
                                {{ session('status') }}
                            </p>
                        @endif

                        @if (session('delStatus'))
                            <p class="alert alert-danger">{{ session('delStatus') }}</p>
                        @endif

                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Photos</th>
                                    <th>Is Publish</th>
                                    <th>Category</th>
                                    <th>Owner</th>
                                    <th>Control</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td class="small">{{ Str::words($post->title, 5, '...') }}</td>
                                        <td>
                                           @forelse ($post->photos as $photo)
                                            <img src="{{ asset('storage/thumbnail/'.$photo->name) }}" height="30" alt="">
                                           @empty
                                            No Photo
                                           @endforelse
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" {{ $post->is_publish ? 'checked':'' }}>
                                                <label class="form-check-label" for="flexSwitchCheckDefault">
                                                    {{ $post->is_publish ? 'Publish' : 'Unpublish' }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{ $post->category->title }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>
                                           <div class="btn-group">
                                                <a href="{{ route('post.show', $post->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-info-circle fa-fw"></i>
                                                </a>
                                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-pencil-alt fa-fw"></i>
                                                </a>
                                                <button form="postDelForm{{ $post->id }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-trash-alt fa-fw"></i>
                                                </button>
                                           </div>

                                            <form action="{{ route('post.destroy', $post->id) }}" class="d-inline-block" id="postDelForm{{ $post->id }}" method="POST">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                        <td>
                                            <p class="small mb-0">
                                                <i class="fas fa-calendar"></i>
                                                {{ $post->created_at->format("Y-m-d") }}
                                            </p>
                                            <p class="mb-0 small">
                                                <i class="fas fa-clock"></i>
                                                {{ $post->created_at->format("H:i a") }}
                                            </p>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">There is no Post</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            {{ $posts->appends(request()->all())->links() }}
                            <p class="font-weight-bold mb-0 h4">Total : {{ $posts->total() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

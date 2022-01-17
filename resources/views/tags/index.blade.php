@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <a href="{{ route('tag.create') }}" class="btn btn-success">Create Tag</a>
                </div>

                <div class="card">
                    <div class="card-header">
                        Tag Lists
                    </div>

                    <div class="card-body">

                        <table class="table table-hover table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Owner</th>
                                    <th>Control</th>
                                    <th>Created</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($tags as $tag)
                                    <tr>
                                        <td>{{ $tag->id }}</td>
                                        <td>{{ $tag->title }}</td>
                                        <td>{{ $tag->user->name ?? "Unknown user"}}</td>
                                        <td>
                                            <a href="{{ route('tag.edit', $tag->id) }}" class="btn btn-sm btn-secondary">
                                                <i class="fas fa-pencil-alt fa-fw"></i>
                                            </a>

                                            <form action="{{ route('tag.destroy', $tag->id) }}" class="d-inline ms-1" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt fa-fw"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <small>
                                                <i class="fas fa-calendar"></i>
                                                {{ $tag->created_at->format('Y-m-d') }}
                                            </small>
                                            <br>
                                            <small>
                                                <i class="fas fa-clock"></i>
                                                {{ $tag->created_at->format('H:i a') }}
                                            </small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">There is no tag</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $tags->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

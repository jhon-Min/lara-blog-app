@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <a href="{{ route('category.create') }}" class="btn btn-success">Create Category</a>
                </div>

                <div class="card">
                    <div class="card-header">
                        Category Lists
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <p class="alert alert-success">
                                {{ session('status') }}
                            </p>
                        @endif

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
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->title }}</td>
                                        <td>{{ $category->user->name ?? "Unknown User" }}</td>
                                        <td>
                                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-secondary">
                                                <i class="fas fa-pencil-alt fa-fw"></i>
                                            </a>

                                            <form action="{{ route('category.destroy', $category->id) }}" class="d-inline ms-1" method="POST">
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
                                                {{ $category->created_at->format('Y-m-d') }}
                                            </small>
                                            <br>
                                            <small>
                                                <i class="fas fa-clock"></i>
                                                {{ $category->created_at->format('H:i a') }}
                                            </small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">There is no Category</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{ auth()->user()->name }}'s photo
                    </div>
                    <div class="card-body overflow-scroll">
                      <div class="d-flex">
                        @forelse (auth()->user()->photos as $photo)
                        <div class="position-relative">
                            <a class="venobox" data-gall="img" href="{{ asset('storage/photo/'.$photo->name) }}">
                                <img src="{{ asset('storage/thumbnail/'.$photo->name) }}" class="me-3 rounded-3 shadow-sm" height="100" alt="image alt"/>
                             </a>
                        </div>
                        @empty
                         <p class="text-muted ms-2 py-4">No Photo</p>
                        @endforelse
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

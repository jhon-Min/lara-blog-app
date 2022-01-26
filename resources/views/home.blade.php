@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-alert>
                San Kyi Tar Par
            </x-alert>

            <x-alert type="danger">
                Hello World
            </x-alert>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <br>

                    @nsm
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

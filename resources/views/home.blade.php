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

                    {{ env('APP_NAME') }}

                    <p>{{ env('MY_AGE', '24') }}</p>
                    <p>{{ env('DB_CONNECTION') }}</p>
                    <p>{{ now() }}</p>
                    <p>{{ config('app.timezone') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('User Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
                <div class="btn btn-primary my-3">
                    <a class="badge text-bg-primary fs-6" href="{{ route('admin.projects.index') }}">Look the projects</a>
                </div>

                <div class="btn btn-primary my-3">
                    <a class="badge text-bg-primary fs-6" href="{{ route('admin.types.index') }}">Look the types</a>
                </div>
                <br>
                <div class="btn btn-success my-3">
                    <a class="badge text-bg-success fs-6" href="{{ route('admin.projects.create') }}">create a New
                        projects</a>
                </div>
                <div class="btn btn-success my-3">
                    <a class="badge text-bg-success fs-6" href="{{ route('admin.types.create') }}">create a New
                        type</a>
                </div>
            </div>
        </div>

    </div>
@endsection

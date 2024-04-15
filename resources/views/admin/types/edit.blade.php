@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- @if ($errors->any())
            <div class="alert alert-danger my-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <h1 class="fs-4 text-secondary my-4">
            {{ __('Add new type') }}
        </h1>
        <form class="row" action="{{ route('admin.types.update', $type) }}" method="POST">
            @method('PATCH')
            @csrf
            {{-- edit Nome --}}
            <div class="col-4">
                <label for="name" class="form-label">Nome</label>
                <input type="name" name="name" id="name" class="form-control" value="{{ $type->name }}">
            </div>

            {{-- bottone conferma edit --}}
            <div class="col-12 my-3">
                <button class="btn btn-success">salva</button>
            </div>
        </form>

        {{-- bottone ritorno alla lista --}}
        <div class="btn btn-primary my-2">
            <a class="text-bg-primary text-decoration-none fs-6" href="{{ route('admin.types.index') }}">Back
                types</a>
        </div>
    </div>
@endsection

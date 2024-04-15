@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger my-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1 class="fs-4 text-secondary my-4">
            {{ __('Edit project') }}
        </h1>
        <form class="row" action="{{ route('admin.projects.update', $project) }}" method="POST"
            enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            {{-- edit Titolo --}}
            <div class="col-4">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $project['title'] }}">
            </div>
            {{-- edit Tipo --}}
            <div class="col-4">
                <label for="type_id" class="form-label">Tipo</label>
                <select class="form-select" id="type_id" name="type_id">
                    @foreach ($types as $type)
                        <option {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}
                            value="{{ $type->id }}">
                            {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- edit Descrizione --}}
            <div class="col-8">
                <div class="my-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $project['description'] }}"</textarea>
                </div>
            </div>
            {{-- input tecnologia --}}
            <div class="col-4">
                <div class="my-3">
                    <label class="form-label">Technologies</label>

                    <div class="form-check @error('technologies') is-invalid @enderror p-0">
                        @foreach ($technologies as $technology)
                            <input type="checkbox" id="tag-{{ $technology->id }}" value="{{ $technology->id }}"
                                name="technologies[]" class="form-check-control"
                                @if (in_array($technology->id, old('technologies', $project_technologies ?? []))) checked @endif>
                            <label for="tag-{{ $technology->id }}">
                                {{ $technology->name }}
                            </label>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- input file(image) --}}
            <div class="col-12">
                <div class="my-3 input-group">
                    <input type="file" name="image" id="image" class="form-control">
                    <label for="image" class="input-group-text">Inserisci immagine</label>
                </div>
            </div>
            {{-- se il file(image) è gia presente --}}
            @if (!empty($project->image))
                <div class="row">
                    <div class="col-6">
                        <img src="{{ asset('storage/' . $project->image) }}" alt="">
                    </div>
            @endif
            {{-- bottone conferma edit --}}
            <div class="col-8">
                <div class="my-3">
                    <button class="btn btn-success">Modifica</button>
                </div>
            </div>
        </form>
        <div class="col-8">
            <div class="my-3">
                <a class="btn text-bg-primary text-decoration-none fs-6"
                    href="{{ route('admin.projects.index') }}">Annulla</a>
            </div>
        </div>
    </div>
@endsection

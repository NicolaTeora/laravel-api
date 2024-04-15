@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Show details') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Nome tipologia</div>

                    <div class="card-body">
                        <ul>
                            <li>
                                <h3>{{ $type->name }}</h3>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        @foreach ($type->projects as $project)
                            <ul>
                                <li>ID: {{ $project->id }}</li>
                                <li>
                                    <strong>Titolo: {{ $project->title }}</strong>
                                </li>
                                <li>Descrizione: <br>
                                    {{ $project->description }}
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
                <div class="btn btn-primary my-3">
                    <a class="badge text-bg-primary fs-6" href="{{ route('admin.types.index') }}">Back the types</a>
                </div>
                {{-- Todo: cancellazione --}}
                {{-- <div class="btn btn-primary my-3">
                    <a class="badge text-decoration-none text-bg-danger fs-6" data-bs-toggle="modal"
                        data-bs-target="#modal-destroy-{{ $project->id }}" href="{{ route('admin.projects.destroy', $project) }}">Delete this
                        project</a>
                </div> --}}
            </div>
        </div>

    </div>
@endsection

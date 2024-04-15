@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            My Projects
        </h2>

        <div class="container">

            <div class="row mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">description</th>
                            <th scope="col">type</th>
                            <th scope="col">technology</th>
                            <th scope="col">actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <th scope="row">{{ $project->id }}</th>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->description }}</td>
                                <td>{{ $project->type?->name }}</td>
                                <td>
                                    @foreach ($project->technologies as $technology)
                                        {{ $technology->name }} @unless ($loop->last)
                                            ,
                                        @else
                                            .
                                        @endunless
                                    @endforeach
                                </td>
                                <td>
                                    <a class="badge text-decoration-none text-bg-primary fs-6"
                                        href="{{ route('admin.projects.show', $project->id) }}">info</a>
                                    <a class="badge text-decoration-none text-bg-success fs-6"
                                        href="{{ route('admin.projects.edit', $project->id) }}">edit</a>
                                    <a class="btn badge text-decoration-none text-bg-danger fs-6" data-bs-toggle="modal"
                                        data-bs-target="#modal-destroy-{{ $project->id }}">delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <a class="badge text-bg-warning text-decoration-none fs-6" href="{{ route('admin.dashboard') }}">Back Dashboard</a>
        <a class="badge text-bg-primary text-decoration-none fs-6" href="{{ route('home') }}">Back Home</a>
        <a class="badge text-bg-success text-decoration-none fs-6" href="{{ route('admin.projects.create') }}">Add
            project</a>

    </div>
@endsection

@section('modal')
    @foreach ($projects as $project)
        <div class="modal fade modal-dialog modal-dialog-centered" id="modal-destroy-{{ $project->id }}"
            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminare {{ $project['title'] }} ??</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Procedere alla cancellazione del progetto??
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

                        {{-- form eliminazione --}}
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

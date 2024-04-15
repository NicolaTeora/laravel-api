<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * //@return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.index', compact('projects'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * //@return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $project = new Project;
        $technologies = Technology::orderBy('name')->get();
        return view('admin.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * //@return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        //validazione
        $request->validated();
        //recupero dati validati
        $data = $request->all();


        $project = new Project;
        //fillare i dati ricevuti dal form
        $project->fill($data);

        // se inserisco nuova img
        if (Arr::exists($data, 'image')) {
            //recupero path del file(image)
            $img_path = Storage::put('uploads/projects', $data['image']);
            $project->image = $img_path;
        }
        //salvo il project nel database
        $project->save();

        //realaziono le tecnologie associate
        if (Arr::exists($data, "technologies")) $project->technologies()->attach($data["technologies"]);

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * //@return \Illuminate\Http\Response
     */
    public function show(Project $project, Type $type)
    {
        return view('admin.show', compact('project', 'type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * //@return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::orderBy('name')->get();
        $project_technologies = $project->technologies->pluck('id')->toArray();
        return view('admin.edit', compact('project', 'types', 'technologies', 'project_technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * //@return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->all();

        // se inserisco nuova img
        if (Arr::exists($data, 'image')) {
            // se esisteva gia un'img...
            if (!empty($project->image)) {
                // ...la cancello
                Storage::delete($project->image);
            }
            //recupero nuova img
            $img_path = Storage::put('uploads/projects', $data['image']);
            $project->image = $img_path;
        }


        $project->update($data);

        if (Arr::exists($data, "technologies"))
            $project->technologies()->sync($data["technologies"]);
        else
            $project->technologies()->detach();

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * //@return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->technologies()->detach();
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}

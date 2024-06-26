<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * //@return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * //@return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.types.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * //@return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $type = new Type;
        $type->fill($data);
        $type->save();

        return redirect()->route('admin.types.show', $type);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * //@return \Illuminate\Http\Response
     */
    public function show(Type $type, Project $project)
    {
        return view('admin.types.show', compact('type', 'project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $project
     * //@return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $project
     * //@return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $data = $request->all();
        $type->update($data);

        return redirect()->route('admin.types.show', $type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $project
     * //@return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        foreach ($type->projects as $project) {
            $project->delete();
        }

        $type->delete();
        return redirect()->route('admin.types.index');
    }
}

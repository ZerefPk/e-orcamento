<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class ProjectController extends Controller
{
    function show(): View
    {
        if (request('q')) {
            $data = request('q');
            $projects = Project::where('description', 'like', $data . '%');
            $projects = $projects->paginate(15);
        } else {
            $projects = Project::paginate(15);
        }

        return view('config.projects.index', ['projects' => $projects]);
    }

    function create(): View
    {
        return view('config.projects.create');
    }

    function store(ProjectRequest $request)
    {
        $request = $request->all();

        $save = Project::create($request);
        if ($save) {
            Alert::success('Projeto', 'Criado com sucesso');
            return redirect()->route('projects.index');
        }
        Alert::error('Projeto', 'Erro ao criar');
        return redirect()->back();
    }

    public function details(Project $project): View
    {
        return view('config.projects.show', ['project' => $project]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\BudgetUnit;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class ProjectController extends Controller {
    public function show(): View {
        if (request('q')) {
            $data = request('q');
            $projects = Project::where('description', 'like', $data.'%');
            $projects = $projects->paginate(15);
        } else {
            $projects = Project::paginate(15);
        }

        return view('project.index', ['projects' => $projects]);
    }

    public function create(): View {
        $budgetUnits = BudgetUnit::all();

        return view('project.create', ['budgetUnits' => $budgetUnits]);
    }

    public function store(ProjectRequest $request) {
        $request = $request->all();

        $save = Project::create($request);
        if ($save) {
            Alert::success('Projeto', 'Criado com sucesso');

            return redirect()->route('projects.index');
        }
        Alert::error('Projeto', 'Erro ao criar');

        return redirect()->back();
    }

    public function details(Project $project): View {
        return view('project.show', ['project' => $project]);
    }

    public function edit(Project $project): View {
        $budgetUnits = BudgetUnit::all();

        return view('project.edit', ['project' => $project, 'budgetUnits' => $budgetUnits]);
    }

    public function update(Project $project, ProjectRequest $request) {
        $request = $request->all();

        $update = $project->update($request);
        if ($update) {
            Alert::success('Projeto', 'Atualizado com sucesso');

            return redirect()->route('projects.index');
        }
        Alert::error('Projeto', 'Erro ao Atualizar');

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\NatureExpenseUpdateRequest;
use App\Models\NatureExpense;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class NatureExpenseController extends Controller {
    public function show(): View {
        if (request('q')) {
            $data = request('q');
            
            $natureExpenses = NatureExpense::where('description', 'like', $data.'%');
            $natureExpenses = $natureExpenses->paginate(15);
        } else {
            $natureExpenses = NatureExpense::paginate(15);
        }

        return view('config.nature-expense.index', ['natureExpenses' => $natureExpenses]);
    }

    public function create(): View {
        return view('config.nature-expense.create');
    }

    public function store(Request $request) {
        // Load CSV contents to array
        $file = $request->file('csv');
        $handle = fopen($file->path(), 'r');

        $header = fgetcsv($handle, 1000, $request->input('delimiter'));

        while ($row = fgetcsv($handle, 1000, $request->input('delimiter'))) {
            $natureExpenses[] = array_combine($header, $row);
        }

        fclose($handle);

        // Validate array items
        $errored_natureExpenses_alert_string = '';
        $errored_natureExpenses_count = 0;
        $succeeded_natureExpenses_count = 0;

        foreach ($natureExpenses as $natureExpense) {
            $cod_arr = explode('.', $natureExpense['COD']);

            if (count($cod_arr) != 6 || count(str_split($cod_arr[array_key_last($cod_arr)])) != 2 || count(NatureExpense::where('cod', '=', $natureExpense['COD'])->get()) > 0) {
                $errored_natureExpenses_count++;
                $errored_natureExpenses_alert_string = $errored_natureExpenses_alert_string.'COD: '.$natureExpense['COD'].', DESCRICAO: '.$natureExpense['DESCRICAO'].'</br>';
            } else {
                $save = NatureExpense::create([
                    'cod' => $natureExpense['COD'],
                    'description' => $natureExpense['DESCRICAO'],
                    'type' => strtolower($natureExpense['TIPO']) == 'corrente' ? true : false,
                    'status' => strtolower($natureExpense['STATUS']) == 'ativo' ? true : false,
                ]);

                if (! $save) {
                    $errored_natureExpenses_count++;
                    $errored_natureExpenses_alert_string = $errored_natureExpenses_alert_string.'COD: '.$natureExpense['COD'].', DESCRICAO: '.$natureExpense['DESCRICAO'].'</br>';
                } else {
                    $succeeded_natureExpenses_count++;
                }
            }
        }

        if ($succeeded_natureExpenses_count == 0) {
            Alert::error('Natureza da Despesa', 'Não foi possível inserir as contas contábeis presentes no arquivo.');
        } elseif ($errored_natureExpenses_count > 0) {
            Alert::warning('Natureza da Despesa', 'Foram inseridas '.$succeeded_natureExpenses_count.' contas contábeis com sucesso, outras '.$errored_natureExpenses_count.' falharam.</br></br>Lista de contas contábeis que falharam:</br></br>'.$errored_natureExpenses_alert_string)->tohtml();
        } else {
            Alert::success('Natureza da Despesa', 'Todas as contas contábeis foram inseridas com sucesso.');
        }

        return redirect()->route('natureExpense.index');
    }
    
    public function details(NatureExpense $natureExpense): View {
        return view('config.nature-expense.show', ['natureExpense' => $natureExpense]);
    }

    public function edit(NatureExpense $natureExpense): View {
        return view('config.nature-expense.edit', ['natureExpense' => $natureExpense]);
    }

    public function update(NatureExpense $natureExpense, NatureExpenseUpdateRequest $request) {

        $update = $natureExpense->update($request->all());

        if (! $update) {
            Alert::error('Natureza da Despesa', 'Ocorreu um erro ao atualizar.');

            return redirect()->back();
        } else {
            Alert::success('Natureza da Despesa', 'Atualizado com sucesso');
        }

        return redirect()->route('natureExpense.index');

    }
}

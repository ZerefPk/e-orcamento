<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseElementUpdateRequest;
use App\Models\ExpenseElement;
use App\Models\FinancialAccount;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class ExpenseElementController extends Controller {
    public function show(): View {
        if (request('q')) {
            $data = request('q');
            $expenseElements = ExpenseElement::where('description', 'like', $data.'%');
            $expenseElements = $expenseElements->paginate(15);
        } else {
            $expenseElements = ExpenseElement::paginate(15);
        }

        return view('config.elements.index', ['expenseElements' => $expenseElements]);
    }

    public function create(): View {
        $financialAccounts = FinancialAccount::all();

        return view('config.elements.create', ['financialAccounts' => $financialAccounts]);
    }

    public function store(Request $request) {
        // Load CSV contents to array
        $file = $request->file('csv');
        $handle = fopen($file->path(), 'r');

        $header = fgetcsv($handle, 1000, $request->input('delimiter'));

        while ($row = fgetcsv($handle, 1000, $request->input('delimiter'))) {
            $expenseElements[] = array_combine($header, $row);
        }

        fclose($handle);

        // Validate array items
        $errored_expense_elements_alert_string = '';
        $errored_expense_elements_count = 0;
        $succeeded_expense_elements_count = 0;

        $financialAccount = FinancialAccount::findOrFail($request->input('financialAccountId'));

        foreach ($expenseElements as $expenseElement) {
            $cod_arr = explode('.', $expenseElement['COD']);

            $last_cod = array_values(array_slice($cod_arr, -2, 2, true));

            $isElementCodeDigitsValid = strlen($last_cod[0]) == 2 && strlen($last_cod[1]) == 2;

            if (count($cod_arr) != 8 || ! str_starts_with($expenseElement['COD'], $financialAccount->cod) || count(ExpenseElement::where('cod', '=', $expenseElement['COD'])->get()) > 0 || ! $isElementCodeDigitsValid) {
                $errored_expense_elements_count++;
                $errored_expense_elements_alert_string = $errored_expense_elements_alert_string.'COD: '.$expenseElement['COD'].', DESCRICAO: '.$expenseElement['DESCRICAO'].' - Malformado</br>';
            } else {
                $save = ExpenseElement::create([
                    'cod' => $expenseElement['COD'],
                    'description' => $expenseElement['DESCRICAO'],
                    'financial_account_id' => $request->input('financialAccountId'),
                    'status' => strtolower($expenseElement['STATUS']) == 'ativo' ? true : false,
                ]);

                if (! $save) {
                    $errored_expense_elements_count++;
                    $errored_expense_elements_alert_string = $errored_expense_elements_alert_string.'COD: '.$expenseElement['COD'].', DESCRICAO: '.$expenseElement['DESCRICAO'].' - Erro na Inserção</br>';
                } else {
                    $succeeded_expense_elements_count++;
                }
            }
        }

        if ($succeeded_expense_elements_count == 0) {
            Alert::error('Elemento de Despesa', 'Não foi possível inserir os Elementos de Despesa presentes no arquivo.');
        } elseif ($errored_expense_elements_count > 0) {
            Alert::warning('Elementos de Despesa', 'Foram inseridos '.$succeeded_expense_elements_count.' Elementos de Despesa com sucesso, outros '.$errored_expense_elements_count.' falharam.</br></br>Lista de Elementos de Despesa que falharam:</br></br>'.$errored_expense_elements_alert_string)->tohtml();
        } else {
            Alert::success('Elementos de Despesa', 'Todos os Elementos de Despesa foram inseridos com sucesso.');
        }

        return redirect()->route('elements.index');
    }

    public function details(ExpenseElement $expenseElement): View {
        return view('config.elements.show', ['expenseElement' => $expenseElement]);
    }

    public function edit(ExpenseElement $expenseElement): View {

        return view('config.elements.edit', ['expenseElement' => $expenseElement]);
    }

    public function update(ExpenseElement $expenseElement, ExpenseElementUpdateRequest $request) {

        $update = $expenseElement->update($request->all());

        if (! $update) {
            Alert::error('Elemento de Despesa', 'Ocorreu um erro ao atualizar.');

            return redirect()->back();
        } else {
            Alert::success('Elemento de Despesa', 'Atualizado com sucesso');
        }

        return redirect()->route('elements.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\FinancialAccount;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class FinancialAccountController extends Controller
{
    function show(): View
    {
        if (request('q')) {
            $data = request('q');
            $financialAccounts = FinancialAccount::where('description', 'like', $data . '%');
            $financialAccounts = $financialAccounts->paginate(15);
        } else {
            $financialAccounts = FinancialAccount::paginate(15);
        }

        return view('config.accounts.index', ['financialAccounts' => $financialAccounts]);
    }

    function create(): View
    {
        return view('config.accounts.create');
    }

    function store(Request $request)
    {
        // Load CSV contents to array
        $file = $request->file('csv');
        $handle = fopen($file->path(), "r");

        $header = fgetcsv($handle, 1000, $request->input('delimiter'));

        while ($row = fgetcsv($handle, 1000, $request->input('delimiter'))) {
            $accounts[] = array_combine($header, $row);
        }

        fclose($handle);

        // Validate array items
        $errored_accounts_alert_string = '';
        $errored_accounts_count = 0;
        $succeeded_accounts_count = 0;

        foreach ($accounts as $account) {
            $cod_arr = explode('.', $account['COD']);

            if (count($cod_arr) != 5) {
                $errored_accounts_count++;
                $errored_accounts_alert_string = $errored_accounts_alert_string . 'COD: ' . $account['COD'] . ', DESCRICAO: ' . $account['DESCRICAO'] . "</br>";
            } else if (!FinancialAccount::where('cod', '=', $account["COD"])) {
                $save = FinancialAccount::create([
                    "cod" => $account["COD"],
                    "description" => $account["DESCRICAO"],
                    "type" => strtolower($account["TIPO"]) == "corrente" ? true : false,
                    "status" => strtolower($account["STATUS"]) == "ativo" ? true : false,
                ]);

                if (!$save) {
                    $errored_accounts_count++;
                    $errored_accounts_alert_string = $errored_accounts_alert_string . 'COD: ' . $account['COD'] . ', DESCRICAO: ' . $account['DESCRICAO'] . "</br>";
                } else {
                    $succeeded_accounts_count++;
                }
            } else {
                $errored_accounts_count++;
                $errored_accounts_alert_string = $errored_accounts_alert_string . 'COD: ' . $account['COD'] . ', DESCRICAO: ' . $account['DESCRICAO'] . "</br>";
            }
        }

        if ($succeeded_accounts_count == 0) {
            Alert::error('Conta Contábil', 'Não foi possível inserir as contas contábeis presentes no arquivo.');
        } else if ($errored_accounts_count > 0) {
            Alert::warning('Conta Contábil', "Foram inseridas " . $succeeded_accounts_count . " contas contábeis com sucesso, outras " . $errored_accounts_count . " falharam.</br></br>Lista de contas contábeis que falharam:</br></br>" . $errored_accounts_alert_string)->tohtml();
        } else {
            Alert::success('Conta Contábil', 'Todas as contas contábeis foram inseridas com sucesso.');
        }

        return redirect()->route('accounts.index');
    }

    public function details(FinancialAccount $financialAccount): View
    {
        return view('config.accounts.show', ['financialAccount' => $financialAccount]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PredictedUnitController extends Controller {
    //
    public function show(): View {

        return view('predicted-unit.index');

    }
}

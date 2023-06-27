<?php

namespace App\Http\Controllers;

use App\Models\Pot;
use Inertia\Inertia;
use URL;

class TransactionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pot $pot, $method)
    {
        if ($method == 'withdraw' || 'add') {
            return Inertia::render('Transactions/Create', [
                'pot' => $pot,
                'method' => $method,
                'base_url' => URL::to(''),
                'user' => Auth(),
            ]);
        }
    }
}

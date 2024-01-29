<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LoanController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('Loan/GetLoan'); 
    }
}

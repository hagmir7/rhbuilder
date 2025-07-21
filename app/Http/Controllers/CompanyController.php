<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function index()
    {
        return Company::select('id', 'name', 'logo')->get();
    }


    public function store()
    {
        return [];
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardWaliController extends Controller
{
    public function index()
    {
        return view('wali.dashboard_index', [
            'title' => 'Wali'
        ]);
    }
}

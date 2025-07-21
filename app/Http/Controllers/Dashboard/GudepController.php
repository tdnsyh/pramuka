<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GudepController extends Controller
{
    public function gudepDashboard()
    {
        return view('dashboard.gudep.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
 /**
     * Affiche la page du tableau de bord.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin-dashboard.users.index');
    }
}

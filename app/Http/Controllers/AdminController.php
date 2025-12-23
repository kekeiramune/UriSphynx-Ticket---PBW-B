<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('admin'), 403);

        return view('admin.dashboardadmin');
    }

    public function transactions()
    {
        abort_unless(Gate::allows('admin'), 403);

        return view('admin.transadmin');
    }
}

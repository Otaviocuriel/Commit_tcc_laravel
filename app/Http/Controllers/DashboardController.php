<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        return match ($user->role) {
            'company' => view('dashboard.company', compact('user')),
            default => view('dashboard.user', compact('user')),
        };
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\LoanApplication;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Dashboard controller
     */
    public function index()
    {
        $isAdmin = auth()->user()->is_admin;

        $totalApplications = $isAdmin
                            ? LoanApplication::query()->count()
                            : LoanApplication::query()->where('user', auth()->user()->id)->count();

        $totalApplicationsPending = $isAdmin
            ? LoanApplication::query()->where('status', 'Pending')->count()
            : LoanApplication::query()
                ->where('user', auth()->user()->id)
                ->where('status', 'Pending')
                ->count();

        $totalApplicationsApproved = $isAdmin
            ? LoanApplication::query()->where('status', 'Approved')->count()
            : LoanApplication::query()
                ->where('user', auth()->user()->id)
                ->where('status', 'Approved')
                ->count();

        $totalApplicationsRejected = $isAdmin
            ? LoanApplication::query()->where('status', 'Rejected')->count()
            : LoanApplication::query()
                ->where('user', auth()->user()->id)
                ->where('status', 'Rejected')
                ->count();

        $data = collect([
            'total_users' => User::query()->count(),
            'total_admins' => User::query()->where('is_admin', 1)->count(),
            'total_applications' => $totalApplications,
            'total_applications_pending' => $totalApplicationsPending,
            'total_applications_approved' => $totalApplicationsApproved,
            'total_applications_rejected' => $totalApplicationsRejected,
        ]);

        return view('home', compact('data'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Setting;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // AdminController.php
    public function index()
    {
        $totalVotes = Vote::count();

        $totalUsers = User::where('role', 'voter')->count();

        $leadingCandidate = Candidate::withCount('votes')->orderBy('votes_count', 'desc')->first();

        // Mengambil data suara per kandidat
        $candidates = Candidate::withCount('votes')->orderBy('candidate_number', 'asc')->get();

        $absentVoters = User::where('role', 'voter')->doesntHave('vote')->get();

        $status = Setting::where('key', 'voting_status')->first();

        return view('admin.dashboard', compact('totalVotes', 'totalUsers', 'candidates', 'absentVoters', 'leadingCandidate', 'status'));
    }

    public function toggleVotingStatus()
    {
        $status = Setting::where('key', 'voting_status')->first();

        $newStatus = ($status->value == 'open') ? 'closed' : 'open';
        $status->update(['value' => $newStatus]);

        return redirect()->back()->with('success', "Status pemilihan berhasil diubah menjadi: " . strtoupper($newStatus));
    }
}

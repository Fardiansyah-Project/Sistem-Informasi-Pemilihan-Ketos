<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Setting;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $totalVotes = Vote::count();

        $totalUsers = User::where('role', 'voter')->count();

        $leadingCandidate = Candidate::withCount('votes')->orderBy('votes_count', 'desc')->first();

        // Mengambil data suara per kandidat
        $candidates = Candidate::withCount('votes')->orderBy('candidate_number', 'asc')->get();

        $absentVoters = User::where('role', 'voter')->doesntHave('vote')->get();

        $status = Setting::where('key', 'voting_status')->first();

        return view('home', compact('totalVotes', 'totalUsers', 'candidates', 'absentVoters', 'leadingCandidate', 'status'));
    }
}

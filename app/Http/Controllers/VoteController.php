<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Setting;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasVoted()) {
            $myVote = $user->vote->candidate;
            return view('voting.index', compact('myVote'));
        }

        $candidates = Candidate::all();
        return view('voting.index', compact('candidates'));
    }

    public function store(Request $request)
    {
        $status = Setting::where('key', 'voting_status')->first();

        if ($status->value == 'closed') {
            return redirect()->back()->with('error', 'Maaf, waktu pemilihan telah berakhir atau dinonaktifkan.');
        }
        
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        if (auth()->user()->hasVoted()) {
            return redirect()->back()->with('error', 'Anda sudah menggunakan hak pilih!');
        }

        if (auth()->user()->role != 'voter') {
            return redirect()->back()->with('error', 'Maaf, Admin tidak memiliki hak untuk memilih.');
        }

        Vote::create([
            'user_id' => auth()->id(),
            'candidate_id' => $request->candidate_id,
        ]);

        Candidate::where('id', $request->candidate_id)->increment('vote_count');

        return redirect()->route('vote.index')->with('success', 'Pilihan berhasil disimpan!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $data = Candidate::all();

        return view('admin.candidate.index', compact('data'));
    }

    public function create()
    {
        return view('admin.candidate.create');
    }
    
    public function edit($id)
    {
        $candidate = Candidate::find($id);
        return view('admin.candidate.edit', compact('candidate'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'candidate_number' => 'required|numeric',
            'vision_mission' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'Nama kandidat diperlukan',
            'candidate_number.required' => 'Nomor kandidat diperlukan',
            'candidate_number.numeric' => 'Nomor kandidat harus angka',
            'vision_mission.required' => 'Visi dan misi kandidat diperlukan',
            'photo.image' => 'File yang diunggah harus gambar',
            'photo.mimes' => 'Format gambar yang diperbolehkan adalah jpeg, png, jpg, gif, svg',
            'photo.max' => 'Ukuran maksimal gambar adalah 2MB',
        ]);

        $candidate = new Candidate();
        $candidate->name = $request->name;
        $candidate->candidate_number = $request->candidate_number;
        $candidate->vision_mission = $request->vision_mission;
        if ($request->hasFile('photo')) {
            if ($candidate->photo && file_exists(storage_path('app/public/uploads/candidate/' . $candidate->photo))) {
                unlink(storage_path('app/public/uploads/candidate/' . $candidate->photo));
            }
            $filename = time() . '_' . $request->file('photo')->getClientOriginalName();

            $request->file('photo')->storeAs('uploads/candidate', $filename);

            $candidate->photo = $filename;
        } else {
            $candidate->photo = null;
        }

        $candidate->save();

        return redirect()->route('candidate.index')->with('success', 'Kandidat berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'candidate_number' => 'required|numeric',
            'vision_mission' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'Nama kandidat diperlukan',
            'candidate_number.required' => 'Nomor kandidat diperlukan',
            'candidate_number.numeric' => 'Nomor kandidat harus angka',
            'vision_mission.required' => 'Visi dan misi kandidat diperlukan',
            'photo.image' => 'File yang diunggah harus gambar',
            'photo.mimes' => 'Format gambar yang diperbolehkan adalah jpeg, png, jpg, gif, svg',
            'photo.max' => 'Ukuran maksimal gambar adalah 2MB',
        ]);

        $candidate = Candidate::find($id);
        $candidate->name = $request->name;
        $candidate->candidate_number = $request->candidate_number;
        $candidate->vision_mission = $request->vision_mission;
        if ($request->hasFile('photo')) {
            if ($candidate->photo && file_exists(storage_path('app/public/uploads/candidate/' . $candidate->photo))) {
                unlink(storage_path('app/public/uploads/candidate/' . $candidate->photo));
            }
            $filename = time() . '_' . $request->file('photo')->getClientOriginalName();

            $request->file('photo')->storeAs('uploads/candidate', $filename);

            $candidate->photo = $filename;
        } else {
            $candidate->photo = $candidate->photo;
        }

        $candidate->save();

        return redirect()->route('candidate.index')->with('success', 'Kandidat berhasil ditambahkan');
    }


    public function destroy($id)
    {
        $candidate = Candidate::find($id);
        $candidate->delete();
        return redirect()->route('candidate.index')->with('success', 'Kandidat berhasil dihapus');
    }
    
}

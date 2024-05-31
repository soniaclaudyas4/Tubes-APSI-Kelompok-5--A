<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beasiswa;

class BeasiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $bulan = $request->input('bulan');

        $beasiswa = Beasiswa::query();

        if ($search) {
            $beasiswa->where('name', 'like', '%' . $search . '%');
        }

        if ($bulan) {
            $beasiswa->where('bulan', $bulan);
        }

        $beasiswa = $beasiswa->get();

        return view('beasiswa.index', compact('beasiswa'));
    }

    public function create()
    {
        return view('beasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_beasiswa' => 'required',
            'jenis_beasiswa' => 'required',
            'status' => 'required',
            'deskripsi' => 'required',
            'timeline' => 'required',
            'ketentuan' => 'required',
            'biaya' => 'required',
            'link_pendaftaran' => 'required|url',
            'link_guidebook' => 'required|url',
            'kontak' => 'required',
            'poster' => 'required|image',
            'tanggal_pelaksanaan' => 'required|date'
        ]);

        $data = $request->all();
        $data['tanggal_pelaksanaan'] = $request->input('tanggal_pelaksanaan', now());

        Beasiswa::create($data);

        return redirect()->route('daftar_beasiswa')->with('success', 'Beasiswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $beasiswa = Beasiswa::find($id);
        return view('beasiswa.edit', compact('beasiswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_beasiswa' => 'required',
            'jenis_beasiswa' => 'required',
            'status' => 'required',
            'deskripsi' => 'required',
            'timeline' => 'required',
            'ketentuan' => 'required',
            'biaya' => 'required',
            'link_pendaftaran' => 'required|url',
            'link_guidebook' => 'required|url',
            'kontak' => 'required',
            'poster' => 'required|image',
            'tanggal_pelaksanaan' => 'required|date'
        ]);

        $data = $request->all();
        $data['tanggal_pelaksanaan'] = $request->input('tanggal_pelaksanaan', now());

        $beasiswa = Beasiswa::find($id);
        $beasiswa->update($data);

        return redirect()->route('daftar_beasiswa')->with('success', 'Beasiswa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $beasiswa = Beasiswa::find($id);
        $beasiswa->delete();

        return redirect()->route('daftar_beasiswa')->with('success', 'Beasiswa berhasil dihapus');
    }
}

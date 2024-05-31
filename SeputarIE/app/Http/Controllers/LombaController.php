<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lomba;
use Illuminate\Http\Request;

class LombaController extends Controller
{
    public function index(Request $request)
    {
        $query = Lomba::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_lomba', 'like', '%' . $request->search . '%');
        }

        if ($request->has('bulan') && $request->bulan != '') {
            $query->whereMonth('tanggal_pelaksanaan', $request->bulan);
        }

        $lomba = $query->get();

        return view('lomba.index', compact('lomba'));
    }

    public function create()
    {
        return view('lomba.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lomba' => 'required',
            'jenis_lomba' => 'required',
            'status' => 'required',
            'deskripsi' => 'required',
            'timeline' => 'required',
            'ketentuan' => 'required',
            'biaya' => 'required',
            'link_pendaftaran' => 'required|url',
            'link_guidebook' => 'required|url',
            'kontak' => 'required',
            'poster' => 'required|image',
            'tanggal_pelaksanaan' => 'required|date',
        ]);

        $data = $request->all();
        $data['tanggal_pelaksanaan'] = $request->input('tanggal_pelaksanaan', now());

        $lomba = new Lomba();
        $lomba->nama_lomba = $data['nama_lomba'];
        $lomba->jenis_lomba = $data['jenis_lomba'];
        $lomba->status = $data['status'];
        $lomba->deskripsi = $data['deskripsi'];
        $lomba->timeline = $data['timeline'];
        $lomba->ketentuan = $data['ketentuan'];
        $lomba->biaya = $data['biaya'];
        $lomba->link_pendaftaran = $data['link_pendaftaran'];
        $lomba->link_guidebook = $data['link_guidebook'];
        $lomba->kontak = $data['kontak'];
        $lomba->poster = $data['poster'];
        $lomba->tanggal_pelaksanaan = $data['tanggal_pelaksanaan'];
        $lomba->save();

        return redirect()->route('admin.daftar_lomba')->with('success', 'Lomba berhasil ditambahkan');
    }

    public function edit($id)
    {
        $lomba = Lomba::find($id);
        return view('lomba.edit', compact('lomba'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lomba' => 'required',
            'jenis_lomba' => 'required',
            'status' => 'required',
            'deskripsi' => 'required',
            'timeline' => 'required',
            'ketentuan' => 'required',
            'biaya' => 'required',
            'link_pendaftaran' => 'required|url',
            'link_guidebook' => 'required|url',
            'kontak' => 'required',
            'poster' => 'required|image',
            'tanggal_pelaksanaan' => 'required|date',
        ]);

        $data = $request->all();
        $data['tanggal_pelaksanaan'] = $request->input('tanggal_pelaksanaan', now());

        $lomba = Lomba::find($id);
        $lomba->nama_lomba = $data['nama_lomba'];
        $lomba->jenis_lomba = $data['jenis_lomba'];
        $lomba->status = $data['status'];
        $lomba->deskripsi = $data['deskripsi'];
        $lomba->timeline = $data['timeline'];
        $lomba->ketentuan = $data['ketentuan'];
        $lomba->biaya = $data['biaya'];
        $lomba->link_pendaftaran = $data['link_pendaftaran'];
        $lomba->link_guidebook = $data['link_guidebook'];
        $lomba->kontak = $data['kontak'];
        $lomba->poster = $data['poster'];
        $lomba->tanggal_pelaksanaan = $data['tanggal_pelaksanaan'];
        $lomba->save();

        return redirect()->route('admin.daftar_lomba')->with('success', 'Lomba berhasil diupdate');
    }

    public function destroy($id)
    {
        $lomba = Lomba::find($id);
        $lomba->delete();

        return redirect()->route('admin.daftar_lomba')->with('success', 'Lomba berhasil dihapus');
    }

    public function daftarLombapencari(Request $request)
    {
        $query = Lomba::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_lomba', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        if ($request->has('bulan') && $request->bulan != '') {
            $query->whereMonth('tanggal_pelaksanaan', '=', $request->bulan);
        }

        $lomba = $query->get();

        return view('lomba.index', ['lomba' => $lomba]);
    }
}


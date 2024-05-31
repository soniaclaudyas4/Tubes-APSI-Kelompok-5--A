@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Edit Lomba</h1>
    <form action="{{ route('admin.update_lomba', $lomba->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_lomba">Nama Lomba</label>
            <input type="text" class="form-control" id="nama_lomba" name="nama_lomba" value="{{ $lomba->nama_lomba }}" required>
        </div>
        <div class="form-group">
            <label for="jenis_lomba">Jenis Lomba</label>
            <input type="text" class="form-control" id="jenis_lomba" name="jenis_lomba" value="{{ $lomba->jenis_lomba }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="Aktif" {{ $lomba->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Tidak Aktif" {{ $lomba->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $lomba->deskripsi }}</textarea>
        </div>
        <div class="form-group">
            <label for="timeline">Timeline</label>
            <input type="text" class="form-control" id="timeline" name="timeline" value="{{ $lomba->timeline }}" required>
        </div>
        <div class="form-group">
            <label for="ketentuan">Ketentuan</label>
            <textarea class="form-control" id="ketentuan" name="ketentuan" rows="3" required>{{ $lomba->ketentuan }}</textarea>
        </div>
        <div class="form-group">
            <label for="biaya">Biaya</label>
            <input type="text" class="form-control" id="biaya" name="biaya" value="{{ $lomba->biaya }}" required>
        </div>
        <div class="form-group">
            <label for="link_pendaftaran">Link Pendaftaran</label>
            <input type="url" class="form-control" id="link_pendaftaran" name="link_pendaftaran" value="{{ $lomba->link_pendaftaran }}" required>
        </div>
        <div class="form-group">
            <label for="link_guidebook">Link Guidebook</label>
            <input type="url" class="form-control" id="link_guidebook" name="link_guidebook" value="{{ $lomba->link_guidebook }}" required>
        </div>
        <div class="form-group">
            <label for="kontak">Kontak</label>
            <input type="text" class="form-control" id="kontak" name="kontak" value="{{ $lomba->kontak }}" required>
        </div>
        <div class="form-group">
            <label for="poster">Poster</label>
            <input type="file" class="form-control-file" id="poster" name="poster">
            <small>Current Poster: <a href="{{ asset($lomba->poster) }}" target="_blank">View</a></small>
        </div>
        <div class="form-group">
            <label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
            <input type="date" class="form-control" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" value="{{ $formattedDate }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

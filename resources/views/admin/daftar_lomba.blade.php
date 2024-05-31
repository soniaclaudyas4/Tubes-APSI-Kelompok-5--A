@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Daftar Lomba</h1>
    <form method="GET" action="{{ route('admin.daftar_lomba') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari Lomba" value="{{ request('search') }}">
            <select name="bulan" class="custom-select">
                <option value="">Pilih Bulan</option>
                @foreach ([
                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', 
                    '04' => 'April', '05' => 'Mei', '06' => 'Juni', 
                    '07' => 'Juli', '08' => 'Agustus', '09' => 'September', 
                    '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                ] as $num => $month)
                    <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>
                        {{ $month }}
                    </option>
                @endforeach
            </select>
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form>
    <div class="row">
        @foreach ($lomba as $l)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <img src="{{ asset($l->poster) }}" class="card-img-top" alt="Poster" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $l->nama_lomba }}</h5>
                    <!-- Tombol untuk membuka modal detail -->
                    <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#detailModal{{ $l->id }}">
                        Detail
                    </button>
                    <div class="mt-auto text-center">
                        <div class="d-flex justify-content-between">
                            <a href="{{ asset($l->poster) }}" download class="btn btn-primary flex-fill mr-1">Unduh Poster</a>
                            <form action="{{ route('admin.hapus_lomba', $l->id) }}" method="POST" class="flex-fill ml-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Detail -->
        <div class="modal fade" id="detailModal{{ $l->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $l->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel{{ $l->id }}">{{ $l->nama_lomba }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <strong>Jenis Lomba:</strong> {{ $l->jenis_lomba }}<br>
                        <strong>Status:</strong> {{ $l->status }}<br>
                        <strong>Deskripsi:</strong> {{ $l->deskripsi }}<br>
                        <strong>Timeline:</strong> {{ $l->timeline }}<br>
                        <strong>Ketentuan:</strong> {{ $l->ketentuan }}<br>
                        <strong>Biaya:</strong> {{ $l->biaya }}<br>
                        <strong>Link Pendaftaran:</strong> <a href="{{ $l->link_pendaftaran }}">{{ $l->link_pendaftaran }}</a><br>
                        <strong>Link Guidebook:</strong> <a href="{{ $l->link_guidebook }}">{{ $l->link_guidebook }}</a><br>
                        <strong>Kontak:</strong> {{ $l->kontak }}<br>
                        <strong>Tanggal Pelaksanaan:</strong> {{ $l->tanggal_pelaksanaan }}<br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection


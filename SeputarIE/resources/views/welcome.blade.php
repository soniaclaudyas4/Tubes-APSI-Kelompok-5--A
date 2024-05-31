@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Roboto', sans-serif;
                background-color: #f4f4f4;
                color: #333;
            }
            .content {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
                display: flex;
                justify-content: space-between;
            }
            .card {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 6px 10px rgba(0,0,0,0.1);
                margin: 20px;
                padding: 20px;
                flex: 1;
            }
            .card-container {
                padding: 10px;
            }
            .card h2 {
                color: #007BFF;
                margin-bottom: 15px;
            }
            .card h3 {
                color: #333;
            }
            .links a {
                color: #007BFF;
                text-decoration: none;
                font-weight: 500;
            }
        </style>

    </head>
    <body>
        <div class="content">
        <!-- Daftar Beasiswa -->
            <div class="card">
                <div class="card-container">
                    <h2>Daftar Beasiswa</h2>
                    @foreach ($beasiswa as $item)
                        <div>
                            <h3>{{ $item->name }}</h3>
                            <p>{{ $item->description }}</p>
                            @if(Auth::check())
                                @if(Auth::user()->is_admin)
                                    <a href="/admin/daftar-beasiswa">Lihat Detail</a>
                                @else
                                    <a href="{{ route('daftar_beasiswa') }}">Lihat Detail</a>
                                @endif
                            @else
                                <a href="/login">Lihat Detail</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Daftar Lomba -->
            <div class="card">
                <div class="card-container">
                    <h2>Daftar Lomba</h2>
                    @foreach ($lomba as $item)
                        <div>
                            <h3>{{ $item->judul }}</h3>
                            <p>{{ $item->deskripsi }}</p>
                            @if(Auth::check())
                                @if(Auth::user()->is_admin)
                                    <a href="/admin/daftar-lomba">Lihat Detail</a>
                                @else
                                    <a href="{{ route('daftar_lomba') }}">Lihat Detail</a>
                                @endif
                            @else
                                <a href="/login">Lihat Detail</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
@endsection
@extends('adminlte::page')

{{-- Judul Halaman --}}
@section('title', 'Dashboard')

{{-- Header Konten (Judul di atas konten) --}}
@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

{{-- Konten Utama Halaman --}}
@section('content')
    {{-- Konten dinamis berdasarkan peran --}}
    @role('admin')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Selamat Datang, Admin!</h5>
                        <p class="card-text">Anda memiliki akses penuh ke seluruh sistem.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-6">
                {{-- small box --}}
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>
                        <p>Total Pengguna</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            {{-- Tambahkan kartu statistik lainnya di sini --}}
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-0">Selamat datang di aplikasi!</p>
                    </div>
                </div>
            </div>
        </div>
    @endrole
@stop

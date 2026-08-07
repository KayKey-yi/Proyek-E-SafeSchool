@extends('layouts.app')

@section('page-css')
@endsection

@section('main')
<div class="page-heading">
    <div class="page-title mb-4">
        <div class="row mb-2">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <a href="{{ route('item_reports.index') }}" class="btn btn-sm icon icon-left btn-outline-secondary"><i class="fa fa-arrow-left"></i> Kembali </a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('item_reports.index') }}">{{ $title }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card kt-detail-card">
            <div class="card-header">
                Detail Data {{ $title }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10 offset-lg-2">
                        <div class="row kt-detail-grid">
                            <div class='col-lg-2'><p>User Id</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $item_reports->user_id }}</p></div>
									<div class='col-lg-2'><p>Status Id</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $item_reports->status_id }}</p></div>
									<div class='col-lg-2'><p>Jenis Laporan</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $item_reports->jenis_laporan }}</p></div>
									<div class='col-lg-2'><p>Nama Barang</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $item_reports->nama_barang }}</p></div>
									<div class='col-lg-2'><p>Kategori Barang</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $item_reports->kategori_barang }}</p></div>
									<div class='col-lg-2'><p>Merek</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $item_reports->merek }}</p></div>
									<div class='col-lg-2'><p>Warna</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $item_reports->warna }}</p></div>
									<div class='col-lg-2'><p>Ciri Ciri</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $item_reports->ciri_ciri }}</p></div>
									<div class='col-lg-2'><p>Lokasi</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $item_reports->lokasi }}</p></div>
									<div class='col-lg-2'><p>Tanggal</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $item_reports->tanggal }}</p></div>
									<div class='col-lg-2'><p>Foto</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $item_reports->foto }}</p></div>
									<div class='col-lg-2'><p>Is Anonymous</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $item_reports->is_anonymous }}</p></div>
									
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection

@section('page-js')
@endsection

@section('inline-js')
@endsection

@extends('layouts.app')

@php
date_default_timezone_set('Asia/Jakarta');
@endphp

@section('content-app')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('create-purchase') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 mb-3">
                           Tanggal: <input readonly class="form-control" type="text" value="{{ date('Y/m/d', strtotime('now')) }}">
                        </div>
                    </div>
                    @csrf
                   
                    <div class="row">
                        <div class="col-md-4">
                            <label for="no_surat">Nomor Surat</label>
                            <input required readonly value="{{ 'NS.'.date('Ymd',strtotime('now')).$purchase_count }}" type="text" class="form-control" name="no_surat" id="no_surat">
                        </div>
                        <div class="col-md-4">
                            <label for="supplier_id">Supplier</label>
                            <select class="form-select" name="supplier_id" required id="supplier_id">
                                <option value="">-Pilih Supplier-</option>
                                @foreach ($supplier as $item)
                                <option value="{{ $item->supplier_id }}">{{ $item->nama_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="golongan_id">Golongan</label>
                            <select class="form-select" name="golongan_id" required id="golongan_id">
                                <option value="">-Pilih Golongan-</option>
                                @foreach ($golongan as $item)
                                <option value="{{ $item->golongan_id }}">{{ $item->jenis_golongan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success mt-3">Lanjut</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
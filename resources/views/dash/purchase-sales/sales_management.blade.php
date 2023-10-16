@extends('layouts.app')

@section('content-app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="POST" action="{{ route('create-order') }}" class="card-body">
                    @csrf
                    <div class="row align-items-center" style="row-gap: 12px;">
                        <div class="col-md-3">
                            <label for="nama_customer">Nama Konsumen : </label>
                        </div>
                        <div class="col-md-9">
                            <input required type="text" class="form-control" placeholder="Masukkan nama konsumen" name="nama_customer" id="nama_customer">
                        </div>
                        <div class="col-md-3">
                            <label for="usia">Usia : </label>
                        </div>
                        <div class="col-md-9">
                            <input required type="number" class="form-control" placeholder="Masukkan usia konsumen" name="usia" id="usia">
                        </div>
                        <div class="col-md-3">
                            <label for="jenis_obat">Jenis Obat : </label>
                        </div>
                        <div class="col-md-9">
                            <select required class="form-control" name="jenis_obat" id="jenis_obat">
                                <option value="">-Pilih jenis obat-</option>
                                <option value="Resep">Resep</option>
                                <option value="Non-Resep">Non-Resep</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="alamat">Alamat : </label>
                        </div>
                        <div class="col-md-9">
                            <textarea required name="alamat" id="alamat" class="form-control" placeholder="Masukkan alamat konsumen"></textarea>
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-dark mt-5 px-4">
                            Selanjutnya
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
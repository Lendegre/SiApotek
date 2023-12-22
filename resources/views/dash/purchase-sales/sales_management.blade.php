@extends('layouts.app')

@section('content-app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="POST" action="{{ route('create-order') }}" class="card-body">
                    @csrf
                    <div class="row align-items-center" style="row-gap: 12px;">
                        <div class="col-md-3">
                            <label for="nama">Nama: </label>
                        </div>
                        <div class="col-md-9">
                            <input type="string" name="nama" id="nama" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="jenis_obat">Jenis Obat: </label>
                        </div>
                        <div class="col-md-9">
                            <select required class="form-control" name="jenis_obat" id="jenis_obat">
                                <option value="">-Pilih jenis obat-</option>
                                <option value="Resep">Resep</option>
                                <option value="Non-Resep">Non-Resep</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="jenis_obat">Golongan: </label>
                        </div>
                        <div class="col-md-9">
                            <select required class="form-control" name="golongan_id" id="golongan_id">
                                <option value="">-Pilih golongan-</option>
                                @foreach ($golongan as $item)
                                    <option value="{{ $item->golongan_id }}">{{ $item->jenis_golongan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-dark mt-5 py-2 px-4">
                            Selanjutnya
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
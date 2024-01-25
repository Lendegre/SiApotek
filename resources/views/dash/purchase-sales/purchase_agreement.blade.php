@extends('layouts.app')

@section('content-app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="data">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nomor Surat</th>
                                    <th>Supplier</th>
                                    <th>Golongan</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchase_reports as $item)
                                    <tr>
                                        <td>{{ $loop->iteration . '.' }}</td>
                                        <td>{{ $item->no_surat }}</td>
                                        <td>{{ $item->supplier->nama_supplier }}</td>
                                        <td>{{ $item->golongan->jenis_golongan }}</td>
                                        <td>
                                            @if ($item->status == "Pending")
                                                <span class="rounded px-3 bg-warning text-light">{{ $item->status }}</span>
                                                
                                            @elseif($item->status == "Ditolak") 
                                                <span class="rounded px-3 bg-danger text-light">{{ $item->status }}</span>
                                                
                                            @else
                                                <span class="rounded px-3 bg-success text-light">{{ $item->status }}</span>
                                            
                                            @endif
                                        </td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->tgl_pengajuan }}</td>
                                        <td>
                                            <button class="btn btn-success modal-open" data-modal="{{ 'update'.$item->purchase_id }}"><i data-feather="check"></i></button>
                                            <a href="{{ route('detail-purchase', $item->purchase_id) }}" class="btn btn-warning"><i data-feather="eye"></i></a>
                                            <button class="btn btn-danger modal-open" data-modal="{{ 'delete'.$item->purchase_id }}"><i data-feather="trash"></i></button>
                                        
                                            <div id="{{ 'update'.$item->purchase_id }}" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" data-modal="{{ 'update'.$item->purchase_id }}">&times;</span>
                                                    <h3>Persetujuan Pemesanan</h3>
                                                    <hr>
                                                    <form action="{{ route('update-status') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="purchase_id" value="{{ $item->purchase_id }}">
                                                        <div class="">
                                                            <label for="status">Status</label>
                                                            <select name="status" class="form-control" required id="status">
                                                                <option value="">-Pilih Status-</option>
                                                                <option value="Ditolak">Tolak</option>
                                                                <option value="Diterima">Setujui</option>
                                                            </select>
                                                            <div class="mt-3" id="formKeterangan" style="display: none;">
                                                                <label for="keterangan" class="form-label">Keterangan</label>
                                                                <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <button type="submit" class="btn btn-success">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div id="{{ 'delete'.$item->purchase_id }}" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" data-modal="{{ 'delete'.$item->purchase_id }}">&times;</span>
                                                    <h3>Apakah anda yakin?</h3>
                                                    <hr>
                                                    <form action="{{ route('delete-report-purchase', $item->purchase_id) }}" method="POST">
                                                        @csrf
                                                        <p>Yakin untuk menghapus laporan dengan nomor surat <strong>{{ $item->no_surat }}</strong></p>
                                                        <div class="mt-3">
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('status').addEventListener('change', function() {
            var formAlasan = document.getElementById('formKeterangan');
    
            if (this.value === 'Ditolak') {
                formAlasan.style.display = 'block';
            } else {
                formAlasan.style.display = 'none';
            }
        });
    </script>

@endsection
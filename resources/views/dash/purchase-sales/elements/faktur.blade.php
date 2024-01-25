@extends('layouts.app')

@section('content-app')
    <div class="container">

        <div class="card">
            <div class="card-header">
                <div class="card-body">
                    <form action="{{ route('create-faktur-product') }}" method="post" id="multiplicationForm">
                        @csrf
                        <div class="row justify-content-between mt-2">

                            <input type="hidden" name="purchase_id" value="{{ $faktur->purchase->purchase_id }}">
                            {{-- <input type="hidden" name="purchase_product_id" value="{{ $faktur->purchase_product->purchase_product_id }}"> --}}

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="purchase_id" class="form-label">No. Surat</label>
                                    <input type="string" class="form-control"
                                        name="purchase_id" id="purchase_id" value="{{ $faktur->purchase->no_surat }}"
                                        disabled required>
                                </div>
                                <div class="mb-3">
                                    <label for="tgl_pemesanan" class="form-label">Tanggal Pemesanan</label>
                                    <input type="date" class="form-control"
                                        value="{{ $faktur->purchase->tgl_pengajuan }}" disabled required>
                                </div>
                                <div class="mb-3">
                                    <label for="supplier" class="form-label">Nama Supplier</label>
                                    <input type="text" class="form-control"
                                        value="{{ $faktur->purchase->supplier->nama_supplier }}" disabled required>
                                </div>
                                <div class="mb-3">
                                    <label for="no_tlp" class="form-label">No. Telepon</label>
                                    <input type="text" class="form-control"
                                        value="{{ $faktur->purchase->supplier->no_telp }}" disabled required>
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="isi" class="form-label">Isi dalam kemasan</label>
                                    <input type="text" class="form-control"
                                        value="" disabled required>
                                </div> --}}
                            </div>
                            <div class="col-md-3 offset-md-2">
                                <div class="mb-3">
                                    <label for="no_faktur" class="form-label">No. Faktur</label>
                                    <input type="string" class="form-control @error('no_faktur') is-invalid @enderror" id="no_faktur" name="no_faktur">
                                    @error('no_faktur')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="sbayar" class="form-label">Status Pembayaran</label>
                                    <select required class="form-control" name="sbayar" id="sbayar">
                                        <option value="">-Pilih Status Pembayaran-</option>
                                        <option value="COD">COD</option>
                                        <option value="Kredit">Kredit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="tgl_trm" class="form-label">Tanggal Terima</label>
                                    <input type="date" class="form-control" id="tgl_trm" name="tgl_trm">
                                </div>
                                <div class="mb-2">
                                    <label for="tgl_tempo" class="form-label">Tanggal Pelunasan</label>
                                    <input type="date" class="form-control" id="tgl_tempo" name="tgl_tempo">
                                </div>
                            </div>
                        </div>
                        {{-- Table barang masuk --}}
                        <table class="table table-striped mt-3" id="dataTable">
                            <thead>
                                <tr class="border text-center">
                                    <th class="border">Nama Barang</th>
                                    <th class="border">Jumlah Pesan</th>
                                    <th class="border">Jumlah Terima</th>
                                    <th class="border">Harga Beli</th>
                                    {{-- <th class="border">Harga Beli/Satuan Barang</th> --}}
                                    <th class="border">Total</th>
                                </tr>
                            </thead>
                            @foreach ($bm as $b)
                                <tbody>
                                    <!-- Row 1 -->
                                    <tr class="border">
                                        <td class="border"><input required readonly type="string" name="nama_brg[]" id="nama_brg" value="{{ $b->barang->nama_barang }}"></td>
                                        <td class="border text-center">{{ $b->jumlah }}</td>
                                        <td class="border"><input required type="number" class="jumlah_trm" name="jumlah_trm[]" min="0" value="0" id="jumlah_trm" onchange="calculateTotal()"></td>
                                        <td class="border">Rp. <input required type="number" class="h_beli col-md-6" name="h_beli[]" min="0" value="0" id="h_beli" onchange="calculateTotal()"> / {{ $b->satuan_beli }}</td>
                                        <td class="border text-center">Rp. <input type="number" class="total mx-2" name="total[]" id="total" readonly></td>
                                    </tr>
                                    
                                </tbody>
                            @endforeach
                        </table>
                        <div class="container d-flex justify-content-end">
                            <label for="g_total" class="text-right"><strong>Grand Total:</strong></label>
                            <input class="mx-4" type="double" id="g_total" name="g_total" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary text-left">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan event listener untuk mengirim permintaan saat input berubah -->
    <script>
        function calculateTotal() {
            var rows = document.querySelectorAll("#dataTable tbody tr");

            var g_total = 0;

            rows.forEach(function (row) {
                var jumlah_trm = Number.parseFloat(row.querySelector(".jumlah_trm").value);
                var h_beli = Number.parseFloat(row.querySelector(".h_beli").value);

                // Lakukan perhitungan
                var total = jumlah_trm * h_beli;
                g_total += total;

                // Isi nilai total ke dalam input 'total'
                row.querySelector(".total").value = total.toFixed(2).replace(/\.?0+$/, '');
            });

            // Isi nilai total keseluruhan ke dalam input 'grandTotal'
            document.getElementById('g_total').value = g_total.toFixed(2).replace(/\.?0+$/, '');
        }
    </script>

    <!-- Tambahkan JavaScript untuk mengirim permintaan Ajax jika dibutuhkan -->
    <script>
        document.getElementById('multiplicationForm').addEventListener('input', function () {
            calculateTotal();

            // Tambahkan kode Ajax untuk mengirim data formulir ke server jika diperlukan
            // Gunakan metode fetch atau jQuery.ajax untuk mengirim data ke server
            // Contoh menggunakan fetch:
            
            fetch('{{ route('create_faktur') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    jumlah_trm: getFormValues('jumlah_trm'),
                    h_beli: getFormValues('h_beli')
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('g_total').value = data.g_total;
            });
            
        });

        // Fungsi untuk mendapatkan nilai formulir berdasarkan nama elemen
        function getFormValues(elementName) {
            var elements = document.getElementsByName(elementName);
            var values = [];
            for (var i = 0; i < elements.length; i++) {
                values.push(elements[i].value);
            }
            return values;
        }
    </script>

    {{-- <script>
        function calculateTotal() {
            var jumlah_trm = document.getElementById('jumlah_trm').value;
            var h_beli = document.getElementById('h_beli').value;
    
            // Lakukan perhitungan
            var total = jumlah_trm * h_beli;
    
            // Isi nilai total ke dalam input 'total'
            document.getElementById('total').value = total;
        }
    </script> --}}

@endsection

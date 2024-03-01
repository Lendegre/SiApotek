<?php

namespace App\Http\Controllers\Dash;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Barang;
use App\Models\Bentuk;
use App\Models\Satuan;
use App\Models\Golongan;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class MasterDataController extends Controller
{
    protected $label, $id_page, $model;

    public function __construct()
    {
        $this->label = 'Data ';
        $this->id_page = [2, 3, 4, 5, 6, 7];
        $this->model = [
            Supplier::all(),
            Satuan::all(),
            Kategori::all(),
            Bentuk::all(),
            Golongan::all()
        ];
    }

    public static function getItemsByGroup()
    {
        $getItems = Barang::all();
            return $getItems;
    }

    /**
     * Render view barang user interface
     * 
     * @return View
     */
    protected function showDataBarang()
    {
        $count_model = [
            Supplier::count(),
            Satuan::count(),
            Kategori::count(),
            Bentuk::count(),
            Golongan::count(),
        ];

        $data = [
            'title'         => $this->label . 'Barang',
            'id_page'       => $this->id_page[0],
            'count_model'   => $count_model,
            'items'         => Barang::all(),
            'supplier'      => $this->model[0],
            'satuan'        => $this->model[1],
            'kategori'      => $this->model[2],
            'bentuk'        => $this->model[3],
            'golongan'      => $this->model[4],
        ];
        return view('dash.master-data.barang', $data);
    }
    

    /**
     * Render view add item interface
     * 
     * @param int $countData
     * @return View
     */
    protected function showAddItem($countData)
    {
        if (!$countData || $countData > 100) {
            abort(404);
        }

        $data = [
            'title'     => 'Tambah Barang',
            'id_page'   => null,
            'items'     => $countData,
            'supplier'  => $this->model[0],
            'satuan'    => $this->model[1],
            'kategori'  => $this->model[2],
            'bentuk'    => $this->model[3],
            'golongan'  => $this->model[4],
        ];

        return view('dash.master-data.elements.add_items', $data);
    }

    /**
     * Logic count to counting the request amount
     * 
     * @param Request
     * @return View
     */
    protected function countAmountRequest(Request $request)
    {
        $amount = $request->input('amount');
        if ($amount > 0) {
            return redirect()->route('add-items', $amount);
        } else {
            return back()->with('error', 'Penambahan jumlah barang minimal 1 barang');
        }
    }


    /**
     * Logic to create items
     * 
     * @param Request
     * @return View
     */
    protected function createItems(Request $request)
    {
        $count_data = $request->input('count_data');
        $isDuplicate = false;

        for ($i = 1; $i <= $count_data; $i++) {
            $otherBarang = Barang::where('nama_barang', $request->input("nama_barang$i"))->first();
            if (!$otherBarang) {
                $tanggal_masuk = Carbon::now()->format('Y-m-d');
                DB::table('barang')->insert([
                    "nama_barang"         => $request->input("nama_barang$i"),
                    "supplier_id"         => $request->input("supplier_id$i"),
                    "tanggal_kedaluwarsa" => $request->input("tanggal_kedaluwarsa$i"),
                    "tanggal_masuk"       => $tanggal_masuk,
                    "isi"                 => $request->input("isi$i"),
                    "bentuk_id"           => $request->input("bentuk_id$i"),
                    "stok"                => $request->input("stok$i"),
                    "harga_jual"          => $request->input("harga_jual$i"),
                    "satuan_jual"         => $request->input("satuan_jual$i"),
                    "minimal_stok"        => $request->input("minimal_stok$i"),
                    "satuan_id"           => $request->input("satuan_id$i"),
                    "kategori_id"         => $request->input("kategori_id$i"),
                    "golongan_id"         => $request->input("golongan_id$i")
                ]);


            } else {
                $isDuplicate = true;
            }
        }
        if ($isDuplicate) {
            return back()->withInput()->with('error', 'Barang Sudah Ada');
        } else { 
            return redirect()->route('barang')->with('success', 'Sukses menyimpan data');
        }
    }
    

    /**
     * Logic to delete item
     * 
     * @param int $barang_id
     */
    protected function deleteItem($barang_id)
    {
        DB::table('barang')->where('barang_id', $barang_id)->delete();

        return back()->with('info', 'Data berhasil dihapus');
    }

    /**
     * Logic to update item
     * 
     */
    protected function updateItem(Request $request, $barang_id)
    {
        $barang = Barang::find($barang_id);
        $otherBarang = Barang::where('nama_barang', '!=', $barang->nama_barang)->where('nama_barang', $request->input('nama_barang'))->first();

        if (!$otherBarang) {
            $barang->nama_barang = $request->input('nama_barang'); 
            $barang->supplier_id = $request->input('supplier_id'); 
            $barang->tanggal_kedaluwarsa = $request->input('tanggal_kedaluwarsa');
            $barang->tanggal_masuk = $request->input('tanggal_masuk');
            $barang->satuan_id = $request->input('satuan_id');
            $barang->isi = $request->input('isi');
            $barang->bentuk_id = $request->input('bentuk_id');
            $barang->stok = $request->input('stok');
            $barang->harga_jual = $request->input('harga_jual');
            $barang->satuan_jual = $request->input('satuan_jual');
            $barang->minimal_stok = $request->input('minimal_stok');
            $barang->kategori_id = $request->input('kategori_id');
            $barang->golongan_id = $request->input('golongan_id');

            $barang->save();

            return back()->with('info', 'Berhasil diupdate');
        }

        return back()->with('error', 'Data barang tidak boleh sama');
    }

    /**
     * Render view supplier user interface
     * 
     * @return View
     */
    protected function showDataSupplier()
    {
        $data = [
            'title'     => $this->label . 'Supplier',
            'id_page'   => $this->id_page[1],
            'supplier'  => Supplier::orderBy('supplier_id', 'DESC')->get(),
        ];

        return view('dash.master-data.supplier', $data);
    }

    /**
     * Handle request to create supplier
     * 
     * @param Request
     * @return RedirectResponse
     */
    protected function createSupplier(Request $request)
    {
        $existingSupplier = Supplier::where('nama_supplier', $request->input('nama_supplier'))->first();

        if (!$existingSupplier) {
            DB::table('supplier')->insert([
                'nama_supplier' => $request->input('nama_supplier'),
                'nama_sales'    => $request->input('nama_sales'),
                'no_telp'       => $request->input('no_telp'),
                'alamat'        => $request->input('alamat'),
            ]);

            return back()->with('success', 'Sukses membuat data supplier');
        }

        return back()->with('error', 'Data supplier tidak boleh sama');
    }

    /**
     * Handle request to delete supplier
     * 
     * @return RedirectResponse
     */

    protected function deleteSupplier($supplier_id)
    {
        DB::table('supplier')->where('supplier_id', $supplier_id)->delete();

        return back()->with('info', 'Data supplier berhasil dihapus!');
    }

    /**
     * Handle request to update supplier
     * 
     * @param Request
     * @return RedirectResponse
     */
    protected function updateSupplier(Request $request, $supplier_id)
    {
        $supplier = Supplier::find($supplier_id);
        $otherSupplier = Supplier::where('nama_supplier', $request->input('nama_supplier'))->first();

        if ($supplier->nama_supplier != $request->input('nama_supplier')) {
            if (!$otherSupplier) {
                $supplier->nama_supplier = $request->input('nama_supplier');
                $supplier->nama_sales = $request->input('nama_sales');
                $supplier->no_telp = $request->input('no_telp');
                $supplier->alamat = $request->input('alamat');
                $supplier->save();
                return back()->with('info', 'Data berhasil diupdate');
            } else {
                return back()->with('error', 'Data supplier tidak boleh sama');
            }
        }

        return back();
    }

    /**
     * Render view kategori user interface
     * 
     * @return View
     */
    protected function showDataKategori()
    {
        $data = [
            'title'     => $this->label . 'Kategori',
            'id_page'   => $this->id_page[2],
            'kategori'  => Kategori::orderBy('kategori_id', 'DESC')->get(),
        ];

        return view('dash.master-data.kategori', $data);
    }

    /**
     * Handle request to create kategori
     * 
     * @param Request
     * @return RedirectResponse
     */
    protected function createKategori(Request $request)
    {
        $existingKategori = Kategori::where('nama_kategori', $request->input('nama_kategori'))->first();

        if (!$existingKategori) {
            DB::table('kategori')->insert([
                'nama_kategori' => $request->input('nama_kategori'),
            ]);

            return back()->with('success', 'Sukses membuat data kategori');
        }

        return back()->with('error', 'Data kategori tidak boleh sama');
    }

    /**
     * Handle request to delete kategori
     * 
     * @return RedirectResponse
     */

    protected function deleteKategori($kategori_id)
    {
        DB::table('kategori')->where('kategori_id', $kategori_id)->delete();

        return back()->with('info', 'Data kategori berhasil dihapus');
    }

    /**
     * Handle request to update kategori
     * 
     * @param Request
     * @return RedirectResponse
     */
    protected function updateKategori(Request $request, $kategori_id)
    {
        $kategori = Kategori::find($kategori_id);
        $otherKategori = Kategori::where('nama_kategori', $request->input('nama_kategori'))->first();

        if ($kategori->nama_kategori != $request->input('nama_kategori')) {
            if (!$otherKategori) {
                $kategori->nama_kategori = $request->input('nama_kategori');
                $kategori->save();
                return back()->with('info', 'Data kategori berhasil diupdate');
            } else {
                return back()->with('error', 'Data kategori tidak boleh sama!');
            }
        }

        return back();
    }


    /**
     * Render view bentuk user interface
     * 
     * @return View
     */
    protected function showDataBentuk()
    {
        $data = [
            'title'     => $this->label . 'Bentuk Barang',
            'id_page'   => $this->id_page[3],
            'bentuk'  => Bentuk::orderBy('bentuk_id', 'DESC')->get(),
        ];

        return view('dash.master-data.bentuk', $data);
    }

     /**
     * Handle request to create bentuk
     * 
     * @param Request
     * @return RedirectResponse
     */
    protected function createBentuk(Request $request)
    {
        $existingBentuk = Bentuk::where('nama_bentuk', $request->input('nama_bentuk'))->first();

        if (!$existingBentuk) {
            DB::table('bentuk')->insert([
                'nama_bentuk' => $request->input('nama_bentuk'),
            ]);

            return back()->with('success', 'Sukses membuat data bentuk');
        }

        return back()->with('error', 'Data bentuk tidak boleh sama');
    }

     /**
     * Handle request to delete bentuk
     * 
     * @return RedirectResponse
     */

     protected function deleteBentuk($bentuk_id)
     {
         DB::table('bentuk')->where('bentuk_id', $bentuk_id)->delete();
 
         return back()->with('success', 'Data bentuk berhasil dihapus');
     }

      /**
     * Handle request to update bentuk
     * 
     * @param Request
     * @return RedirectResponse
     */
    protected function updateBentuk(Request $request, $bentuk_id)
    {
        $bentuk = Bentuk::find($bentuk_id);
        $otherBentuk = Bentuk::where('nama_bentuk', $request->input('nama_bentuk'))->first();

        if ($bentuk->nama_bentuk != $request->input('nama_bentuk')) {
            if (!$otherBentuk) {
                $bentuk->nama_bentuk = $request->input('nama_bentuk');
                $bentuk->save();
                return back()->with('info', 'Data bentuk berhasil diupdate');
            } else {
                return back()->with('error', 'Data bentuk tidak boleh sama!');
            }
        }

        return back();
    }



    /**
     * Render view satuan user interface
     * 
     * @return View
     */
    protected function showDataSatuan()
    {
        $data = [
            'title'     => $this->label . ' Satuan',
            'id_page'   => $this->id_page[4],
            'satuan'    => Satuan::orderBy('satuan_id', 'DESC')->get(),
        ];

        return view('dash.master-data.satuan', $data);
    }

    /**
     * Handle request to create satuan
     * 
     * @param Request
     * @return RedirectResponse
     */
    protected function createSatuan(Request $request)
    {
        $existingSatuan = Satuan::where('satuan_barang', $request->input('satuan_barang'))->first();

        if (!$existingSatuan) {
            DB::table('satuan')->insert([
                'satuan_barang' => $request->input('satuan_barang'),
            ]);

            return back()->with('success', 'Sukses membuat data satuan');
        }

        return back()->with('error', 'Data satuan tidak boleh sama');
    }

    /**
     * Handle request to delete satuan
     * 
     * @return RedirectResponse
     */

    protected function deleteSatuan($satuan_id)
    {
        DB::table('satuan')->where('satuan_id', $satuan_id)->delete();

        return back()->with('info', 'Data satuan berhasil dihapus!');
    }

    /**
     * Handle request to update satuan
     * 
     * @param Request
     * @return RedirectResponse
     */
    protected function updateSatuan(Request $request, $satuan_id)
    {
        $satuan = Satuan::find($satuan_id);
        $otherSatuan = Satuan::where('satuan_barang', $request->input('satuan_barang'))->first();

        if ($satuan->satuan_barang != $request->input('satuan_barang')) {
            if (!$otherSatuan) {
                $satuan->satuan_barang = $request->input('satuan_barang');

                $satuan->save();
                return back()->with('info', 'Data satuan berhasil diupdate');
            } else {
                return back()->with('error', 'Data satuan tidak boleh sama');
            }
        }

        return back();
    }

    /**
     * Render view golongan user interface
     * 
     * @return View
     */
    protected function showDataGolongan()
    {
        $data = [
            'title'     => $this->label . ' Golongan',
            'id_page'   => $this->id_page[5],
            'golongan'  => Golongan::orderBy('golongan_id', 'DESC')->get(),
        ];

        return view('dash.master-data.golongan', $data);
    }

    /**
     * Handle request to create golongan
     * 
     * @param Request
     * @return RedirectResponse
     */
    protected function createGolongan(Request $request)
    {
        $existingGolongan = Golongan::where('jenis_golongan', $request->input('jenis_golongan'))->first();

        if (!$existingGolongan) {
            DB::table('golongan')->insert([
                'jenis_golongan' => $request->input('jenis_golongan'),
            ]);

            return back()->with('success', 'Sukses membuat data golongan');
        }

        return back()->with('error', 'Data golongan tidak boleh sama');
    }

    /**
     * Handle request to delete golongan
     * 
     * @return RedirectResponse
     */

    protected function deleteGolongan($golongan_id)
    {
        DB::table('golongan')->where('golongan_id', $golongan_id)->delete();

        return back()->with('info', 'Data golongan berhasil dihapus!');
    }

    /**
     * Handle request to update golongan
     * 
     * @param Request
     * @return RedirectResponse
     */
    protected function updateGolongan(Request $request, $golongan_id)
    {
        $golongan = Golongan::find($golongan_id);
        $otherGolongan = Golongan::where('jenis_golongan', $request->input('jenis_golongan'))->first();

        if ($golongan->jenis_golongan != $request->input('jenis_golongan')) {
            if (!$otherGolongan) {
                $golongan->jenis_golongan = $request->input('jenis_golongan');

                $golongan->save();
                return back()->with('info', 'Data golongan berhasil diupdate');
            } else {
                return back()->with('error', 'Data golongan tidak boleh sama');
            }
        }

        return back();
    }
}

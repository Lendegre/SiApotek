<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Bentuk;
use App\Models\Golongan;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterDataController extends Controller
{
    protected $label, $id_page;

    public function __construct()
    {
        $this->label = 'Data ';
        $this->id_page = [2, 3, 4, 5, 6, 7];
    }

    /**
     * Render view barang user interface
     * 
     * @return View
     */
    protected function showDataBarang()
    {
        $data = [
            'title'     => $this->label . 'Barang',
            'id_page'   => $this->id_page[0],
        ];

        return view('dash.master-data.barang', $data);
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

            return back()->with('success', 'Success to create supplier');
        }

        return back()->with('error', 'Nama supplier is duplicate');
    }

    /**
     * Handle request to delete supplier
     * 
     * @return RedirectResponse
     */

    protected function deleteSupplier($supplier_id)
    {
        DB::table('supplier')->where('supplier_id', $supplier_id)->delete();

        return back()->with('info', 'Supplier has been deleted');
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

        $supplier->nama_supplier = $request->input('nama_supplier');
        $supplier->nama_sales = $request->input('nama_sales');
        $supplier->no_telp = $request->input('no_telp');
        $supplier->alamat = $request->input('alamat');

        if ($supplier->isDirty()) {
            $supplier->save();
            return back()->with('info', 'Supplier has been updated');
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

            return back()->with('success', 'Success to create kategori');
        }

        return back()->with('error', 'Nama kategori is duplicate');
    }

    /**
     * Handle request to delete kategori
     * 
     * @return RedirectResponse
     */

    protected function deleteKategori($kategori_id)
    {
        DB::table('kategori')->where('kategori_id', $kategori_id)->delete();

        return back()->with('info', 'Kategori has been deleted');
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

        $kategori->nama_kategori = $request->input('nama_kategori');

        if ($kategori->isDirty()) {
            $kategori->save();
            return back()->with('info', 'Kategori has been updated');
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
            'title'     => $this->label . 'Bentuk',
            'id_page'   => $this->id_page[3],
            'bentuk'    => Bentuk::orderBy('bentuk_id', 'DESC')->get(),
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
        $existingBentuk = Bentuk::where('bentuk_barang', $request->input('bentuk_barang'))->first();

        if (!$existingBentuk) {
            DB::table('bentuk')->insert([
                'bentuk_barang' => $request->input('bentuk_barang'),
            ]);

            return back()->with('success', 'Success to create bentuk sediaan');
        }

        return back()->with('error', 'Bentuk sediaan is duplicate');
    }

    /**
     * Handle request to delete bentuk
     * 
     * @return RedirectResponse
     */

    protected function deletebentuk($bentuk_id)
    {
        DB::table('bentuk')->where('bentuk_id', $bentuk_id)->delete();

        return back()->with('info', 'Bentuk sediaan has been deleted');
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

        $bentuk->bentuk_barang = $request->input('bentuk_barang');

        if ($bentuk->isDirty()) {
            $bentuk->save();
            return back()->with('info', 'Bentuk sediaan has been updated');
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

            return back()->with('success', 'Success to create satuan');
        }

        return back()->with('error', 'Satuan is duplicate');
    }

    /**
     * Handle request to delete satuan
     * 
     * @return RedirectResponse
     */

    protected function deleteSatuan($satuan_id)
    {
        DB::table('satuan')->where('satuan_id', $satuan_id)->delete();

        return back()->with('info', 'Satuan sediaan has been deleted');
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

        $satuan->satuan_barang = $request->input('satuan_barang');

        if ($satuan->isDirty()) {
            $satuan->save();
            return back()->with('info', 'Satuan has been updated');
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

            return back()->with('success', 'Success to create golongan');
        }

        return back()->with('error', 'Golongan is duplicate');
    }

    /**
     * Handle request to delete golongan
     * 
     * @return RedirectResponse
     */

    protected function deleteGolongan($golongan_id)
    {
        DB::table('golongan')->where('golongan_id', $golongan_id)->delete();

        return back()->with('info', 'Golongan has been deleted');
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

        $golongan->jenis_golongan = $request->input('jenis_golongan');

        if ($golongan->isDirty()) {
            $golongan->save();
            return back()->with('info', 'Golongan has been updated');
        }

        return back();
    }
}

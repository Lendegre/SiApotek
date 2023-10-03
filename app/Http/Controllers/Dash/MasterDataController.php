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
            'supplier'  => Supplier::all(),
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
     * Render view kategori user interface
     * 
     * @return View
     */
    protected function showDataKategori()
    {
        $data = [
            'title'     => $this->label . 'Kategori',
            'id_page'   => $this->id_page[2],
            'kategori'  => Kategori::all(),
        ];

        return view('dash.master-data.kategori', $data);
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
            'bentuk'    => Bentuk::all(),
        ];

        return view('dash.master-data.bentuk', $data);
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
            'satuan'    => Satuan::all(),
        ];

        return view('dash.master-data.satuan', $data);
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
            'golongan'  => Golongan::all(),
        ];

        return view('dash.master-data.golongan', $data);
    }
}

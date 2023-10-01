<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        ];

        return view('dash.master-data.supplier', $data);
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
        ];

        return view('dash.master-data.golongan', $data);
    }
}

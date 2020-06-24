<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Payments;
use DataTables;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $sidebar = "payments";
        return view('payments.index', compact('sidebar'));
    }

    public function getdata()
    {
        $data = Payments::select(['id', 'customer', 'lokasi_proyek', 'tgl_pembayaran', 'nominal', 'keterangan']);
        return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn = '<button class="btn btn-sm btn-info detailProduksi" data-placement="bottom" rel="tooltip" id="detailProduksi" title="Detail Data" id-view="'.$row->id.'"><i class="material-icons">visibility</i></button>
                            <a href="/produksi/edit/'.$row->id.'" rel="tooltip" class="btn btn-sm btn-success" data-placement="bottom" title="Edit Data"><i class="material-icons">edit</i></a>
                            <button rel="tooltip" class="btn btn-sm btn-danger dltDataProd" data-placement="bottom" title="Hapus Data" id="dltDataProd" data-id="'.$row->id.'"><i class="material-icons">delete</i></button>';
                        return $btn;
                        })->rawColumns(['action'])->make(true);
    }

    public function store(Request $request)
    {
        $mytime = Carbon::now();
        $money = preg_replace('/[^,\d]/', '', $request->nominal);

        $data=DB::table('pembayaran')->insert([
            'customer' => strtoupper($request->cust),
            'lokasi_proyek' => strtoupper($request->lokpro),
            'tgl_pembayaran' => date("Y-m-d", strtotime($request->tgl)),
            'nominal' => $money,
            'keterangan' => $request->ket,
            'created_at' => $mytime->toDateTimeString(),
        ]);
        return response ()->json ();
    }
}

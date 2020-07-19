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
        $data = Payments::select(['id', 'customer', 'lokasi_proyek', 'tgl_pembayaran', 'nominal', 'keterangan'])->latest('created_at');
        return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn = '<button class="btn btn-sm btn-info detailProduksi" data-placement="bottom" rel="tooltip" id="detailProduksi" title="Detail Data" id-view="'.$row->id.'"><i class="material-icons">visibility</i></button>
                            <button rel="tooltip" class="btn btn-sm btn-success upDataPay" data-placement="bottom" title="Edit Data" upd-id="'.$row->id.'"><i class="material-icons">edit</i></button>
                            <button rel="tooltip" class="btn btn-sm btn-danger dltDataPay" data-placement="bottom" title="Hapus Data" id="dltDataPay" data-id="'.$row->id.'"><i class="material-icons">delete</i></button>';
                        return $btn;
                        })->rawColumns(['action'])->make(true);
    }

    public function store(Request $request)
    {
        $mytime = Carbon::now();
        $money = preg_replace('/[^,\d]/', '', $request->nominal);
        $dt = str_replace('/', '-', $request->tgl);

        DB::table('pembayaran')->insert([
            'customer' => strtoupper($request->cust),
            'lokasi_proyek' => strtoupper($request->lokpro),
            'tgl_pembayaran' => date("Y-m-d", strtotime($dt)),
            'nominal' => $money,
            'keterangan' => $request->ket,
            'created_at' => $mytime->toDateTimeString(),
        ]);
        return response ()->json ();
    }

    public function destroy($id)
    {
        Payments::find($id)->delete();
        return response ()->json ();
    }

    public function update(Request $request, $id)
    {
        $mytime = Carbon::now();
        $money = preg_replace('/[^,\d]/', '', $request->nominal);
        $dt = str_replace('/', '-', $request->tgl);

        DB::table('pembayaran')->where('id', $id)
            ->update([
                'customer' => strtoupper($request->cust),
                'lokasi_proyek' => strtoupper($request->lokpro),
                'tgl_pembayaran' => date("Y-m-d", strtotime($dt)),
                'nominal' => $money,
                'keterangan' => $request->ket,
                'updated_at' => $mytime->toDateTimeString(),
            ]);
        return response ()->json ();
    }

    public function edit($id)
    {
        $data = Payments::find($id);
        return $data;
    }
}

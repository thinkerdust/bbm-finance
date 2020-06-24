<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Produksi;
use DataTables;

class ProduksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $sidebar = "produksi";
        return view('produksi.index', compact('sidebar'));
    }

    public function getdata()
    {
        $data = Produksi::select(['id','customer', 'lokasi_proyek', 'tgl_pengecoran', 'volume', 'sum_harga']);
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<button class="btn btn-sm btn-info detailProduksi" data-placement="bottom" rel="tooltip" id="detailProduksi" title="Detail Data" id-view="'.$row->id.'"><i class="material-icons">visibility</i></button>
                    <a href="/produksi/edit/'.$row->id.'" rel="tooltip" class="btn btn-sm btn-success" data-placement="bottom" title="Edit Data"><i class="material-icons">edit</i></a>
                    <button rel="tooltip" class="btn btn-sm btn-danger dltDataProd" data-placement="bottom" title="Hapus Data" id="dltDataProd" data-id="'.$row->id.'"><i class="material-icons">delete</i></button>';
                  return $btn;
                })->rawColumns(['action'])->make(true);   
    }

    public function create() 
    {
        $sidebar = "produksi";
        $data = DB::table('tb_mutu_beton')->get();
        return view('produksi.create', compact('data', 'sidebar'));
    }

    public function store(Request $request)
    {
        $mytime = Carbon::now();

        $hrg1 = $request->hargam3;
        $hrg2 = $request->total_hrg;
        $hrg_m3=preg_replace('/[^,\d]/', '', $hrg1);
        $hrg_ttl=preg_replace('/[^,\d]/', '', $hrg2);

        DB::table('produksi')->insert([
            'customer' => strtoupper($request->customer),
            'lokasi_proyek' => strtoupper($request->lks_proyek),
            'tgl_pengecoran' => date("Y-m-d", strtotime($request->tgl_pngcoran)),
            'mutu_beton' => $request->mutu_btn,
            'volume' => $request->volume_btn,
            'harga_m3' => $hrg_m3,
            'sum_harga' => $hrg_ttl,
            'keterangan' => $request->keterangan,
            'created_at' => $mytime->toDateTimeString(),
        ]);
        return redirect('produksi');
    }

    public function show($id)
    {
        $data = DB::table('produksi AS pd')
                    ->where('pd.id', '=', $id)
                    ->join('tb_mutu_beton AS mt', 'pd.mutu_beton', '=', 'mt.kode_mutu')
                    ->select('pd.customer as customer', 'pd.lokasi_proyek as lokasi_proyek', 'pd.tgl_pengecoran as tgl_pengecoran','mt.mutu_beton AS mutu_beton', 'pd.volume as volume', 'pd.harga_m3 as harga_m3', 'pd.sum_harga as sum_harga', 'pd.keterangan as keterangan')
                    ->get();
        // $data = Produksi::find($id);
        return $data;
    }

    public function destroy($id) 
    {
        Produksi::find($id)->delete();
        return response ()->json ();
        // return Response::json($product);
    }

    public function edit($id)
    {
        $sidebar = "produksi";
        $data = Produksi::find($id);
        $mutu = DB::table('tb_mutu_beton')->get();
        return view('produksi.edit', compact('data','mutu', 'sidebar'));
    }

    public function update(Request $request, $id)
    {
        $mytime = Carbon::now();

        $hrg1 = $request->hargam3;
        $hrg2 = $request->total_hrg;
        $hrg_m3=preg_replace('/[^\d]/', '', $hrg1);
        $hrg_ttl=preg_replace('/[^\d]/', '', $hrg2);

        $data = DB::table('produksi')->where('id',$id)
            ->update([
            'customer' => strtoupper($request->customer),
            'lokasi_proyek' => strtoupper($request->lks_proyek),
            'tgl_pengecoran' => date("Y-m-d", strtotime($request->tgl_pngcoran)),
            'mutu_beton' => $request->mutu_btn,
            'volume' => $request->volume_btn,
            'harga_m3' => $hrg_m3,
            'sum_harga' => $hrg_ttl,
            'keterangan' => $request->keterangan,
            'updated_at' => $mytime->toDateTimeString(),
        ]);

        return redirect('produksi');
    }
}

@extends('master')

@section('title', 'Produksi')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{route('updateproduksi', $data['id'])}}" autocomplete="off" class="form-horizontal">
            {{ csrf_field() }}
            <div class="card ">
                <div class="card-header card-header-success">
                <h4 class="card-title">Update Data Produksi</h4>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Customer</label>
                        <div class="col-sm-7">
                        <div class="form-group">
                            <input class="form-control" name="customer" id="input-customer" type="text" placeholder="Name Customer" required="true" style="text-transform:uppercase" value="{{$data['customer']}}"/>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Lokasi Proyek</label>
                        <div class="col-sm-7">
                        <div class="form-group">
                            <input class="form-control" name="lks_proyek" id="input-lksproyek" type="text" placeholder="Lokasi Pengecoran / Proyek" required style="text-transform:uppercase" value="{{$data['lokasi_proyek']}}"/>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Tanggal Pengecoran</label>
                        <div class="col-sm-7">
                        <div class="form-group">
                            <input class="form-control datepicker" name="tgl_pngcoran" id="tglpngcoran" type="text" placeholder="Tanggal Pengecoran" required style="text-transform:uppercase" value="{{date('d-m-Y', strtotime($data['tgl_pengecoran']))}}"/>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Mutu Beton</label>
                        <div class="col-sm-7">
                        <div class="form-group">
                            <select class="form-control select2" width="100%" name="mutu_btn" required>
                                <option value=""></option>
                                @foreach ($mutu as $mt)
                                <option value="{{ $mt->kode_mutu }}" {{$data['mutu_beton']==$mt->kode_mutu ? 'selected':'' }}>{{ $mt->mutu_beton }}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Volume Beton</label>
                        <div class="col-sm-7">
                        <div class="form-group">
                            <input class="form-control" name="volume_btn" id="input-volumebtn" type="number" placeholder="VOLUME BETON" step="any" title="use (.) for choma" value="{{$data['volume']}}" required/>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Harga Beton (M3)</label>
                        <div class="col-sm-7">
                        <div class="form-group">
                            <input class="form-control harga" name="hargam3" id="input-hargam3" type="text" placeholder="HARGA BETON (M3)" value="Rp. {{number_format($data['harga_m3'])}}" required />
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Total Harga Beton</label>
                        <div class="col-sm-7">
                        <div class="form-group harga">
                            <input class="form-control" name="total_hrg" id="input-totalhrg" type="text" placeholder="TOTAL HARGA BETON" value="Rp. {{number_format($data['sum_harga'])}}" readonly/>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-7">
                        <div class="form-group">
                            <select class="form-control select2" width="100%" name="keterangan" required> 
                                <option value=""></option>
                                <option value="01" {{ $data['keterangan'] == "01" ? 'selected':'' }}>PPN</option>
                                <option value="02" {{ $data['keterangan'] == "02" ? 'selected':'' }}>NON PPN</option>
                            </select>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row card-footer ml-auto mr-auto">
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-info">Save</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-danger" onclick="window.history.back()">Cancel</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection
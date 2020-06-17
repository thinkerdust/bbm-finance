@extends('master')

@section('title', 'Produksi')

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-success">
              <h4 class="card-title ">Table Produksi</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 text-right">
                  <a href="{{ route('addproduksi') }}" class="btn btn-sm btn-warning">add data</a>
                </div>
              </div>
              <div class="table-responsive">
                <table id="produksi-datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
                  <thead class="text-primary">
                    <th>
                      ID
                    </th>
                    <th>
                      Customer
                    </th>
                    <th>
                      Lokasi Proyek
                    </th>
                    <th>
                      Tanggal Pengecoran
                    </th>
                    <th>
                      Volume
                    </th>
                    <th>
                      Total ($)
                    </th>
                    <th class="no-sort text-center">
                      Action
                    </th>
                  </thead>
                  <tbody>
                  @php $no = 1; @endphp
                  @foreach ($data as $row)
                    <tr>
                      <td>
                        {{ $no++ }}
                      </td>
                      <td>
                        {{ $row->customer }}
                      </td>
                      <td>
                        {{ $row->lokasi_proyek }}
                      </td>
                      <td>
                        <!-- {{ $row->tgl_pengecoran }} -->
                        {{ date('d-M-y', strtotime($row->tgl_pengecoran)) }}
                      </td>
                      <td>
                        {{ $row->volume }} M3
                      </td>
                      <td class="text-primary">
                        Rp. {{ number_format($row->sum_harga) }}
                      </td>
                      <td class="td-actions text-right">
                            <button type="button" class="btn btn-info detailProduksi" id="detailProduksi" rel="tooltip" data-placement="bottom" title="Detail Data" id-view='{{$row->id}}'>
                              <i class="material-icons">visibility</i>
                            </button>
                            <a href="{{route('editproduksi', $row->id)}}">
                            <button type="button" rel="tooltip" class="btn btn-success" data-placement="bottom" title="Edit Data">
                              <i class="material-icons">edit</i>
                            </button>
                            </a>
                            <button type="button" rel="tooltip" class="btn btn-danger dltDataProd" data-placement="bottom" title="Hapus Data" id="dltDataProd" data-id='{{ $row->id }}'>
                              <i class="material-icons">delete</i>
                            </button>
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
    </div>
</div>

<!-- modal detail produksi -->
<div class="modal modal-danger fade" id="modalDetailProduksi" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> 
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Data Produksi</h4>
      </div>
      <div class="modal-body">
        <table style="width:100%">
          <tr>
            <th style="width:25%;text-align:left;">Customer</td>
            <td style="width:5%;">:</td>
            <td style="width:65%;text-align:left;"><span id="modalDetailCustomer"></span></td>
          </tr>
          <tr>
            <th style="width:25%;text-align:left;">Lokasi Proyek</td>
            <td style="width:5%;">:</td>
            <td style="width:65%;text-align:left;"><span id="modalDetailLokProyek"></span></td>
          </tr>
           <tr>
            <th style="width:25%;text-align:left;">Tgl Pengecoran</td>
            <td style="width:5%;">:</td>
            <td style="width:65%;text-align:left;"><span id="modalDetailTglPengecoran"></span></td>
          </tr>
          <tr>
            <th style="width:25%;text-align:left;">Mutu</td>
            <td style="width:5%;">:</td>
            <td style="width:65%;text-align:left;"><span id="modalDetailMutu"></span></td>
          </tr>
          <tr>
            <th style="width:25%;text-align:left;">Volume</td>
            <td style="width:5%;">:</td>
            <td style="width:65%;text-align:left;"><span id="modalDetailVolume"></span></td>
          </tr>
           <tr>
            <th style="width:25%;text-align:left;">Harga (M3)</td>
            <td style="width:5%;">:</td>
            <td style="width:65%;text-align:left;"><span id="modalDetailHargaM3"></span></td>
          </tr>
           <tr>
            <th style="width:25%;text-align:left;">Total Harga</td>
            <td style="width:5%;">:</td>
            <td style="width:65%;text-align:left;"><span id="modalDetailTtlHarga"></span></td>
          </tr>
           <tr>
            <th style="width:25%;text-align:left;">Keterangan</td>
            <td style="width:5%;">:</td>
            <td style="width:65%;text-align:left;"><span id="modalDetailKet"></span></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal" style="margin-right: 10px">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@extends('master')

@section('title', 'Pembayaran')

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-success">
              <h4 class="card-title ">Table Pembayaran</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 text-right">
                  <button type="button" id="btn-addpay" class="btn btn-sm btn-warning">add data</button>
                </div>
              </div>
              <div class="table-responsive">
                <table id="pembayaran-datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
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
                      Tanggal Pembayaran
                    </th>
                    <th>
                      Nominal
                    </th>
                    <th>
                      Keterangan
                    </th>
                    <th class="text-center">
                      Action
                    </th>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- show modal create data payments -->
<div class="modal modal-danger fade" id="modalAddPayment" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> 
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Pembayaran</h4>
      </div>
      <form autocomplete="off" class="form-horizontal" role="form" id="addPayments">
      <div class="modal-body">
        <table style="width:100%">
          <tr>
            <th style="width:25%;text-align:left;">Customer</td>
            <td style="width:5%;">:</td>
            <td style="width:65%;text-align:left;">
              <input type="text" class="form-control" id="pay-customer" name="pay-customer" placeholder="Masukkan Customer" style="text-transform:uppercase" required>
              <span id="sp-cust" style="color:red"></span>
            </td>
          </tr>
          <tr>
            <th style="width:25%;text-align:left;">Lokasi Proyek</td>
            <td style="width:5%;">:</td>
            <td style="width:65%;text-align:left;">
              <input type="text" class="form-control" id="pay-lokpro" name="pay-lokpro" placeholder="Masukkan Lokasi Proyek" style="text-transform:uppercase" required>  
              <span id="sp-lokpro" style="color:red"></span>
            </td>
          </tr>
           <tr>
            <th style="width:25%;text-align:left;">Tgl Pembayaran</td>
            <td style="width:5%;">:</td>
            <td style="width:65%;text-align:left;">
              <input type="text" class="form-control datepicker" id="tgl_payments" name="tgl_payments" placeholder="Masukkan Tanggal Pembayaran" style="text-transform:uppercase" required>  
              <span id="sp-tglpay" style="color:red"></span>
            </td>
          </tr>
          <tr>
            <th style="width:25%;text-align:left;">Nominal</td>
            <td style="width:5%;">:</td>
            <td style="width:65%;text-align:left;">
              <input type="text" class="form-control harga" id="pay-nominal" name="pay-nominal" placeholder="Masukkan Nominal" style="text-transform:uppercase" required>  
              <span id="sp-nompay" style="color:red"></span>
            </td>
          </tr>
          <tr>
            <th style="width:25%;text-align:left;">Keterangan</td>
            <td style="width:5%;">:</td>
            <td style="width:65%;text-align:left;">
              <input type="text" class="form-control" id="pay-keterangan" name="pay-keterangan" placeholder="Masukkan Keterangan" style="text-transform:uppercase" required>  
              <span id="sp-ketpay" style="color:red"></span>
            </td>
          </tr>
        </table>
      </div>
      
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="savePayments">Save</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" style="margin-right: 10px">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
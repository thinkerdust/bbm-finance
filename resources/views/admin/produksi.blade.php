@extends('index')

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
                <table class="table">
                  <thead class=" text-primary">
                    <th>
                      ID
                    </th>
                    <th>
                      Owner
                    </th>
                    <th>
                      Lokasi Proyek
                    </th>
                    <th>
                      Tanggal
                    </th>
                    <th>
                      Volume
                    </th>
                    <th>
                      Total ($)
                    </th>
                    <th class="text-right">
                      Action
                    </th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        1
                      </td>
                      <td>
                        Dakota Rice
                      </td>
                      <td>
                        Niger
                      </td>
                      <td>
                        Oud-Turnhout
                      </td>
                      <td>
                        Oud-Turnhout
                      </td>
                      <td class="text-primary">
                        $36,738
                      </td>
                      <td class="td-actions text-right">
                            <button type="button" class="btn btn-info" rel="tooltip" data-placement="bottom" title="Detail Data">
                              <i class="material-icons">visibility</i>
                            </button>
                            <button type="button" rel="tooltip" class="btn btn-success" data-placement="bottom" title="Edit Data">
                              <i class="material-icons">edit</i>
                            </button>
                            <button type="button" rel="tooltip" class="btn btn-danger dltDataProd" data-placement="bottom" title="Hapus Data" id="dltDataProd">
                              <i class="material-icons">delete</i>
                            </button>
                          </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
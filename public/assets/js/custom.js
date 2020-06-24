const tablePRO = $('#produksi-datatables').DataTable({
  serverSide: true,
  processing: true,
  ajax: {
    url: "/produksi/getdata",
  },
  columns : [
    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
    {data: 'customer', name: 'customer'},
    {data: 'lokasi_proyek', name: 'lokasi_proyek'},
    {data: 'tgl_pengecoran', name: 'tgl_pengecoran', render:function(data){return moment(data).format('D MMM YYYY');}},
    {data: 'volume', name: 'volume', render: function ( data, type, row ) {return data + ' M3';}},
    {data: 'sum_harga', name: 'sum_harga', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ' )},
    {data: 'action', name: 'action', orderable: false, searchable: false},
  ],
});

// $('#produksi-datatables').DataTable({
//   order: [],
//   columnDefs: [{
//     targets: "no-sort",
//     "orderable": false,
//   }],
// });

// $(document).ready(function(){
//   $.ajax({
//     url: '/produksi/getdata',
//     success: function(data) {
//       for(var i = 0; i < data.length; i++) {
//         $('#produksi-datatables').DataTable().row.add([
//           (i+1),
//           data[i]['customer'],
//           data[i]['lokasi_proyek'],
//           data[i]['tgl_pengecoran'],
//           data[i]['volume'],
//           data[i]['sum_harga'],
//           `<button type="button" class="btn btn-sm btn-info detailProduksi" id-view="`+data[i]['id']+`" id="detailProduksi" rel="tooltip" data-placement="bottom" title="Detail Data">
//           <i class="material-icons">visibility</i>
//           </button>
//           <a href="{{route('editproduksi', $row->id)}}">
//           <button type="button" rel="tooltip" class="btn btn-sm btn-success" data-placement="bottom" title="Edit Data">
//             <i class="material-icons">edit</i>
//           </button>
//           </a>
//           <button type="button" rel="tooltip" class="btn btn-sm btn-danger dltDataProd" data-placement="bottom" title="Hapus Data" id="dltDataProd" data-id='{{ $row->id }}'>
//             <i class="material-icons">delete</i>
//           </button>`
//         ]).draw(false);
//       }
//     }
//   })
// });

$(document).on('click', '.dltDataProd', function(e) {
    e.preventDefault();
    let col = $(this).parents('tr');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        allowOutsideClick: false,
      }).then((result) => {
        if(result.value) {
          let id = $(this).attr('data-id');
          let token = $("meta[name='csrf-token']").attr("content");
          $.ajax({
            type: "post",
            url: "/produksi/delete/"+id,
            data: {"_method":"DELETE","_token":token,"id":id},
          }).done(function(data) {
            // $('#produksi-datatables').DataTable().row(col).remove().draw();
            // $('#produksi-datatables').load(location.href + ' #produksi-datatables');
            tablePRO.ajax.reload();
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          });
        }
      })
});

$('body').on('click', '.detailProduksi', function(e) {
  e.preventDefault();
  let id = $(this).attr('id-view');
  $.ajax({
    url: "/produksi/show/"+id,
    dataType: 'JSON',
    type: 'GET',
    success:(function(data) {
      let tgl = new Intl.DateTimeFormat(['ban', 'id']).format(new Date(data[0]['tgl_pengecoran']));
      let harga = new Intl.NumberFormat(['ban', 'id']).format(data[0]['harga_m3']);
      let total = new Intl.NumberFormat(['ban', 'id']).format(data[0]['sum_harga']);
      let ket = data[0]['keterangan'];
      if(ket === '01'){
        ket = 'PPN';
      }else{
        ket = 'Non PPN';
      }
      $('#modalDetailProduksi').modal('show');
      $('#modalDetailCustomer').text(data[0]['customer']);
      $('#modalDetailLokProyek').text(data[0]['lokasi_proyek']);
      $('#modalDetailTglPengecoran').text(tgl);
      $('#modalDetailMutu').text(data[0]['mutu_beton']);
      $('#modalDetailVolume').text(data[0]['volume'] +' M3');
      $('#modalDetailHargaM3').text('Rp. '+ harga);
      $('#modalDetailTtlHarga').text('Rp. '+ total);
      $('#modalDetailKet').text(ket);
    })
  })
});

$('.datepicker').daterangepicker({
  todayHiglight: true,
  autoUpdateInput: false,
  showDropdowns: true,
  singleDatePicker: true,
  minYear: 2000,
  locale: {
    format: 'DD-MM-YYYY',
  }
}, function(start) {
  $(this.element).val(start.format('DD-MM-YYYY'));
});

$('.harga').keyup(function(e) {
  $(this).val(formatRupiah($(this).val(), 'Rp. '));
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix){
  let number_string = angka.replace(/[^,\d]/g, '').toString(),
  split   		= number_string.split(','),
  sisa     		= split[0].length % 3,
  rupiah     		= split[0].substr(0, sisa),
  ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if(ribuan){
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
};

// $('.number-format').keyup(function(e) {
//   let n = $(this).val().replace(/\D/g,'');
//   $(this).val(n);
// });

$('.select2').select2({
  placeholder: "SELECT AN OPTION",
  allowClear: true,
});

$(document).on('change', '#input-hargam3', '#input-volumebtn', function() {
  SumHargabeton();
});

function SumHargabeton() {
  let hrgm3 = $('#input-hargam3').val().replace(/\D/g,'');
  let vlmbtn = $('#input-volumebtn').val();
  if(hrgm3 && vlmbtn) {
    let totalbtn = hrgm3 * vlmbtn;
    let totalhrg = new Intl.NumberFormat(['ban', 'id']).format(totalbtn);
    // let sisa = hs.length % 3;
    // let rupiah = hs.substr(0, sisa);
    // let ribuan = hs.substr(sisa).match(/\d{3}/gi);
    // if(ribuan){
    //     separator = sisa ? '.' : '';
    //     rupiah += separator + ribuan.join('.');
    //   }
    $('#input-totalhrg').val('Rp. '+ totalhrg);
  }else{
    $('#input-totalhrg').val('');
  }
};


// Payments JS
const tablePay = $('#pembayaran-datatables').DataTable({
  serverSide: true,
  processing: true,
  ajax: {
    url: "/payments/getdata",
  },
  columns : [
    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
    {data: 'customer', name: 'customer'},
    {data: 'lokasi_proyek', name: 'lokasi_proyek'},
    {data: 'tgl_pembayaran', name: 'tgl_pembayaran', render:function(data){return moment(data).format('D MMM YYYY');}},
    {data: 'nominal', name: 'nominal', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ' )},
    {data: 'keterangan', name: 'keterangan'},
    {data: 'action', name: 'action', orderable: false, searchable: false},
  ],
});

$('#btn-addpay').click(function(e) {
  e.preventDefault();
  $('#modalAddPayment').modal('show');
});

// $('body').on('click', '#savePayments', function(e){
//   e.preventDefault();
//   let cust = $('#pay-customer').val();
//   let lokpro = $('#pay-lokpro').val();
//   let tgl = $('#tgl_payments').val();
//   let nominal = $('#pay-nominal').val();
//   let ket = $('#pay-keterangan').val();
//   $.ajaxSetup({
//       headers: {
//           'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
//       }
//   });
//   $.ajax({
//     url: '/payments/store',
//     type: 'POST',
//     dataType: 'json',
//     data: {cust: cust, lokpro: lokpro, tgl: tgl, nominal: nominal, ket: ket}
//   }).done(function(data){
//     tablePay.ajax.reload();
//     $('#modalAddPayment').modal('hide');
//     Swal.fire({
//       title: 'Success!',
//       text: 'Your file has been save.',
//       type: 'success',
//       timer: '2000'
//     })
//   })
// });

$(document).ready(function(){
  $('#addPayments').submit(function(e){
    e.preventDefault();
    let cust = $('#pay-customer').val();
    let lokpro = $('#pay-lokpro').val();
    let tgl = $('#tgl_payments').val();
    let nominal = $('#pay-nominal').val();
    let ket = $('#pay-keterangan').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
      url: '/payments/store',
      type: 'POST',
      dataType: 'json',
      data: {cust: cust, lokpro: lokpro, tgl: tgl, nominal: nominal, ket: ket}
    }).done(function(data){
      tablePay.ajax.reload();
      $('#modalAddPayment').modal('hide');
      Swal.fire({
        title: 'Success!',
        text: 'Your file has been save.',
        type: 'success',
        timer: '2000'
      })
    })
    return false;
  })
});
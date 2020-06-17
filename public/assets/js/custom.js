// const table = $('#produksi-datatables').DataTable();

$('#produksi-datatables').DataTable({
  "order": [],
  "columnDefs": [ {
    "targets"  : 'no-sort',
    "orderable": false,
  }],
});

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
            // $('#produksi-datatables').DataTable().ajax.reload();
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          });
        }
      })
});

$('.detailProduksi').on('click', function(e) {
  e.preventDefault();
  let id = $(this).attr('id-view');
  $.ajax({
    url: "/produksi/show/"+id,
    dataType: 'JSON',
    type: 'GET',
    success:(function(data) {
      console.log(data);
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

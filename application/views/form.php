<div class="row">
    <div class="col-lg-12">
    <!-- <h1>Tables <small>Sort Your Data</small></h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-edit"></i> form</li>
    </ol> -->
    
    <div class="alert" style="height: 80px">
        <div class="hide " id="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <b class="nama"></b> <span class="pesan"></span>        </div>
    </div>

    </div>
</div>

<div class="row" style="margin-bottom: 23px;">
    <form action="" method="POST" id="formInputTamu">
        <div class="col-lg-2">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" autofocus autocomplete="off" required>
        </div>
        
        <div class="col-lg-2">
            <label for="alamat">Alamat</label>
            <input type="text"  class="form-control" name="alamat" id="alamat" autocomplete required>
        </div>

        <div class="col-lg-2">
            <label for="uang">Uang</label>
            <input type="text"  class="form-control" name="uang" id="uang">
        </div>

        <div class="col-lg-2">
            <label for="beras">Beras(Liter)</label>
            <input type="text"  class="form-control" name="beras" id="beras">
        </div>

        <div class="col-lg-2">
            <label for="keterangan">Keterangan</label>
            <input type="text"  class="form-control" name="keterangan" id="keterangan">
        </div>

        <div class="col-lg-2" style="margin-top: 22px">
            <button type="button" class="btn btn-success" id="tombolForm" onclick="tambah()">simpan</button>
        </div>
    </form>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover tablePencatatan table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Uang</th>
                    <th>Beras</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th style="width: 130px;">Pilihan</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>    
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.tablePencatatan').DataTable({
            // "scrollX"   : true,
            "processing": true,
            "serverSide": true,
            "ajax"      : {
                url: "<?php echo base_url('form/getDataTamu') ?>",
                type:'POST',
            },
            "columnDefs" : [{
                "targets" : [0,7,8],
                "orderable" : false,
            }]

        });

        $('.dataTables_filter').css('float', 'right');
        
    });

    function reloadTableTamu()
    {
        $('.tablePencatatan').DataTable().ajax.reload();
    }

    function tambah(){
            var data = $('#formInputTamu').serialize();

            $.ajax({
                url     : "<?= base_url('form/tambah') ?>",
                type    : "POST",
                data    : data,
                dataType: "JSON",
                success : function(res) {
                    if(res.res == 'true') {
                        $('#formInputTamu').trigger('reset');
                        reloadTableTamu();
                        notif('success', res.nama, 'berhasil ditambah');
                    } else {
                        notif('warning', '', 'Nama / Alamat tidak boleh kosong')
                    }
                }
            });
    }

    function formUbah(id)
    {
        $('#tombolForm').removeClass('btn-success');
        $('#tombolForm').addClass('btn-primary');
        $('#tombolForm').text('Ubah');
        $('#tombolForm').attr('onclick', 'ubah()');
        $('#formInputTamu').prepend('<input name="id" id="id" value="'+id+'" hidden>');
        $.ajax({
            url     : "<?= base_url('form/getData') ?>",
            type    : "POST",
            data    : {"id" : id},
            dataType: "JSON",
            success : function(res) {
                $('#nama').val(res.nama);
                $('#alamat').val(res.alamat);
                $('#uang').val(res.uang);
                $('#beras').val(res.beras);
                $('#keterangan').val(res.keterangan);

                }
            });
    }

    function ubah()
    {
        $('#tombolForm').removeClass('btn-primary');
        $('#tombolForm').addClass('btn-success');
        $('#tombolForm').text('Tambah');
        $('#tombolForm').attr('onclick', 'tambah()');

        var data = $('#formInputTamu').serialize();
        $.ajax({
            url     : "<?= base_url('form/ubah') ?>",
            type    : "POST",
            data    : data,
            dataType: "JSON",
            success : function(res) {
                $('#formInputTamu').trigger('reset');
                reloadTableTamu();
                notif('success', res.nama, 'Berhasil diubah');
            }
        });
    }

    var rupiah = document.getElementById('uang');
		rupiah.addEventListener('keypress', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, '');
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
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
			return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
		}

    function notif(alert = null, data = null, pesan = null)
    {
        var jenis;
        var cls = 'alert alert-dismissable ';
        if(alert == 'success') {
            jenis = cls+'alert-success';
        } else if(alert == 'info') {
            jenis = cls+'alert-info'
        } else if(alert == 'warning') {
            jenis = cls+'alert-warning'
        } else if(alert == 'danger') {
            jenis = cls+'alert-danger'
        } else {
            jenis = cls+'alert-success';
        }

        $('#alert').addClass(jenis);
        $('.nama').text(data);
        $('.pesan').text(pesan);

        $('#alert').fadeIn();
        $('#alert').removeClass('hide');
        setTimeout(function(){
        $('#alert').fadeOut(2000);
      }, 1000);
    }

</script>
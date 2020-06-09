<div class="row">
    <div class="col-lg-12">
    <!-- <h1>Tables <small>Sort Your Data</small></h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-edit"></i> form</li>
    </ol> -->
    
    <div class="alert" style="height: 80px">
        <!-- <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            We're using <a class="alert-link" href="http://tablesorter.com/docs/">Tablesorter 2.0</a> for the sort function on the tables. Read the documentation for more customization options or feel free to use something else!
        </div> -->
    </div>

    </div>
</div>


<div class="row" style="margin-bottom: 23px;">
    <form action="" method="POST" id="formInputTamu">
        <div class="col-lg-2">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" autofocus>
        </div>
        
        <div class="col-lg-2">
            <label for="alamat">Alamat</label>
            <input type="text"  class="form-control" name="alamat" id="alamat">
        </div>

        <div class="col-lg-2">
            <label for="uang">Uang</label>
            <input type="text"  class="form-control" name="uang" id="uang">
        </div>

        <div class="col-lg-2">
            <label for="beras">Beras</label>
            <input type="text"  class="form-control" name="beras" id="beras">
        </div>

        <div class="col-lg-2">
            <label for="keterangan">Keterangan</label>
            <input type="text"  class="form-control" name="keterangan" id="keterangan">
        </div>

        <div class="col-lg-2" style="margin-top: 22px">
            <button type="button" class="btn btn-success btnSimpan">simpan</button>
        </div>
    </form>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover tablePencatatan">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Uang</th>
                    <th>Beras</th>
                    <th>Keterangan</th>
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
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url('form/getDataTamu') ?>",
                type:'POST',
            },
            "columnDefs" : [{
                "targets" : [0],
                "orderable" : false,
            }]

        });

        $('.dataTables_filter').css('float', 'right');
        

        simpan();
    });

    function simpan(){
        $('.btnSimpan').click(function(){
            var data = $('#formInputTamu').serialize();

            $.ajax({
                url     : "<?= base_url('form/tambahTamu') ?>",
                type    : "POST",
                data    : data,
                dataType:  "JSON",
                success : function(res) {
                    if(res == 'true') {
                        alert('berhasil');
                        $('#formInputTamu').trigger('reset');
                    }
                }
            });
        });
    }

</script>
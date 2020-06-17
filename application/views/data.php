<div class="row">
    <div class="col-lg-12">
    <h1>Data <small> Tamu</small></h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-users"></i> Tamu</li>
    </ol>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <label for="">Menampilkan data dari :</label>
        <select class="form-control float-left" name="kampung" id="kampung">
                <option value="" hidden>Pilih kampung</option>
            <?php foreach($kampung->result() as $k) { ?>
                <option value="<?= $k->kampung ?>"><?= $k->kampung ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-sm-12">
        <table class="table table-responsive tableDataTamu">
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
                    <th>Status</th>
                    <th style="width: 70px;">Pilihan</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>    
    </div>
</div>

<script>
    $(document).ready(function(){

        $('#kampung').change(function(){
            var kampung = $(this).val();
            reloadTable(kampung);
            
        });

        



//TUTUP
    });


    function tandai(id)
    {
        var kampung = $('#kampung').val();
        
        $.ajax({
            url     : "<?= base_url('data/tandai') ?>",
            type    : "POST",
            data    : {'id' : id},
            dataType: "JSON",
            success : function(res) {
                if(res.res == 'true') {
                    notif('success', '', 'berhasil menandai');
                }
                reloadTable(kampung);
            }
        });
    }

    function reloadTable(kampung)
    {
        $('.tableDataTamu').dataTable().fnDestroy();
            $('.tableDataTamu').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax"      : {
                    url : "<?= base_url('data/getDataTamu') ?>",
                    type: 'POST',
                    data: {'kampung' : kampung}
                },
                "columnDefs" : [{
                    "targets"  : [0,7,8],
                    "orderable": false,
                }],
                "rowCallback": function( row, data ) {
                    console.log(data[5]);
                    if ( data[8] == 'LAMA') {
                    $('td', row).parent().addClass( 'success' );
                    }
                },
                "language" : {
                "decimal"       : "",
                "emptyTable"    : "Tak ada data yang tersedia pada tabel ini",
                "info"          : "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                "infoEmpty"     : "Menanpilkan 0 hingga 0 dari 0 entri",
                "infoFiltered"  : "(saring dari _MAX_ total entri)",
                "infoPostFix"   : "",
                "thousands"     : ",",
                "lengthMenu"    : "Menampilkan _MENU_ entri",
                "loadingRecords": "Memuat...",
                "processing"    : "Memproses...",
                "search"        : "Pencarian:",
                "zeroRecords"   : "Tidak ditemukan data yang cocok ",
                "paginate"      : {
                "first"   : "Pertama",
                "last"    : "Terakhir",
                "next"    : "Selanjutnya",
                "previous": "Sebelumnya"
                    },
                "aria": {
                "sortAscending" : ": aktifkan untuk mengurutkan kolom yang naik",
                "sortDescending": ": aktifkan untuk mengurutkan kolom yang turun"
                    }
                }
            });
            
            $('.dataTables_filter').css('float', 'right');

     

    }

</script>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIBUK</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url('assets/')?>css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="<?=base_url('assets/')?>css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url('assets/')?>font-awesome/css/font-awesome.min.css">

    <!-- nambahin -->
    <link href="<?=base_url('assets/')?>vendor/DataTables/datatables.min.css">
    <script src="<?=base_url('assets/')?>js/jquery-1.10.2.js"></script>
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=base_url()?>">SIBUK</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?=base_url('form')?>"><i class="fa fa-edit"></i> Form</a></li>
            <li><a href="<?=base_url('data')?>"><i class="fa fa-file"></i> Data</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> faiz Smith <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

        <?= $contents ?>

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->


<div class="modal fade" id="modalNotif" tabindex="-1" role="dialog" aria-labelledby="modalNotifLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
        <div class="alert alert-success" id="alert" style="margin-bottom: 0px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <b class="nama"></b> <span class="pesan"></span>
        </div>

    </div>
  </div>
</div>

<script>
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

        $('#modalNotif').modal('show');
        setTimeout(function(){
            $('#modalNotif').modal('hide');
        }, 1300)
    }
</script>


    <script src="<?=base_url('assets/')?>js/bootstrap.js"></script>
    <script src="<?=base_url('assets/')?>vendor/DataTables/datatables.min.js"></script>

  </body>
</html>
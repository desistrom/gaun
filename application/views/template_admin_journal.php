<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>IDREN</title>
  <link rel="shortcut icon" href="<?=base_url();?>media/favicon.ico" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/AdminLTE.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="plugins/iCheck/flat/blue.css"> -->
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/morris.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap3-wysihtml5.min.css">
  <style type="text/css">
    .material-icons{
      font-size: 18px !important;
    }
  </style>
  
    <script type="text/javascript">
      var base_url = "<?=base_url();?>";
    </script>
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url();?>" class="logo" style="background:white;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>IDren</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img style="width: 100px;" src="<?=base_url();?>assets/images/logo/Asset_16@4x.png"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">



          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="<?=site_url('admin/logo/profile');?>">
              <img src="<?=base_url();?>media/favicon.ico" class="user-image" alt="User Image">
              <span class="hidden-xs">Admin</span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="<?=site_url('journal/login/logout');?>"><i class="fa fa-power-off"></i> LogOut</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">


      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class=" treeview <?php if(current_url() == site_url('journal/admin/dashboard')){ ?> active <?php } ?>">
          <a href="<?=site_url('journal/admin/dashboard');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">

            </span>
          </a>

        </li>
        <li class=" treeview <?php if(current_url() == site_url('journal/admin/') || current_url() == site_url('journal/admin/accepted') || current_url() == site_url('journal/admin/ignored')){ ?>  active <?php } ?>">
          <a href="#">
            <i class="fa fa-book"></i>  <span>Journal</span>
            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if(current_url() == site_url('journal/admin')){ ?> class="active" <?php } ?>><a href="<?=site_url('journal/admin');?>"><i class="fa fa-plus"></i> Request Journal</a></li>
            <li <?php if(current_url() == site_url('journal/admin/accepted')){ ?> class="active" <?php } ?>><a href="<?=site_url('journal/admin/accepted');?>"><i class="fa fa-check"></i> Journal Accepted </a></li>
            <li <?php if(current_url() == site_url('journal/admin/rejected')){ ?> class="active" <?php } ?>><a href="<?=site_url('journal/admin/rejected');?>"><i class="fa fa-times"></i> Journal Rejected </a></li>
          </ul>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$breadcumb;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> admin</a></li>
        <li class="active"><?=$breadcumb;?></li>
      </ol>
    </section>


    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">


          <ci:doc type="modules"/>


          
        </div>

      </section>
      </div><!-- /.content-wrapper -->

       <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?=base_url();?>assets/js/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url().'assets/js/select2.min.js';?>"></script>
<script type="text/javascript">
  $('.select2').select2();
</script>
<script src="<?=base_url();?>assets/js/jquery-ui.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/datatables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    });
</script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?=base_url();?>assets/js/app.min.js"></script>
<!-- Bootstrap 3.3.7 -->

</body>
</html>


     
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Journal</title>
   <link rel="shortcut icon" href="<?=base_url();?>media/favicon.ico">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=base_url();?>assets/admin-jur/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>assets/admin-jur/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/admin-jur/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url();?>assets/admin-jur/dist/css/skins/_all-skins.min.css">
   <link rel="stylesheet" href="<?=base_url();?>assets/admin-jur/plugins/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/admin-jur/plugins/owlcarousel/assets/owl.theme.default.min.css">
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="plugins/iCheck/flat/blue.css"> -->
  <!-- Morris chart -->
  <!-- <link rel="stylesheet" href="plugins/morris/morris.css"> -->
  <!-- jvectormap -->
  <!-- <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css"> -->
  <!-- Date Picker -->
  <!-- <link rel="stylesheet" href="plugins/datepicker/datepicker3.css"> -->
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css"> -->
  <!-- bootstrap wysihtml5 - text editor -->
  <!-- <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
  <style type="text/css">
    .sidebar-form.form-search{
      /*width: 60%;*/
      display: inline-block;
      margin: 6px 0 0 0;
    }
    .sub-search{
      display: inline-table;
    }
    .slimScrollDiv{
      height: auto!important;
    }
    .sub-message{
      height: auto!important;
    }
    .navbar-nav>.user-menu .user-image{
      float: right;
      margin-left: 20px;
    }
    .skin-blue .main-header .navbar{
      background-color: white;
      border-bottom: solid 1px #CBCBCB;
    }
    .mb-notifi{
          padding: 15px;
          border-bottom: solid red 1px;
        }
        .skin-blue .main-header .navbar .nav>li>a{
          color: #D6D6E0;
        }
        .skin-blue .main-header .logo{
          background-color: #859980;
        }
        .skin-blue .main-header .logo:hover{
           background-color: #859980;
        }
        .sidebar-menu>li{
          background-color: #2BA417;
          margin-bottom: 6px;
        }
        .skin-blue .sidebar-menu>li>a{
          color: white;
        }
        .skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a {
          color: #fff;
          background: #2BA417;
          border-left-color: #0B0200;
      }
      .skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side{
        background-color: #CBCBCB;
      }
      .skin-blue .sidebar-menu>li>.treeview-menu{
        background:#2BA417;
      }
      .skin-blue .treeview-menu>li>a{
        color: white;
      }
      .skin-blue .main-header .navbar .sidebar-toggle{
        color: #0B0200;
      }
      .skin-blue .sidebar-form input[type="text"], .skin-blue .sidebar-form .btn{
        background-color: white;
      }
      .skin-blue .sidebar-menu>li.header{
        background-color: #CBCBCB;
        color: white;
      }
      .skin-blue .main-header .navbar .sidebar-toggle:hover{
        background-color: #9A9380;
      }
      .skin-blue .sidebar-form{
        border:none;
      }
      .content-wrapper, .right-side{
        background-color: white;
      }
      .none-padding{
        padding: 0!important;
      }
      .sidebar-menu .treeview-menu>li>a{
        padding: 15px 5px 15px 15px;
      }
      .sub-content-artikel .sub-content-artikel-header{
        height: auto;
        overflow: hidden;
      }
      .sub-content-artikel .sub-content-artikel-header .artikel-header{
        display: inline-block;
      }
      .sub-content-artikel .sub-content-artikel-header .artikel-header.artikel-right{
        margin-left: 150px;
      }
      .sub-content-artikel .sub-content-artikel-header .artikel-header.artikel-right .btn-create{
        background-color: #2BA417;
      }
      .sub-content-artikel .sub-content-artikel-header .artikel-header.artikel-left h4{
        font-weight: 600;
      }
      .sub-content-artikel .sub-content-artikel-body .artikel-body{
        display: inline-block;
      }
      .sub-content-artikel .sub-content-artikel-body .artikel-body-left i{
        font-size: 75px;
        color: #CBCBCB;
      }
      .sub-content-artikel .sub-content-artikel-body .artikel-body-right{
        float: left;
      }
      .sub-content-artikel .sub-content-artikel-body .artikel-body-icedit {
        float: left;
        padding: 20px 15px;
      }
      .sub-content-artikel .sub-content-artikel-body .artikel-body-icedit i{
        font-size: 25px;
        color: #2BA417;
      }
      .sub-content-artikel .sub-content-artikel-body .artikel-body-left {
        float: left;
      }
      .sub-content-artikel .sub-content-artikel-body .artikel-body-right {
        padding:0px 15px 0 20px;
        font-size: 14px;
        color: #CBCBCB;
      }
       .sub-content-artikel .sub-content-artikel-body{
        height: auto;
        overflow: hidden;
        margin-top: 15px;
       }
      .sub-content-artikel .sub-content-artikel-body .list-artikel{
        padding: 15px;
      }
      .sub-content-journal{
        height: auto;overflow: hidden;
        margin-bottom: 20px;
      }
         .sub-content-journal .sub-content-journal-header .journal-header{
        display: inline-block;
      }
      .sub-content-journal .sub-content-journal-header .journal-header.journal-right{
        margin-left: 150px;
      }
      .sub-content-journal .sub-content-journal-header .journal-header.journal-right .btn-create{
        background-color: #2BA417;
      }
      .sub-content-journal .sub-content-journal-header .journal-header.journal-left h4{
        font-weight: 600;
      }
      .sub-content-journal .sub-content-journal-header .list-journal{
        padding: 15px ;
      }
      .sub-content-journal .sub-content-journal-header .list-journal .item{
      
        /*background-color: green;*/
      }
      .sub-content-journal .sub-content-journal-header .list-journal .item .box-header{
          height: 150px;
          overflow: hidden;
      }
      .owl-theme .owl-dots{
        display: none;
      }
      .sub-content-journal .sub-content-journal-header .list-journal .item .title-jurnal{
        font-size: 14px;
        font-weight: 600;
        margin: 0;
      }
     /* .sub-content-journal .sub-content-journal-header .list-journal .owl-nav{
        position: absolute;
        right: -2em;
        top: 40%;
      }
      .sub-content-journal .sub-content-journal-header .list-journal .owl-nav .owl-next{
        font-size: 71px;
        font-weight: 600;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color:#CBCBCB; 
        margin-right: -0.7em;
        margin-top: -0.2em;
      }
      .sub-content-journal .sub-content-journal-header .list-journal .owl-nav .owl-next span{
        position: absolute;
        margin-top: -0.81em;
        margin-left: -9px;
      }
      .sub-content-journal .sub-content-journal-header .list-journal .owl-nav .owl-prev{
        display: none;
      }*/
      .txt-seemore{
            position: absolute;
              right: -4.5em;
              margin-top: -4em;
              font-size: 16px;
              font-weight: 600;
              color: #979797;
          }
          .sidebar ul li{
            padding: 0!important;
          }
              .new-input{
      background-color: #EEE8E8;
    }
    .btn-green{
      background-color: #269913;
    }
    .form-goup-file{
    height: auto;
    overflow: hidden;
    padding: 0;
  }
  .form-goup-file div{
    display: inline-block;
  }
  .form-goup-file .input-file-left{
    width: 100%;
  }
  .form-goup-file .input-file-left input{
  width: 100%;
  }
  .form-goup-file .input-file-right{
    position: absolute;
    left: 0;
    top: 0;
  }
  .form-goup-file .input-file-right .btn-choose-foto{
    height: 34px;
    width: 105px;
    border-radius: 0;
    padding-left: 7px;
  }
  .logo-fav{
    width: 100px;
  }
  .fa-upload{
    padding-right: 10px;
  }
  .box-content{
    background-color: transparent;
  }
  .panel .panel-header{
    border-bottom: solid 1px #A8A8A8;
    padding-left: 15px;
    
  }
  .table thead{
    background-color: #269913;
    color: white;
  }
  .table{
    margin-top: 15px;
  }
  .btn-bg{
    background-color: #2BA417!important;
    background: #2BA417!important;
  }
  .box-thumbnail{
    border:solid #CBCBCB 1px;
  }
       .sub-content-journal .sub-content-journal-header .list-journal .item{
      
        /*background-color: green;*/
      }
      .sub-content-journal .sub-content-journal-header .list-journal .item .box-header{
          height: 150px;
          overflow: hidden;
      }
      .owl-theme .owl-dots{
        display: none;
      }
      .sub-content-journal .sub-content-journal-header .list-journal .item .title-jurnal{
        font-size: 14px;
        font-weight: 600;
        margin: 0;
      }
      .sub-content-journal .sub-content-journal-header .list-journal .owl-nav{
      /*  position: absolute;
        right: -2em;
        top: 40%;*/
      }
    /*  .sub-content-journal .sub-content-journal-header .list-journal .owl-nav .owl-prev.disabled{
        display: none;
      }*/
      .sub-content-journal .sub-content-journal-header .list-journal .owl-nav .owl-next{
        font-size: 71px;
        font-weight: 600;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color:#CBCBCB; 
        /*margin-right: -0.7em;*/
        position: absolute;
        margin-top: -0.2em;
        right:-1em; 
        top: 47%;
      }
      .sub-content-journal .sub-content-journal-header .list-journal .owl-nav .owl-prev{
        font-size: 71px;
        font-weight: 600;
        left:-1em;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color:#CBCBCB; 
        /*margin-left: -0.7em;*/
        position: absolute;
        margin-top: -0.2em;
        top: 47%;
      }
      .sub-content-journal .sub-content-journal-header .list-journal .owl-nav .owl-next span{
        position: absolute;
        margin-top: -0.81em;
        margin-left: -9px;
      }
      .sub-content-journal .sub-content-journal-header .list-journal .owl-nav .owl-prev span{
        position: absolute;
        margin-top: -0.81em;
        left: 14px;
        margin-right: -12px;
      }
      .txt-seemore{
            position: absolute;
              right: 3.5em;
              margin-top: -4em;
              font-size: 16px;
              font-weight: 600;
              color: #979797;
          }
          .sub-content-journal .sub-content-journal-header .list-journal{
        padding: 15px 10em;
      }
      .sub-content-artikel .sub-content-artikel-body{
        padding: 15px 10em;
      }
form .box-body{
  padding-top: 0;
}


        @media(max-width:767px){
.sub-content-artikel .sub-content-artikel-body{
  padding: 0 15px;
}
.sub-content-journal .sub-content-journal-header .list-journal{
  padding: 15px;
}
.sub-content-journal .sub-content-journal-header .list-journal .owl-nav .owl-next{
  right: 0;
}
.sub-content-journal .sub-content-journal-header .list-journal .owl-nav .owl-prev{
  left: 0;
}
.txt-seemore{
  right: 30px;
  margin-top: -1.1em;
}
.sub-content-artikel .sub-content-artikel-body .artikel-body-left i{
  font-size: 55px;
}
.sub-content-artikel .sub-content-artikel-body .artikel-body-right{
  font-size: 12px;
}
.sub-content-artikel .sub-content-artikel-body .artikel-body-icedit{
  float: none;
  right: 0;
  position: absolute;
}
}
  </style>
  <script src="<?=base_url();?>assets/js/jquery-2.2.3.min.js"></script>
  <script src="<?=base_url();?>assets/js/jquery-ui.min.js"></script>
  <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
  <script type="text/javascript">var base_url = '<?=base_url();?>';</script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>ID</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs" style="color: black;">Admin <i class="fa fa-angle-down" aria-hidden="true"></i></span>
               <img src="<?=base_url();?>media/favicon.ico" class="user-image" alt="User Image">
            </a>
            <ul class="dropdown-menu" style="width: 100%!important;">
      
  

              <li class="user-footer" >
           
                <div class="pull-right" style="width: 100%;">
                  <a href="<?=site_url('journal/login/logout');?>" class="btn btn-success btn-flat btn-bg" style="width: 100%;">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <ul class="sidebar-menu">
        <!-- <li class="header">MAIN NAVIGATION</li> -->
        <li>
          <a href="<?=site_url('journal/admin/home');?>">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="<?=site_url('journal/admin/alljournal');?>">
            <i class="fa fa-copy"></i> <span>All Journal</span>
          </a>
        </li>
        <li class="<?php if(current_url() == site_url('journal/admin/volume') || current_url() == site_url('journal/admin/novolume')){ ?> active <?php } ?> treeview" style="margin-top: 5px;">
          <a href="#">
            <i class="fa fa-list"></i> <span>my Volume & Volume Number</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="<?=site_url('journal/admin/volume');?>"><i class="fa fa-circle-o"></i>Create  Volume </a></li>

            <li class=""><a href="<?=site_url('journal/admin/novolume');?>"><i class="fa fa-circle-o"></i>Create Volume Number</a></li>
          </ul>
        </li>
       <li class="<?php if(current_url() == site_url('journal/admin/dashboard')){ ?> active <?php } ?> treeview" style="margin-top: 5px;">
          <a href="#">
            <i class="fa fa-file-o"></i> <span>My Journal</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?=site_url('journal/admin/dashboard');?>"><i class="fa fa-circle-o"></i> Create & Edit Journal</a></li>

          </ul>
        </li>
        <li class=" treeview <?php if(current_url() == site_url('journal/admin/') || current_url() == site_url('journal/admin/accepted') || current_url() == site_url('journal/admin/rejected')){ ?>  active <?php } ?>">
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
        <li>
          <a href="<?=site_url('journal/admin/report_download');?>">
            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Report Download</span>
          </a>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="row">


          <ci:doc type="modules"/>


          
        </div>

      </section>
      </div><!-- /.content-wrapper -->

       <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2018 <a href="https://idren.id">IDren</a>.</strong>
  </footer>

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url().'assets/js/select2.min.js';?>"></script>
<script type="text/javascript">
  $('.select2').select2();
</script>


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


     
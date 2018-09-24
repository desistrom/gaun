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
            <a href="<?=site_url("login/logout");?>"><i class="fa fa-power-off"></i> LogOut</a>
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
        <li class=" treeview <?php if(current_url() == site_url('admin/home')){ ?> active <?php } ?>">
          <a href="<?=site_url('admin');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">

            </span>
          </a>

        </li>

        <!-- <li class=" treeview <?php if(current_url() == site_url('admin/about/contact')){ ?> active <?php } ?>">
          <a href="<?=site_url('admin/about/contact');?>">
            <i class="fa fa-newspaper-o"></i> <span>Contact Us</span>
            <span class="pull-right-container">

            </span>
          </a>
        </li> -->

        <!-- <li class="treeview <?php if(current_url() == site_url('admin/email/list-comment')){ ?> active <?php } ?>">
          <a href="<?=site_url('admin/email/list_comment');?>">
            <i class="fa fa-header"></i> <span>Comment</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li> -->

        <!-- <li class="treeview <?php if(current_url() == site_url('admin/logo/index')){ ?> active <?php } ?>">
          <a href="<?=site_url('admin/logo/index');?>">
            <i class="fa fa-globe"></i> <span>Logo Tab</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li> -->

        <li class="treeview <?php if(current_url() == site_url('admin/menu/index')){ ?> active <?php } ?>">
          <a href="<?=site_url('admin/menu/index');?>">
           <i class="fa fa-th"></i> <span>Menu</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>

        <li class="treeview <?php if(current_url() == site_url('admin/menu/page')){ ?> active <?php } ?>">
          <a href="<?=site_url('admin/menu/page');?>">
            <i class="fa fa-copy"></i><span>Page</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>

       

            
        <!-- <li class="treeview <?php if(current_url() == site_url('admin/home/logo')){ ?> active <?php } ?>">
          <a href="<?=site_url('admin/home/logo');?>">
            <i class="fa fa-flag"></i> <span>Logo Setting</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li> -->
        
       
    

        <li class=" treeview <?php if(current_url() == site_url('admin/home/testimoni') || current_url() == site_url('admin/home/hero') || current_url() == site_url('admin/home/Layanan_idroam') || current_url() == site_url('admin/home/Layanan_cloud') || current_url() == site_url('admin/home/kolaborasi') || current_url() == site_url('admin/about/slider') || current_url() == site_url('admin/home/pentahelix')){ ?>  active <?php } ?>">
          <a href="#">
            <i class="fa fa-home"></i>  <span>Home Page</span>
            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <li <?php if(current_url() == site_url('admin/home/hero')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/home/hero');?>"><i class="fa fa-video-camera"></i>Hero</a></li>
            <li <?php if(current_url() == site_url('admin/about/slider')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/about/slider');?>"><i class="glyphicon glyphicon-education"></i>Akademisi</a></li>
            <li <?php if(current_url() == site_url('admin/home/testimoni')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/home/testimoni');?>"><i class="fa fa-comment"></i>Testimony</a></li>
            <!-- <li <?php if(current_url() == site_url('admin/home/pentahelix')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/home/pentahelix');?>"><i class="fa fa-building"></i>pentahelix</a></li> -->
          <!--   <li <?php if(current_url() == site_url('admin/home/Layanan_idroam')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/home/Layanan_idroam');?>"><i class="fa fa-bullhorn"></i>Layanan ID Roam</a></li>
            <li <?php if(current_url() == site_url('admin/home/Layanan_cloud')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/home/Layanan_cloud');?>"><i class="fa fa-bullhorn"></i>Layanan Cloud Federation</a></li> -->
            <li <?php if(current_url() == site_url('admin/home/kolaborasi')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/home/kolaborasi');?>"><i class="fa fa-bullhorn"></i>Kolaborasi</a></li>
          </ul>
        </li>
         <li class="treeview <?php if(current_url() == site_url('admin/keanggotaan/kategori_instansi')){ ?> active <?php } ?>">
          <a href="<?=site_url('admin/keanggotaan/kategori_instansi');?>">
            <i class="fa fa-building"></i> <span>Pentahelix</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>

        <!-- <li class=" treeview <?php if(current_url() == site_url('admin/layanan/index') || current_url() == site_url('admin/layanan/id_journal') || current_url() == site_url('admin/layanan/id_tube') || current_url() == site_url('admin/layanan/id_mail') || current_url() == site_url('admin/layanan/id_research') || current_url() == site_url('admin/layanan/id_links') || current_url() == site_url('admin/layanan/id_rank')){ ?>  active <?php } ?>">
          <a href="#">
            <i class="fa fa-bullhorn"></i>  <span>Layanan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if(current_url() == site_url('admin/layanan/index')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/layanan/index');?>"><i class="fa fa-picture-o"></i> ID-BOOK</a></li>
            <li <?php if(current_url() == site_url('admin/layanan/id_journal')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/layanan/id_journal');?>"><i class="fa fa-comment"></i> ID-JOURNAL </a></li>
            <li <?php if(current_url() == site_url('admin/layanan/id_tube')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/layanan/id_tube');?>"><i class="fa fa-bullhorn"></i>ID-TUBE</a></li>
            <li <?php if(current_url() == site_url('admin/layanan/id_mail')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/layanan/id_mail');?>"><i class="fa fa-bullhorn"></i>ID-Mail</a></li>
            <li <?php if(current_url() == site_url('admin/layanan/id_research')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/layanan/id_research');?>"><i class="fa fa-bullhorn"></i>ID-Research</a></li>
            <li <?php if(current_url() == site_url('admin/layanan/id_links')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/layanan/id_links');?>"><i class="fa fa-bullhorn"></i>ID-Links</a></li>
            <li <?php if(current_url() == site_url('admin/layanan/id_rank')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/layanan/id_rank');?>"><i class="fa fa-bullhorn"></i>ID-Rank</a></li>
          </ul>
        </li> -->

        <li class=" treeview <?php if(current_url() == site_url('admin/home/topologi') || current_url() == site_url('admin/home/topologi') || current_url() == site_url('admin/layanan/monitoring_graph')){ ?>  active <?php } ?>">
          <a href="#">
            <i class="fa fa-link"></i>  <span>Konektivitas</span>
            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if(current_url() == site_url('admin/home/topologi')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/home/topologi');?>"><i class="material-icons">art_track</i> Topologi</a></li>
            <li <?php if(current_url() == site_url('admin/layanan/monitoring_graph')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/layanan/monitoring_graph');?>"><i class="material-icons">computer</i> Monitoring Graph </a></li>
          </ul>
        </li>

        <li class=" treeview <?php if(current_url() == site_url('admin/pengguna/list_dosen') || current_url() == site_url('admin/pengguna/list_mahasiswa')){ ?>  active <?php } ?>">
          <a href="#">
            <i class="fa fa-user"></i>  <span>Civitas</span>
            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if(current_url() == site_url('admin/pengguna/list_dosen')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/pengguna/list_dosen');?>"><i class="material-icons">group_add</i> Dosen</a></li>
            <li <?php if(current_url() == site_url('admin/pengguna/list_mahasiswa')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/pengguna/list_mahasiswa');?>"><i class="material-icons">group_add</i> Mahasiswa </a></li>
          </ul>
        </li>

        <li class=" treeview <?php if(current_url() == site_url('admin/pengguna') || current_url() == site_url('admin/pengguna/mahasiswa')){ ?>  active <?php } ?>">
          <a href="#">
            <i class="fa fa-link"></i>  <span>Request Akun</span>
            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if(current_url() == site_url('admin/pengguna')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/pengguna');?>"><i class="material-icons">group_add</i> Dosen</a></li>
            <li <?php if(current_url() == site_url('admin/pengguna/mahasiswa')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/pengguna/mahasiswa');?>"><i class="material-icons">group_add</i> Mahasiswa </a></li>
          </ul>
        </li>

        <li class=" treeview <?php if(current_url() == site_url('admin/keanggotaan/setting') || current_url() == site_url('admin/keanggotaan/index') || current_url() == site_url('admin/keanggotaan/instansi') || current_url() == site_url('admin/keanggotaan/setting_reg') || current_url() == site_url('admin/keanggotaan/index') || current_url() == site_url('admin/keanggotaan/instansi') || current_url() == site_url('admin/keanggotaan/instansi_request')){ ?> active <?php } ?>">
          <a href="#">
            <i class="fa fa-users"></i>  <span>Keanggotaan</span>
            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li <?php if(current_url() == site_url('admin/keanggotaan/index')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/keanggotaan/index');?>"><i class="fa fa-users"></i> List Anggota</a></li> -->
            <li <?php if(current_url() == site_url('admin/keanggotaan/instansi_request')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/keanggotaan/instansi_request');?>"><i class="material-icons">group_add</i> Request Joined Instansi</a></li>
            <li <?php if(current_url() == site_url('admin/keanggotaan/instansi')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/keanggotaan/instansi');?>"><i class="material-icons">group </i>  Joined Instansi</a></li>
            <!-- <li <?php if(current_url() == site_url('admin/keanggotaan/kategori_instansi')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/keanggotaan/kategori_instansi');?>"><i class="fa fa-black-tie"></i>Jenis Instansi</a></li> -->
            <li <?php if(current_url() == site_url('admin/keanggotaan/setting')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/keanggotaan/setting');?>"><i class="material-icons">rss_feed</i> Benefit</a></li>
            <li <?php if(current_url() == site_url('admin/keanggotaan/setting_reg')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/keanggotaan/setting_reg');?>"><i class="material-icons">assignment</i> Registrasi</a></li>
          </ul>
        </li>

        <li class=" treeview <?php if(current_url() == site_url('admin/galery/list_image') || current_url() == site_url('admin/galery/list_video') || current_url() == site_url('admin/galery/album')){ ?> active <?php } ?>">
          <a href="#">
            <i class="fa fa-picture-o"></i> <span>Gallery</span>
            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if(current_url() == site_url('admin/galery/album')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/galery/album');?>"><i class="material-icons">collections</i>Photo Album</a></li>
            <li <?php if(current_url() == site_url('admin/galery/list_image')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/galery/list_image');?>"><i class="fa fa-picture-o"></i> Photo</a></li>
            <li <?php if(current_url() == site_url('admin/galery/list_video')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/galery/list_video');?>"><i class="fa fa-film"></i></i>Video</a></li>
          </ul>
        </li>

        <li class=" treeview <?php if(current_url() == site_url('admin/news') || current_url() == site_url('admin/kategori_news')){ ?>  active <?php } ?>">
          <a href="#">
            <i class="fa fa-newspaper-o"></i>  <span>Berita</span>
            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if(current_url() == site_url('admin/kategori_news')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/kategori_news');?>"><i class="material-icons">featured_play_list</i> Kategori Berita </a></li>
            <li <?php if(current_url() == site_url('admin/news')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/news');?>"><i class="material-icons">chrome_reader_mode</i> List Berita</a></li>
            <li <?php if(current_url() == site_url('admin/news/instansi')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/news/instansi');?>"><i class="material-icons">chrome_reader_mode</i> List Berita Instansi</a></li>
          </ul>
        </li>

        <!-- <li class=" treeview <?php if(current_url() == site_url('admin/news')){ ?> active <?php } ?>">
          <a href="<?=site_url('admin/news');?>">
            <i class="fa fa-newspaper-o"></i> <span>Berita</span>
            <span class="pull-right-container">

            </span>
          </a>
        </li>

        <li class=" treeview <?php if(current_url() == site_url('admin/kategori_news')){ ?> active <?php } ?>">
          <a href="<?=site_url('admin/kategori_news');?>">
            <i class="fa fa-newspaper-o"></i> <span>Kategori Berita</span>
            <span class="pull-right-container">

            </span>
          </a>
        </li> -->

        <li class="treeview <?php if(current_url() == site_url('admin/about')){ ?> active <?php } ?>">
          <a href="<?=site_url('admin/about');?>">
            <i class="fa fa-info"></i> <span>Tentang</span>
            <span class="pull-right-container">

            </span>
          </a>
        </li>

         <li class=" treeview <?php if(current_url() == site_url('admin/home/logo') || current_url() == site_url('admin/logo/index') || current_url() == site_url('admin/logo/title')){ ?>  active <?php } ?>">
          <a href="#">
            <i class="fa fa-header"></i><span>Header Setting</span>
            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if(current_url() == site_url('admin/home/logo')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/home/logo');?>"><i class="fa fa-picture-o"></i> Logo Website</a></li>
            <li <?php if(current_url() == site_url('admin/logo/index')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/logo/index');?>"><i class="material-icons">picture_in_picture</i> Logo Tab  </a></li>
            <li <?php if(current_url() == site_url('admin/logo/title')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/logo/title');?>"><i class="material-icons">title</i> Title Website </a></li>
          </ul>
        </li>
            <li class=" treeview <?php if(current_url() == site_url('admin/email/index') || current_url() == site_url('admin/email/template') || current_url() == site_url('admin/email/kategori') || current_url() == site_url('admin/email/setting_email')){ ?>  active <?php } ?>">
          <a href="#">
            <i class="fa fa-envelope"></i>  <span>Email</span>
            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li <?php if(current_url() == site_url('admin/email/index')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/email/index');?>"><i class="fa fa-clone"></i> List Email</a></li> -->
            <li <?php if(current_url() == site_url('admin/email/template')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/email/template');?>"><i class="fa fa-columns"></i>Template</a></li>
            <li <?php if(current_url() == site_url('admin/email/kategori')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/email/kategori');?>"><i class="glyphicon glyphicon-envelope"></i>kategori Email</a></li>
            <li <?php if(current_url() == site_url('admin/email/setting_email')){ ?> class="active" <?php } ?>><a href="<?=site_url('admin/email/setting_email');?>"><i class="glyphicon glyphicon-cog"></i>Setting Email</a></li>
          </ul>
        </li>
        <li class=" treeview <?php if(current_url() == site_url('admin/about/footer')){ ?> active <?php } ?>">
          <a href="<?=site_url('admin/about/footer');?>">
            <i class="glyphicon glyphicon-option-horizontal"></i><span>Footer Setting</span>
            <span class="pull-right-container">

            </span>
          </a>
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
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
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


     
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <link rel="shortcut icon" href="<?=base_url();?>media/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url();?>assets/user/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/user/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/user/css/Navbar-with-mega-menu.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/user/css/gallery-3-columns-minimal.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/user/bootstrap/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/user/css/css.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/user/css/admin-user.css">
    <style type="text/css">
    .nav li.dropdown .link_dropdown{
      border:none;
      color: white;
    }
     .nav li.dropdown.active .link_dropdown{
      border-bottom:solid 3px white;
    }
    .sub-drop-menu{
            line-height: 50px;
   list-style: none;
    text-decoration: none;
      }
      .li-submenu.li-not-open .sub-drop-menu{
        display: none;
        transition: 0.5s;
      }
 /*     .modal-backdrop.in{
    position: relative!important;
  }
  .modal-content{
    margin-top: 6em;
  }*/.nav li.dropdown .link_dropdown {
    border: none;
    color: white;
    margin-bottom: 0;
}
.nav li.dropdown .link_dropdown{
  padding-bottom: 0.8em;
    padding-top: 1.5em;
    margin-left: 0;
    margin-right: 0;
}
.dropdown{
  margin-right: 2em!important;
}
ul.drop-menu.drop_2{
  padding-top: 3em;
}
.btn-add-menu{
  position: absolute!important;
  margin-top: -3em!important;
  width: 50%;
  left: 15px;
  border-radius: 20px;
  box-shadow: 1px 1px 2px 0 #A8A8A8;
}
.sub-menu-add{
       box-shadow: 3px 3px 9px 0 #A8A8A8;
    position: absolute;
    right: -14em;
    background-color: white;
    padding-left: 0;
    width: 13em;
    padding-left: 18px;
    top: 0;
    border-radius: 10px;

}
.btn-add-menu:active,.btn-add-menu:focus,.btn-add-menu:active:focus{
       box-shadow: none;


}
.btn-add-menu:hover{
 box-shadow: 2px 2px 2px 0 #A8A8A8;
 }
ul.drop-menu.drop_2 li.btn-add-menu {
   border:solid #F2F2F2 1px;
}
ul.drop-menu.drop_2 li.btn-add-menu:hover {
   border:solid #F2F2F2 1px;
}

ul.drop-menu.drop_2 li.btn-add-menu  a{
  padding-left: 28px;
  line-height: 39px;
}
ul.drop-menu.drop_2 li.btn-add-menu  a:hover {
    color: #E72A2A;
    border-right: none;
   
    background-color: transparent;
  }
    </style>
    <script type="text/javascript">
      var base_url = '<?=base_url()?>';
    </script>
    <script src="<?=base_url();?>assets/user/js/jquery.min.js"></script>
    <script src="<?=base_url();?>assets/user/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
           <nav class="navbar navbar-fixed-top " id="main-navigation">
      <div class="">
            <div class="container-fluid">
              <div class="navbar-header"><a href="index.html" class="navbar-brand navbar-link"><img class="logo" src="<?=base_url();?>assets/user/img/logo_idren_white.png" /> </a>
                  <button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
              </div>
              <div class="collapse navbar-collapse" id="navcol-1">

                  <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown <?php if(current_url() == site_url('user/dashboard') || current_url() == site_url('user/dashboard/profil') || current_url() == site_url('user/dashboard/change_password')){ ?>active <?php }else{ ?>not-active <?php } ?>"><a class="link_dropdown"  href="<?=site_url('user/dashboard');?>" class="dropdown-toggle">Home </a>
                          <ul class="drop-menu <?php if(current_url() == site_url('user/dashboard') || current_url() == site_url('user/dashboard/profil') || current_url() == site_url('user/dashboard/change_password')){ ?> open active <?php }else{ ?> not-active <?php } ?> col col-md-2" role="menu">
                              <li><a href="<?=site_url('user/dashboard');?>"> <i class="fa fa-home"></i>Dashboard</a></li>
                              <li><a href="<?=site_url('user/dashboard/profil');?>"> <i class="fa fa-user"></i>Profil</a></li>
                              <li><a href="<?=site_url('user/dashboard/change_password');?>"> <i class="fa fa-gear"></i>change password</a></li>

                          </ul>
                        </li>
                        <?php $url = $this->uri->segment_array();  ?>
                      <li class="dropdown <?php if($url[2] == 'journal' || current_url() == site_url('user/journal') || current_url() == site_url('user/journal/artikel') || current_url() == site_url('user/journal/volume') || current_url() == site_url('user/journal/list_nomor') || current_url() == site_url('user/journal/list_artikel') || current_url() == site_url('user/journal/add_artikel') || current_url() == site_url('user/journal/add_no_volume') || current_url() == site_url('user/journal/add_volume') || current_url() == site_url('user/journal/add') || current_url() == site_url('user/journal/list_artikel_rejected') || current_url() == site_url('user/journal/list_artikel_accepted') || current_url() == site_url('user/journal/list_download') || current_url() == site_url('user/journal/all_journal')){ ?>active <?php }else{ ?>not-active <?php } ?>"><a class="link_dropdown"  href="<?=site_url('user/journal');?>" class="dropdown-toggle">Journal </a>
                          <ul class="drop-menu  drop_2 <?php if($url[2] == 'journal' || current_url() == site_url('user/journal') || current_url() == site_url('user/journal/artikel') || current_url() == site_url('user/journal/volume') || current_url() == site_url('user/journal/list_nomor') || current_url() == site_url('user/journal/list_artikel') || current_url() == site_url('user/journal/add_artikel') || current_url() == site_url('user/journal/add_no_volume') || current_url() == site_url('user/journal/add_volume') || current_url() == site_url('user/journal/add') || current_url() == site_url('user/journal/list_artikel_rejected') || current_url() == site_url('user/journal/list_artikel_accepted') || current_url() == site_url('user/journal/list_download')|| current_url() == site_url('user/journal/all_journal')){ ?>open active <?php }else{ ?>not-active<?php } ?> col col-md-2" role="menu">
                          <?php if(!is_null($this->general->status())){ ?>
                             <li class="li-submenu li-not-open btn-add-menu"><a href="#"> <i class="fa fa-plus"></i>Add</a>
                                <ul class="sub-drop-menu active sub-menu-add" >
                                    <li><a href="<?=site_url('user/journal/add');?>">
                                        Add Journal
                                    </a>
                                  </li>
                                    <li><a href="<?=site_url('user/journal/add_volume');?>">
                                       
                                        Add volume
                                    </a></li>
                                    <li><a href="<?=site_url('user/journal/add_no_volume');?>">
                                       
                                        Add No Volume
                                    </a></li>

                                    <li><a href="<?=site_url('user/journal/add_artikel');?>">
                                       
                                        Add Artikel
                                    </a></li>

                                </ul>
                              </li>
                            <?php } ?>
                            <li><a href="<?=site_url('user/journal/all_journal');?>" <?php if(current_url() == site_url('user/journal/all_journal')){ ?> class="active" <?php } ?> > <i class="fa fa-home"></i>All Journal</a></li>

                              <li><a href="<?=site_url('user/journal');?>" <?php if(current_url() == site_url('user/journal') || current_url() == site_url('user/journal/add')){ ?> class="active" <?php } ?> > <i class="fa fa-book"></i>my Journal</a></li>
                              <?php if(!is_null($this->general->status())){ ?>
                              <li><a href="<?=site_url('user/journal/volume');?>" <?php if(current_url() == site_url('user/journal/volume') || current_url() == site_url('user/journal/add_volume')){ ?> class="active" <?php } ?>> <i class="fa fa-user"></i>Volume</a></li>
                              
                              <li><a href="<?=site_url('user/journal/list_nomor');?>" <?php if(current_url() == site_url('user/journal/list_nomor') || current_url() == site_url('user/journal/add_no_volume')){ ?> class="active" <?php } ?>> <i class="fa fa-list"></i>No Volume</a></li>
                              <li class="li-submenu <?php if(current_url() == site_url('user/journal/list_artikel') || current_url() == site_url('user/journal/add_artikel') || current_url() == site_url('user/journal/list_artikel_rejected') || current_url() == site_url('user/journal/list_artikel_accepted') || current_url() == site_url('user/journal/list_download')){ ?> active <?php }else{ ?> li-not-open<?php } ?>" ><a href="#" <?php if(current_url() == site_url('user/journal/list_artikel') || current_url() == site_url('user/journal/add_artikel') || current_url() == site_url('user/journal/list_artikel_rejected') || current_url() == site_url('user/journal/list_artikel_accepted') || current_url() == site_url('user/journal/list_download')){ ?> class="active" <?php } ?>> <i class="fa fa-gear"></i>Artikel</a>
                                <ul class="sub-drop-menu active" >
                                    <li><a <?php if(current_url() == site_url('user/journal/list_artikel') ){ ?> class="active"<?php } ?> href="<?=site_url('user/journal/list_artikel');?>">
                                        List Artikel
                                    </a>
                                  </li>
                                    <li><a <?php if(current_url() == site_url('user/journal/list_artikel_accepted') ){ ?> class="active"<?php } ?> href="<?=site_url('user/journal/list_artikel_accepted');?>">
                                       
                                        Accepted
                                    </a></li>
                                    <li><a <?php if(current_url() == site_url('user/journal/list_artikel_rejected') ){ ?> class="active"<?php } ?> href="<?=site_url('user/journal/list_artikel_rejected');?>">
                                       
                                        Rejected
                                    </a></li>

                                    <li><a <?php if(current_url() == site_url('user/journal/list_download') ){ ?> class="active"<?php } ?> href="<?=site_url('user/journal/list_download');?>">
                                       
                                      Artikel terdownload
                                    </a></li>

                                </ul>
                              </li>
                              <?php } ?>
                          </ul>
                      </li>
                    
                   <!--  <li class="dropdown not-active"><a class="link_dropdown"  href="datatable.html" class="dropdown-toggle">tables </a>
                          <ul class="drop-menu sub-menu not-active  col col-md-2" >
                              <li><a href="datatable.html">Data tables</a></li>
                              <li><a href="#">submenu 2</a></li>

                          </ul>
                        </li>
                        <li class="dropdown not-active"><a class="link_dropdown" data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle">Menu 3 </a>
                          <ul class="drop-menu sub-menu not-active  col col-md-2" >
                              <li><a href="#">submenu 3</a></li>
                              <li><a href="#">submenu 3</a></li>

                          </ul>
                        </li>
                        <li class="dropdown not-active"><a class="link_dropdown" data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle">Menu 4 </a>
                          <ul class="drop-menu sub-menu not-active  col col-md-2" >
                              <li><a href="#">submenu 4</a></li>
                              <li><a href="#">submenu 4</a></li>

                          </ul>
                        </li> -->
                        

                  </ul>
                  <ul class="nav navbar-nav navbar-right navbar-log">
                    <li><a href="#" class="logout">User</a></li>
                    <li><a href="<?=site_url('user/login_user/logout');?>" class="logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                  </ul>
              </div>
          </div>
      </div>
  </nav>
  <div class="container-fluid as-content">
      <div class="row">
          <div class="col col-md-2 col-sm-2 col-xs-12 left-content">
              
          </div>


 <ci:doc type="modules"/>

    </div>
      </div>
  </div>

     <div class="container-fluid footer-bottom">
        <div class="row">
            <div class=" col col-md-2 col-sm-2 col-xs-12 myjurnal"></div>
            <div class="col-md-10 col-sm-10 col-xs-12 text-left">
                <ul class="list-inline">
                    <li><a href="#"><i class="fa fa-copyright"></i>IDren 2018</a></li>
                    
                </ul>
            </div>
        </div>
    </div>
    <!-- <script src="<?=base_url();?>assets/user/js/jquery.min.js"></script>
    <script src="<?=base_url();?>assets/user/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="<?=base_url();?>assets/user/bootstrap/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/user/bootstrap/datatables/dataTables.bootstrap.min.js"></script>
     <script src="<?=base_url();?>assets/user/js/script.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".dropdown").click(function(){

                // console.log($(this).find(".drop-menu"));
                if ($(".drop-menu").hasClass("not-active")) {
                    $(".drop-menu").removeClass("active").addClass("not-active");
                    $(this).find(".drop-menu").addClass("active").removeClass("not-active"); 

                }
            });
              $(".li-submenu").click(function(){

                // console.log("a");
                if ($(this).hasClass("li-not-open")) {
                    $(this).removeClass("li-not-open").addClass("active");
                   

                }else{
                  $(this).removeClass("active").addClass("li-not-open");
                }
            });
            $(".dropdown").click(function(){
                // console.log($(this).find(".drop-menu"));
                if ($(".dropdown").hasClass("not-active")) {
                    $(".dropdown").removeClass("active").addClass("not-active");
                    $(this).addClass("active").removeClass("not-active"); 
                }
            });
        } );
    </script>
    <script type="text/javascript">
      
    </script>
</body>

</html>   
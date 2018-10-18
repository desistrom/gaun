<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal IDREN</title>
     <link rel="shortcut icon" href="<?=base_url();?>media/favicon.ico">
    <link rel="stylesheet" href="<?=base_url();?>mockup_statis/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>mockup_statis/assets/fonts/font-awesome.min.css">
     <link rel="stylesheet" href="<?=base_url();?>mockup_statis/assets/css/Navbar-with-mega-menu.css">
    <link rel="stylesheet" href="<?=base_url();?>mockup_statis/assets/css/styles.css">
    <style type="text/css">
		   .navbar-nav > li > .dropdown-menu {
		    right: 0!important;
		}
		.cover-jurnal-img{
			width: 100%;
		}
    .list-info-jurnal{
    	margin-bottom: 2em;
    }
    .content-wrap {
	  
	    margin-top: 0;

	}
	.nav li a.btn-gabung{
    background-color: #D10909;
   

    color: white;
	}
	.nav li a.btn-gabung:hover{
		 box-shadow: 3px 3px 1px 0 #bdbdbd;
	}
</style>
<script type="text/javascript">
	var base_url = '<?=base_url();?>';
</script>
</head>

<body>
	<div class="col col-md-12 col-sm-12 col-xs-12 none-padding filter-wraper">
		<div class="wraper_journal col col-md-12 col-sm-12 col-xs-12">
		<header class="col col-md-12 col-sm-12 col-xs-12 none-padding ">
		
		 <nav class="navbar  " id="main-navigation">
            <div class="container-fluid">
              <div class="navbar-header"><a href="<?=site_url('journal');?>" class="navbar-brand navbar-link"><img class="logo img-responsive" src="<?=base_url();?>mockup_statis/assets/img/logo.png" /> </a>
                  <button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
              </div>
              <div class="collapse navbar-collapse" id="navcol-1">

                  <ul class="nav navbar-nav navbar-right">
                      <li role="presentation" class="active"><a href="<?=site_url('journal');?>"> <i class="fa fa-home"></i> Home</a></li>
                      <li class="dropdown"><a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle"><span class="fa fa-list-ul"></span> Kategori <span class="fa fa-angle-down"></span></a>
                          <ul class="dropdown-menu" role="menu">
                          <?php foreach ($this->general->kategori() as $key => $value): ?>
                              <li><a href="<?=site_url('journal/kategori/'.$value['nama']);?>"><?=$value['nama'];?></a></li>
                          	
                          <?php endforeach ?>
                             

                          </ul>
                        </li>
                        <li class="dropdown  sub-btn-gabung"><a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle active btn-gabung">Login <span class="fa fa-angle-down"></span></a>
                          <ul class="dropdown-menu" role="menu">
                              <li><a href="#" class="journal_log" id="1">Dosen</a></li>
                              <li><a href="#" class="journal_log" id="2">Mahasiswa</a></li>

                          </ul>
                        </li>
                     <!-- <li class="dropdown open"><a data-toggle="dropdown" aria-expanded="true" href="#" class="dropdown-toggle"><span class="fa fa-list-ul"></span> Kategori </a>
		                 <ul class="dropdown-menu">
		                 	<li></li>
		                 	<li><a href="#">kesehatan</a></li>
		                 	
		                 </ul>
		             </li> -->
                     <!--  <li role="presentation" class=""><a href="#"> <i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>

                      <li role="presentation" class="active"><a href="#"> <i class="fa fa-search"></i> Search</a></li>
                       -->

                  </ul>
              </div>
          </div>
  		</nav>
		</header>
		<?php if(!isset($captcha)){?>
			<section class="catalog col-md-12 col-sm-12 col-xs-12 ">
				<div class="container-fluid">
					<div class="row">
						<!-- <div class="col col-md-3 col-sm-2 col-xs-12 left-cat">
							Catalog :
						</div> -->
						<div class="col col-md-12 col-sm-12 col-xs-12 right-cat">
							<ul class="filter-catalog">
							<?php foreach (range('a', 'z') as $char) {
								echo '<li><a href="'.site_url("journal/katalog/".$char).'"> '.strtoupper($char).' </a></li>';
							} ?>
							</ul>
						</div>
					</div>
				</div>
			</section>	
		<section class="filter-page col-md-12 col-sm-12 col-xs-12 none-padding section-title-page">
			<div class="container-fluid">
				<div class="row">
					<div class="col col-md-12 col-sm-12 col-xs-12 left-title text-center">
						<h4>E - Jurnal IDREN</h4>
					</div>
					<div class="col col-md-12 col-sm-12 col-xs-12 right-title text-center">
						<div class="form-group">
			                <!-- <form method="#" action="#"> -->
			                    <div class="input-search input-search-left"><input type="text" class="form-control" name="search" id="search" placeholder="Cari"></div>
			                    <div class="input-search input-search-right"><button type="button" class="btn btn-danger btn-search"><i class="fa fa-search"></i> Search</button></div>
			                <!-- </form> -->
			              </div>
					</div>
				</div>
				
			</div>
		</section>
	<?php } ?>
		<section class="content-page col-md-12 col-sm-12 col-xs-12 none-padding">
			<div class="container-fluid">
				

					<div class="row">
						<ci:doc type="modules"/>
						
						
						<!-- <div class="col col-md-3 col-sm-4 col-xs-12 filter-box-jurnal" >
							<div class="box-jurnal" >
								<div class="box-header">
									<img class="img-responsive thumbnail-jurnal" src="assets/img/jur-1.jpg">
								</div>
								<div class="box-body">
									<h5>Jurnal Psikologi Pendidikan dan Perkembangan</h5>
									<h5>Vol : 5 - No: 1</h5>
									<h5>2016 - 12</h5>
								</div>
							</div>
						</div>
						<div class="col col-md-3 col-sm-4 col-xs-12 filter-box-jurnal" >
							<div class="box-jurnal" >
								<div class="box-header">
									<img class="img-responsive thumbnail-jurnal" src="assets/img/jur-1.jpg">
								</div>
								<div class="box-body">
									<h5>Jurnal Psikologi Pendidikan dan Perkembangan</h5>
									<h5>Vol : 5 - No: 1</h5>
									<h5>2016 - 12</h5>
								</div>
							</div>
						</div>
						<div class="col col-md-3 col-sm-4 col-xs-12 filter-box-jurnal" >
							<div class="box-jurnal" >
								<div class="box-header">
									<img class="img-responsive thumbnail-jurnal" src="assets/img/jur-1.jpg">
								</div>
								<div class="box-body">
									<h5>Jurnal Psikologi Pendidikan dan Perkembangan</h5>
									<h5>Vol : 5 - No: 1</h5>
									<h5>2016 - 12</h5>
								</div>
							</div>
						</div>
						<div class="col col-md-3 col-sm-4 col-xs-12 filter-box-jurnal" >
							<div class="box-jurnal" >
								<div class="box-header">
									<img class="img-responsive thumbnail-jurnal" src="assets/img/jur-1.jpg">
								</div>
								<div class="box-body">
									<h5>Jurnal Psikologi Pendidikan dan Perkembangan</h5>
									<h5>Vol : 5 - No: 1</h5>
									<h5>2016 - 12</h5>
								</div>
							</div>
						</div> -->
						

						<!-- <div class="col col-md-2" >
							<div class="box-jurnal" style="height: 100px;background-color: green;"></div>
						</div>
						<div class="col col-md-2" >
							<div class="box-jurnal" style="height: 100px;background-color: green;"></div>
						</div>
						<div class="col col-md-2" >
							<div class="box-jurnal" style="height: 100px;background-color: green;"></div>
						</div>
						<div class="col col-md-2" >
							<div class="box-jurnal" style="height: 100px;background-color: green;"></div>
						</div>
						<div class="col col-md-2" >
							<div class="box-jurnal" style="height: 100px;background-color: green;"></div>
						</div> -->
					</div>

			</div>
		</section>
	</div>
		<section class="col col-md-12 col-sm-12 col-xs-12 none-padding footer">
			<div class="container-fluid">
				<div class="row">
					<div class="col col-md-3 col-sm-6 col-xs-12 sub-footer">
						<h4 class="title-footer">Didukung oleh</h4>
                    <ul class="list-inline">
                        <li><img src="<?=base_url();?>assets/images/logo/logo-ristek.png" class="logo-sponsor logo2" alt="logo sponsor"></li>
                        <li><img src="<?=base_url();?>assets/images/logo/logo-telkom.png" class="logo-sponsor" alt="logo sponsor"></li>
                    </ul>
					</div>
					<div class="col col-md-6 col-sm-6 col-xs-12 sub-footer text-center">
						<h4>Kantor Pusat</h4>
						<div style="height: auto;overflow: hidden;"><div class="line-head"></div></div>
						<div class="col col-md-6 col-sm-6 col-xs-12">
							Kemenristekdikti Gedung D Lt 7, Jl. Jenderal Sudirman, Pintu I Senayan, Jakarta  Telp: 021-57946073
						</div>
						<div class="col col-md-6 col-sm-6 col-xs-12">
							Menara Multimedia Telkom 13th Jl. Kebon Sirih 10-12  Jakarta Telp. 021-3866006 ext. 1310
						</div>
					</div>
					<div class="col col-md-3 col-sm-6 col-xs-12 sub-footer">
						<h4>Statistic</h4>
						<div class="line-head"></div>
						<!-- <div class="col col-12 col-sm-12 col-xs-12"> -->
							<!-- Histats.com  START (html only)-->
								<!-- Histats.com  START (html only)-->
  				 <!-- Histats.com  (div with counter) --><div id="histats_counter"></div>
						<!-- </div> -->
					</div>
				</div>

			</div>
		</section>
		<section class="copyright col col-md-12 col-sm-12 col-xs-12 none-padding">
			<div class="container-fluid">
				<div class="row">
					<div class="col col-md-12 col-sm-12 col-xs-12">
						
						<h5><i class="fa fa-copyright"></i>  IDren 2018</h5>
					</div>
				</div>
			</div>
		</section>
	</div>
    <script src="<?=base_url();?>mockup_statis/assets/js/jquery.min.js"></script>
    <script src="<?=base_url();?>mockup_statis/assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function() {
    		$('body').on('click','.btn-search',function(){
    			search();    			
    		});
    		$('body').on('keypress','#search',function(e) {
			    if(e.which == 13) {
			        search(); 
			    }
			});

    		function search(){
    			var search = $('#search').val();
    			window.location.href = base_url+'journal/search/'+search;
    		}

    		$('body').on('click','.journal_log', function(){
    			var id = $(this).attr('id');
    			window.location.href = base_url+'journal/logins/'+id;
    		});
    	});
    </script>
    <!-- Histats.com  START  (aync)-->
<script type="text/javascript">var _Hasync= _Hasync|| [];
_Hasync.push(['Histats.start', '1,4162846,4,306,118,60,00011001']);
_Hasync.push(['Histats.fasi', '1']);
_Hasync.push(['Histats.track_hits', '']);
(function() {
var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
hs.src = ('//s10.histats.com/js15_as.js');
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
})();</script>
<noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?4162846&101" alt="free geoip" border="0"></a></noscript>
<!-- Histats.com  END  -->
</body>

</html>
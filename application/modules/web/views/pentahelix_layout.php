<!--      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
   <link href="https://fonts.googleapis.com/css?family=Nunito|Nunito+Sans:300,600,700" rel="stylesheet">
    <style type="text/css">
        .img-news img{
            width: 100%;
            
        }
        .detail_layanan{
            margin-top: 6em;
            background-color: #F2F2F2;
        }
       
                   .panel-heading .accordion-toggle:after {
            /* symbol for "opening" panels */
            font-family: 'Glyphicons Halflings';  /* essential for enabling glyphicon */
            content: "\e114";    /* adjust as needed, taken from bootstrap.css */
            float: right;        /* adjust as needed */
            color: #CF090A;         /* adjust as needed */
            font-size: 24px;
        }
        .panel-heading .accordion-toggle.collapsed:after {
            /* symbol for "collapsed" panels */
            content: "\e080";    /* adjust as needed, taken from bootstrap.css */
        }
        .fa-circle{
            margin-right: 15px;
            font-size: 12px;
            margin-left: 5px;
        }
  .title-page-news{
        	padding-bottom: 2em;
        }
        div.container-fluid.content-pentahelix{
        	background-color: white;
        	padding-top: 2em;
        	  font-family: 'Nunito Sans', sans-serif;
        }
         .content-pentahelix .fitur-content {
         	padding: 1.2em;
         }
        .content-pentahelix .content-top .fitur-box{
        	height: auto;
        	overflow: hidden;
        	box-shadow:0px 0px 38px 0px #bdbdbd;
  			background-color:white;
        	padding: 2em 2em;
        	height: 24em;
        }
         .content-pentahelix .content-top .fitur-box .icon-box i{
         	background-color: #CF090A;
         	padding: 1em;
         	border-radius: 50%;
         	font-size: 36px;
         	color: white;
         	margin-bottom: 10px;
         }
         .content-pentahelix .desc-content{
         	padding-top:1em;
         	padding-bottom: 1em; 
         	font-size: 21px;
         }
         .content-pentahelix .content-top .fitur-box p{
         	margin-top: 15px;
         	font-size: 16px;
         }
         .content-pentahelix .content-top .header-fitur-content{
         	padding: 15px ;
         }
         .panel-group .panel-heading{
         	padding-top:2em;
         	padding-bottom: 2em; 
         }
         .panel-group .panel-heading span{
          padding: 0 1.5em;
          width: 100px;
          display: inline-block;
          text-align: center;
         }
         .panel-group .panel-heading span i{
          font-size: 28px;

         }
         .panel-group .panel-heading  a{
         	padding-left:1.5em ;
         	border-left: solid 1px ;
          padding-top: 1em;
          padding-bottom: 1em;
         }
          .content-pentahelix .content-bottom{
          	padding: 2em 6.2em;
            background-image:url('<?=base_url();?>assets/images/logo/Page_Pentahelix.png');
            background-size: cover;
            background-repeat: no-repeat;
          }
          div.container-fluid.container-fluid.content-pentahelix_2{
            padding: 1em 0;
          }
          .content-pentahelix .content-bottom .panel{
            margin: 2em 0;
            box-shadow:0px 0px 28px 0px #120F0F;
          }
           .content-pentahelix .content-bottom .panel .panel-body{
            font-size: 18px;
            font-weight: 400;
           }
        @media(max-width:991px){
            .descrip-img{
                display: none;
            }
        }
        @media(max-width:500px){


            div.container-fluid{
              padding: 0 1em;
            }
            .detail_layanan .content-left{
              padding: 15px;
            }
            .detail_layanan .desrip-news p{
                 word-wrap: break-word;
                 font-size: 14px;
            }
            .detail_layanan .desrip-news{
            padding: 15px 0;
        }
        }
    </style>
    <section class="detail_layanan">
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h1 style="">Pentahelix </h1></div>
            </div>
        </div>
        <div class="container-fluid content-pentahelix">
            <div class="row content">
            	<div class="col col-md-12 col-sm-12 col-xs-12 content-top">
            		<div class="col col-md-12 col-sm-12 col-xs-12 desc-content">
            			<p><?=$penta['deskripsi'];?></p>
            		</div>
            		<div class="col col-md-12 col-sm-12 col-xs-12 header-fitur-content">
            			<h3><b>Kompnen Platform :</b></h3>
            		</div>
            		<?php foreach ($helix as $key => $value): ?>
                    <div class="col col-md-4 col-sm-4 col-xs-12 fitur-content">
                        <div class="fitur-box text-center">
                            <div class="icon-box"><i class="glyphicon <?php if($value['jenis'] == 2){ ?> glyphicon-link <?php }elseif($value['jenis'] == 3){ ?> glyphicon-search <?php }else{ ?> glyphicon-education <?php } ?>"></i><!-- <i class="glyphicon glyphicon-education"></i> --></div>
                            <h3><b><?=$value['judul'];?></b></h3>
                            <p><?=$value['deskripsi'];?></p>
                        </div>
                    </div>    
                <?php endforeach ?>
            	</div>
           
            </div>
        </div>
        <div class="container-fluid content-pentahelix  content-pentahelix_2 ">
              <div class="col col-md-12 col-sm-12 col-xs-12 content-bottom">
                <div class="panel-group" id="accordion">
                          <?php foreach ($instansi as $key => $value): ?>
                            <div class="panel " style=" text-align: left;">
                                <div class="panel-heading" >
                                    <h4 class="panel-title">
                                      <span><i class="<?=$value['icon'];?>"></i></span>
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$key;?>" style="text-decoration: none;"><b><?=$value['nm_jenis_instansi']?></b></a>
                                  </h4>
                                    
                                </div>
                                <div id="collapse<?=$key;?>" class="panel-collapse collapse <?php if($key == 0){ ?> in <?php } ?>">
                                    <div class="panel-body">
                                        <p>
                                            <?=$value['deskripsi'];?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                          <?php endforeach ?>
                          <!-- <div class="panel " style=" text-align: left;">
                              <div class="panel-heading" >
                                  <h4 class="panel-title">
                                    <span><i class="glyphicon glyphicon-education"></i></span>
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="text-decoration: none;"><b>Academic</b></a>
                                </h4>
                                  
                              </div>
                              <div id="collapseOne" class="panel-collapse collapse in">
                                  <div class="panel-body">
                                      <p>
                                          <h4 class="text-center">Akademik Sebagai Konseptor</h4>
                                          <ul class="list-unstyled">
                                              <li><b>Funsi</b></li>
                                              <li><i class="fa fa-circle" ></i>Standarisasi bisnis proses</li>
                                              <li><i class="fa fa-circle" ></i>Sertifikasi pendidikan dan keaglian</li>
                                          </ul>
                                          <h4><b>Peran</b></h4>
                                          <p>Akademisi adalah perghuruan tinggi negeri dan swasta sebagai stakeholder dan pengguna utama yang memanfaatkan jaringan IDREN untuk kerperluan riset.Academic berpeeran sebagai konseptor dalam menyiapkan standarisasi proses bisnis dan melakukan sertifikasi produk dan keahlian kreatif digital di Indonesia. Akademisi sangat berperan dalam seluruh variabel pembentuk kinerja bisnis</p>

                                      </p>
                                  </div>
                              </div>
                          </div>
                            <div class="panel " style=" text-align: left;">
                                <div class="panel-heading" >
                                    <h4 class="panel-title">
                                      <span><i class="fa fa-building-o"></i></span>
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="text-decoration: none;"><b>Business</b></a>
                                  </h4>
                                    
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse ">
                                    <div class="panel-body">
                                        <p>
                                            <h4 class="text-center">Bisnis Sebagai enabler</h4>
                                            <ul class="list-unstyled">
                                                <li><b>Funsi</b></li>
                                                <li><i class="fa fa-circle" ></i>Meningkatkan kualitas infrastruktur ICT</li>
                                                <li><i class="fa fa-circle" ></i>Sinergy link & match dengan perguruan tinggi</li>
                                                <li><i class="fa fa-circle" ></i>Pengembangan kualitas people, proccess & product menuju era digital</li>
                                            </ul>
                                            <h4><b>Peran</b></h4>
                                            <p>Pebisnis berperan dalam menyediakan dan meningkatkan kualitas dan jangkauan ICT di seluruh tanah air. Selain itu juga diharapkan dapat mendorong penggunaan teknologi digital dalam setiap aspek kehidupan. Para stakeholder bisnis dalam mendorong daya saing perguruan tinggi tidak lepas dari link & match antara kualitas pendidikan dengan tantangan bisnis aktual</p>

                                        </p>
                                    </div>
                                </div>
                                </div>
                                    <div class="panel " style=" text-align: left;">
                                        <div class="panel-heading" >
                                          <h4 class="panel-title">
                                            <span><i class="fa fa-bank"></i></span>
                                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="text-decoration: none;"><b>Government</b></a>
                                        </h4>
                                            
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse ">
                                            <div class="panel-body">
                                                 <p>
                                                    <h4 class="text-center">Pemerintah sebagai regulator</h4>
                                                    <ul class="list-unstyled">
                                                        <li><b>Funsi</b></li>
                                                        <li><i class="fa fa-circle" ></i>Mengatur dan mengkoordinasikan kebijakan ke seluruh stakeholder</li>
                                                        <li><i class="fa fa-circle" ></i>Mengatur usaha modal negara dibidang riset</li>
                                                      
                                                    <h4><b>Peran</b></h4>
                                                    <p>Pemerintah berperan dalam menyediakan reulasi yang membantu industri kreatif digital sekaligus menjadi koordinator seluruh aktor utama. Pemerintahn sangat berperan dalam seluruh variable pembentuk kinerja bisnis yang berkelanjutan. Pemerintauh adalah aktor utama yang menjadi lokomotif keberhasilsan industri kreatif  digital di Indonesia, berhasil  atau tidaknya peran keempat aktor Pentahelix sangat bergantung dari kemampuan Pemerintah dalam menjalankan kebijakan di bidang riset.</p>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel " style=" text-align: left;">
                                        <div class="panel-heading" >
                                          <h4 class="panel-title">
                                            <span><i class="fa fa-users"></i></span>
                                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" style="text-decoration: none;"><b>Community</b></a>
                                        </h4>
                                            
                                        </div>
                                        <div id="collapseFour" class="panel-collapse collapse ">
                                            <div class="panel-body">
                                                 <p>
                                                    <h4 class="text-center">Pemerintah sebagai regulator</h4>
                                                    <ul class="list-unstyled">
                                                        <li><b>Funsi</b></li>
                                                        <li><i class="fa fa-circle" ></i>Akselerator proses adopsi teknologi digital</li>
                                                        <li><i class="fa fa-circle" ></i>Menjembatani semua pemangku kepentingan melalui lembaga riset</li>
                                                      
                                                    <h4><b>Peran</b></h4>
                                                    <p>Kominitas adalah lembaga riset yag berperan dalam mendukung pern industri kreatif digital dengan membuka akses interaksi lembaga ruset dengan peningkatakn keahlian dan pendidikan. Komunitas berperan penting dalam penciptaan suatu perusahaan kreatif digital di Indonesia.</p>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel " style=" text-align: left;">
                                        <div class="panel-heading" >
                                          <h4 class="panel-title">
                                            <span><i class="fa fa-newspaper-o"></i></span>
                                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" style="text-decoration: none;"><b>Media</b></a>
                                        </h4>
                                            
                                        </div>
                                        <div id="collapseFive" class="panel-collapse collapse ">
                                            <div class="panel-body">
                                                 <p>
                                                    <h4 class="text-center">Komunitas sebagai accelerator</h4>
                                                    <ul class="list-unstyled">
                                                        <li><b>Funsi</b></li>
                                                        <li><i class="fa fa-circle" ></i>Sarana publikasi dan penghubung antara dunia riset dan publik</li>
                                                        <li><i class="fa fa-circle" ></i>Media interaksi dan saan/feedback</li>
                                                      
                                                    <h4><b>Peran</b></h4>
                                                    <p>Media berperan sebagai expander dalam menghubungkan seluruh aktor utama dengan pasar industri kreatif digital nasional dan terutama global. Media sangat berperan dalam banyak aspek industri kreatif digital, namun secara khusus berperan dalam memastikan reputasi perusahaan di Indonesia dapa sejajar dengan negara maju lainnya.</p>

                                                </p>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
              </div> 
        </div>

    </section>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
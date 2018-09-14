<link rel="stylesheet" href="<?=base_url();?>assets/css/style_home.min.css?t=<?=time();?>"> 

 <section class="hero" style="">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6 col-sm-6 col-xs-12 hero-right">
                    <div class="sub-video">
                        <!-- <img class="img-responsive" src="assets/img/video.jpg"> -->
                        <iframe class="hero-video" title="hero" name="hero" src="<?php echo $hero['video']; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 hero-left">
                    <h1><?php echo $hero['judul']; ?></h1>
                    <p> <?php echo $hero['deskripsi']; ?></p>
                 
                    <a href="<?php echo site_url('web/layanan'); ?>" class="btn  btn-pelajari" type="button">Pelajari lebih lanjut <i class="fa fa-long-arrow-right"></i></a>
                </div>
              <!--   <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="arrow-line">
                        <div class="line-left"><a class="js-scroll-trigger" href="#layanan"><i class="glyphicon glyphicon-arrow-down"></i></a></div>
                       
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <section class="layanan" id="layanan">
        <div class="col-md-12 col-sm-12 col-xs-12 top">
            <div class="line">
                <div class="sub-line"></div>
            </div>
            <div class="title">
                <h2>Penta<span style="color:#D10909;">helix</span></h2></div>
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
                        <div class="col col-md-2 col-sm-4 col-xs-12 fitur-content">
                            <div class="fitur-box text-center">
                                <div class="icon-box"><i class="<?=$value['icon'];?>"></i><!-- <i class="glyphicon glyphicon-education"></i> --></div>
                                <h3><b><?=$value['nm_jenis_instansi']?></</b></h3>
                                <div class="paraph"><?=$value['short_description'];?></div>
                            </div>
                        </div>    
                    <?php endforeach ?>
                  
                    <div class="col col-md-12 col-sm-12 col-xs-12 text-right">
                        <a href="<?php echo site_url('web/pentahelix'); ?>" class="btn  btn-pelajari" type="button">Pelajari lebih lanjut <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                  <!--   <div class="col-md-12 col-sm-12 col-xs-12 text-left">
                    <div class="arrow-line">
                        <div class="line-left"><a class="js-scroll-trigger" href="#client"><i class="glyphicon glyphicon-arrow-down"></i></a></div>
                        
                    </div>
                </div> -->
                </div>
           
            </div>
        </div>
      <!--   <div class="container-fluid">
            <div class="row">
                <div class="col-md-7 col-sm-8 col-xs-12 sub-service-left">
                    <div class="filter-box"><img class="img-responsive" src="<?php echo $layanan['image']; ?>"></div>
                    <div class="navigation">
                        <ul class="">
                            <li style="border-right: solid 1px #761919;"><a href="#" style="color:#421A1A; "><i class="fa fa-angle-left"></i></a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 col-sm-4 col-xs-12 sub-service-right">
                    <h3>Kemudahan Berbagi</h3>
                    <div class="line"></div>
                    <p><?php echo $layanan['deskripsi']; ?></p>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                    <div class="arrow-line">
                        <div class="line-left"><a class="js-scroll-trigger" href="#client"><i class="glyphicon glyphicon-arrow-down"></i></a></div>
                        
                    </div>
                </div>
            </div>
        </div> -->
    </section>
    <section class="client" id="client">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 top" >
                    <h3 class="text-center"><?php echo $title_slider['title']; ?></h3></div>
                <div class="col-md-12 col-sm-12 col-xs-12 none-padding sub-client" id="owl-demo" >
                    <?php if ($instansi !="") {?>
                        <?php foreach ($instansi as $key => $value) :  ?>
                            <div class="col col-md-12 col-sm-12 col-xs-12 text-center item">
                                <div class="filter-img-client "><img src="<?php echo base_url().$value['image_thumbnail']; ?>" class="img-responsive" alt="logo instansi"></div>
                                <div><p><?php echo $value['instansi']; ?></p></div>
                            </div>
                        <?php endforeach ?>
                   <?php }else
                        echo "Data not found"
                    ?>
                    
            
                </div>
                
            </div>
        </div>
    </section>
   <!--  <div class="col-md-12 col-sm-12 col-xs-12 none-padding text-center">
                    <div class="arrow-line">
                        <div class="line-left" style="padding-top: 5px;padding-right: 35px;"><a class="js-scroll-trigger" href="#testimonial"><i class="glyphicon glyphicon-arrow-down"></i></a></div>
                    </div>
                </div> -->
    <section class="testimonial" id="testimonial">
        <div class="container-fluid">
            <div class="row sub-testimoni" id="owl-demo">
                <?php if ($testimoni !="") { ?>

                    <?php foreach ($testimoni as $key => $value) : ?>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center item" >
                            <div class="filter-img-testimoni"><img src="<?php echo base_url().$value['image']; ?>" class="img-testimoni" alt="user testimoni"></div>
                            <h2 class="name-testi"><?php echo $value['user']; ?></h2>
                            <h3 class="job description"><?php echo $value['sebagai']; ?> </h3><i class="fa fa-quote-left fa-2x"></i>
                            <p> <?php echo $value['testimoni']; ?></p>
                            <a href="<?php echo site_url('web/testimoni'); ?>" class="btn  btn-rekomendasi" type="button">Lihat Rekomendasi Lain</a>
                        </div>
                    <?php endforeach ?>

                <?php }else
                    echo "data not found";
                 ?>
                
             
            </div>
        </div>
    </section>
    <section class="footer-top">
        <div class="container-fluid sub-footer-top">
            <div class="col-md-12 text-center">
                <h3 class="title"><?=$kolaborasi['title'];?></h3>
                <p><?=$kolaborasi['content'];?></p>
                <a href="<?php echo site_url('web/keanggotaan/pendaftaran') ?>" class="btn  btn-gabung" type="button">Gabung Sekarang</a>
            </div>
        </div>
    </section>
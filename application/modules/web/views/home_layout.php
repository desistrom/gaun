 <section class="hero" style="margin-top: 5em;">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6 col-sm-6 col-xs-12 hero-right">
                    <div class="sub-video">
                        <!-- <img class="img-responsive" src="assets/img/video.jpg"> -->
                        <iframe class="hero-video" src="<?php echo $hero['video']; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 hero-left">
                    <h1><?php echo $hero['judul']; ?></h1>
                    <p> <?php echo $hero['deskripsi']; ?></p>
                 
                    <a href="<?php echo site_url('web/layanan'); ?>" class="btn  btn-pelajari" type="button">Pelajari lebih lanjut <i class="fa fa-long-arrow-right"></i></a>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="arrow-line">
                        <div class="line-left"><a class="js-scroll-trigger" href="#layanan"><i class="glyphicon glyphicon-arrow-down"></i></a></div>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="layanan" id="layanan">
        <div class="col-md-12 col-sm-12 col-xs-12 top">
            <div class="line">
                <div class="sub-line"></div>
            </div>
            <div class="title">
                <h2>Layanan <span style="color:#D10909;">IDren</span></h2></div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7 col-sm-8 col-xs-12 sub-service-left">
                    <div class="filter-box"><img class="img-responsive" src="<?php echo $layanan['image']; ?>"></div>
                    <!-- <div class="navigation">
                        <ul class="">
                            <li style="border-right: solid 1px #761919;"><a href="#" style="color:#421A1A; "><i class="fa fa-angle-left"></i></a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </div> -->
                </div>
                <div class="col-md-5 col-sm-4 col-xs-12 sub-service-right">
                    <h3>Kemudahan Berbagi</h3>
                    <div class="line"></div>
                    <p><?php echo $layanan['deskripsi']; ?><!-- Melalui jaringan privat, kolaborasi dan pengembangan kegiatan di perguruan tinggi semakin cepat dan nyaman. --> </p>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                    <div class="arrow-line">
                        <div class="line-left"><a class="js-scroll-trigger" href="#client"><i class="glyphicon glyphicon-arrow-down"></i></a></div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="client" id="client">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 top" >
                    <h3 class="text-center">Akademisi yang bergabung dengan kami</h3></div>
                <div class="col-md-12 col-sm-12 col-xs-12 none-padding sub-client" id="owl-demo" >
                    <?php foreach ($instansi as $key => $value) :  ?>
                    <div class="col col-md-12 col-sm-12 col-xs-12 text-center item">
                        <div class="filter-img-client "><img src="<?php echo $value['image_thumbnail']; ?>" class="img-responsive" ></div>
                    </div>
                <?php endforeach ?>
            
                </div>
                
            </div>
        </div>
    </section>
    <div class="col-md-12 col-sm-12 col-xs-12 none-padding text-center">
                    <div class="arrow-line">
                        <div class="line-left" style="padding-top: 5px;padding-right: 35px;"><a class="js-scroll-trigger" href="#testimonial"><i class="glyphicon glyphicon-arrow-down"></i></a></div>
                    </div>
                </div>
    <section class="testimonial" id="testimonial">
        <div class="container-fluid">
            <div class="row sub-testimoni" id="owl-demo">
                <?php foreach ($testimoni as $key => $value) : ?>
                <div class="col-md-12 col-sm-12 col-xs-12 text-center item" >
                    <div class="filter-img-testimoni"><img src="<?php echo $value['image']; ?>" class="img-testimoni"></div>
                    <h2 class="name-testi"><?php echo $value['user']; ?></h2>
                    <h3 class="job description"><?php echo $value['sebagai']; ?> </h3><i class="fa fa-quote-left fa-2x"></i>
                    <p> <?php echo $value['testimoni']; ?></p>
                    <a href="<?php echo site_url('web/testimoni'); ?>" class="btn  btn-rekomendasi" type="button">Lihat Rekomendasi Lain</a>
                </div>
            <?php endforeach ?>
             
            </div>
        </div>
    </section>
    <section class="footer-top">
        <div class="container-fluid sub-footer-top">
            <div class="col-md-12 text-center">
                <h3 class="title">Kolaborasi, tanpa batas</h3>
                <p>Terhubung dengan mudah keseluruh akademi Indonesia</p>
                <button class="btn  btn-gabung" type="button">Gabung Sekarang</button>
            </div>
        </div>
    </section>
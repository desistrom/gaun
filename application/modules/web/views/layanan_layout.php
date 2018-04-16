   <style type="text/css">
       .layanan .content-left{
        padding: 3em 10em;
        
       }
       .layanan .title-page-news{
       
       }
       .layanan{
        background-color: #F2F2F2;
        height: auto;
       }

   </style>
   <section class="layanan">
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                <h1>Layanan </h1></div>
            </div>
       
             <div class="col-md-12 col-sm-12 col-xs-12 content-left">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <div class="col col-md-6 col-sm-6 col-xs-6 none-padding img-news"><img class="img-responsive" src="<?php echo $idroam['image']; ?>"></div>
                        <div class="col col-md-6 col-sm-6 col-xs-6 desrip-news">
                            <h4 class="title-news"><?php echo $idroam['judul']; ?></h4>
                             <p class="isi-news"> <?php echo word_limiter($idroam['deskripsi'],40); ?> </p> 
                            
                            <!-- <ul class="list-inline date_event">
                                <li><i class="glyphicon glyphicon-calendar"></i> 17 Agustus 1945</li>
                                <li><i class="glyphicon glyphicon-briefcase"></i> Rapat</li>
                            </ul> -->
                        </div>
                        <a href="<?php echo site_url('web/layanan/idroam') ?>" class="btn btn-danger btn-read-more" type="button"  >Read More</a>
                    </div>
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <div class="col col-md-6 col-sm-6 col-xs-6 none-padding img-news"><img class="img-responsive" src="<?php echo $cloud_federation['image']; ?>"></div>
                        <div class="col col-md-6 col-sm-6 col-xs-6 desrip-news">
                            <h4 class="title-news"><?php echo $cloud_federation['judul']; ?></h4>
                             <p class="isi-news"><?php echo word_limiter($cloud_federation['deskripsi'],40); ?> </p> 
                            
                            <!-- <ul class="list-inline date_event">
                                <li><i class="glyphicon glyphicon-calendar"></i> 17 Agustus 1945</li>
                                <li><i class="glyphicon glyphicon-briefcase"></i> Rapat</li>
                            </ul> -->
                        </div>
                        <a href="<?php echo site_url('web/layanan/cloud_federation') ?>" class="btn btn-danger btn-read-more" type="button"  >Read More</a>
                    </div>   
               </div> 
</div>
</section>
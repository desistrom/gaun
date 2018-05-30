   <link rel="stylesheet" href="<?=base_url();?>assets/css/style_testimoni.min.css?t=<?=time();?>"> 
   <link rel="stylesheet" href="<?=base_url();?>assets/css/style_tentang.min.css?t=<?=time();?>"> 
    <section class="detail_layanan">
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h1 style="">Tentang IDren </h1></div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row content-news">
               
                <div class="col-md-12 col-sm-12 col-xs-12 content-left">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                            
                            <div class="col col-md-12 col-sm-12 col-xs-12 none-padding isi-news" style="padding: 0 15px;color: #919191;"><?php echo $about['content']; ?></div>
                            <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sec-anggota" >
                            <?php foreach ($founder as $key => $value): ?>
                                <div class="col col-md-4 col-sm-6 col-xs-12 box-testimoni">
                                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sub-box-testimoni">
                                        <div class="col col-md-12 col-sm-12 col-xs-12 text-center filter-img-user" style="background-color: white;">
                                            <div class="box-testimoni-left ">
                                                <div class="filter-box-mg-testimoni">
                                                    <img class="img-responsive img-user" src="<?=base_url();?><?=$value['foto'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding box-testimoni-right">
                                            <h3 class="text-bold title-box-testimoni" style="color: white;"><?=$value['nama'];?></h3>
                                            <p class="jabatan" style="color: white;"><?=$value['jabatan'];?> </p>
                                           
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                                
                            </div>
                            
                            
                        </div>
                       
                    </div>
                </div>
            
            </div>
        </div>

    </section>
   <link rel="stylesheet" href="<?=base_url();?>assets/css/style_testimoni.min.css?t=<?=time();?>"> 
    <style type="text/css">
        .img-news img{
            width: 100%;
            
        }
        .detail_layanan{
            margin-top: 6em;
            background-color: #F2F2F2;
        }
        div.row.content-news{
            background-color: #F2F2F2;
        }
        .list-artikel{
            padding: 0 15px;
        }
        .detail_layanan .desrip-news{
            padding: 2em;
        }
        .detail_layanan .desrip-news p{
            font-size: 18px;
        }
        .detail_layanan .content-left{
            padding: 0 4em;
        }
        .detail_layanan .list-artikel,
        .detail_layanan .descrip-img{
            padding-right: 0;
        }
        .detail_layanan .descrip-img img{
            width: 100%;
        }
        .detail_layanan .desrip-news p{
                 word-wrap: break-word;
            }
            .img-user{
                width: 200px;
                height:200px;
                border-radius: 50%;
            }
            .box-testimoni{
                padding: 0 15px;
            }
            div.sub-box-testimoni{
                height: 10em;
                padding: 15px;
                height: 25em;
            }
            .content-left{
                margin-top: 0;
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
                 font-size: 16px;
            }
            .detail_layanan .desrip-news{
            padding:15px 0;
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
                    <h1 style="">Tentang IDren </h1></div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row content-news">
               
                <div class="col-md-12 col-sm-12 col-xs-12 content-left">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                            
                            <div class="col col-md-12 col-sm-12 col-xs-12 none-padding isi-news" style="padding: 0 15px;color: #919191;"><?php echo $about['content']; ?></div>
                            <div class="col col-md-12 col-sm-12 col-xs-12 none-padding">
                                  <div class="col col-md-4 col-sm-6 col-xs-12 box-testimoni">
                                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sub-box-testimoni">
                                        <div class="col col-md-12 col-sm-12 col-xs-12 text-center">
                                            <div class="box-testimoni-left ">
                                                <div class="filter-box-mg-testimoni">
                                                    <img class="img-responsive img-user" src="<?=base_url();?>assets/images/logo/ttg.png">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding box-testimoni-right">
                                            <h4 class="text-bold title-box-testimoni" style="color: #CF090A;">M.dika Pratana</h4>
                                            <p class="text-bold" style="color: #747474;">Menteri Riset, Teknologi dan Pendidikan Tinggi Republik Indonesia </p>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-md-4 col-sm-6 col-xs-12 box-testimoni">
                                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sub-box-testimoni">
                                        <div class="col col-md-12 col-sm-12 col-xs-12 text-center">
                                            <div class="box-testimoni-left ">
                                                <div class="filter-box-mg-testimoni">
                                                    <img class="img-responsive img-user" src="<?=base_url();?>assets/images/logo/ttg.png">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding box-testimoni-right">
                                            <h4 class="text-bold title-box-testimoni" style="color: #CF090A;">M.dika Pratana</h4>
                                            <p class="text-bold" style="color: #747474;">Menteri Riset, Teknologi dan Pendidikan Tinggi Republik Indonesia </p>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-md-4 col-sm-6 col-xs-12 box-testimoni">
                                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sub-box-testimoni">
                                        <div class="col col-md-12 col-sm-12 col-xs-12 text-center">
                                            <div class="box-testimoni-left ">
                                                <div class="filter-box-mg-testimoni">
                                                    <img class="img-responsive img-user" src="<?=base_url();?>assets/images/logo/ttg.png">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding box-testimoni-right">
                                            <h4 class="text-bold title-box-testimoni" style="color: #CF090A;">M.dika Pratana</h4>
                                            <p class="text-bold" style="color: #747474;">Menteri Riset, Teknologi dan Pendidikan Tinggi Republik Indonesia </p>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                       <!--  <div class="col col-md-7 col-sm-12 col-xs-12 descrip-img">
                            <img class="img-responsive" width="100%" src="<?=base_url();?>assets/images/logo/">
                        </div> -->
                    </div>
                </div>
            
            </div>
        </div>

    </section>
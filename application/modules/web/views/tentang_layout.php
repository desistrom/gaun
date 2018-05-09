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
                padding: 0;
                height: 28em;
                 background-image:url('<?=base_url();?>assets/images/logo/bg-jabatan.png');
                background-size: cover;
                background-repeat: no-repeat;
                font-family: 'Nunito Sans', sans-serif;
                    }
            .box-testimoni-right{

                padding: 4em 15px 15px 15px;

            }
            .filter-img-user{
                 background-image:url('<?=base_url();?>assets/images/logo/bg-pen-min.png');
                background-size: cover;
                background-repeat: no-repeat;
            }
            .box-testimoni-left{
                padding: 4em  15px 15px;
                margin-bottom: -5em;

            }
            .content-left{
                margin-top: 0;
              
            }
            .sec-anggota{
                padding-top: 4.5em;
            }
            .box-testimoni-right .jabatan{
                font-size: 14px;
            }
            .detail_layanan .desrip-news p{
                font-size: 14px;
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
                            <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sec-anggota" >
                            <?php foreach ($founder as $key => $value): ?>
                                <div class="col col-md-4 col-sm-6 col-xs-12 box-testimoni">
                                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sub-box-testimoni">
                                        <div class="col col-md-12 col-sm-12 col-xs-12 text-center filter-img-user" style="background-color: white;">
                                            <div class="box-testimoni-left ">
                                                <div class="filter-box-mg-testimoni">
                                                    <img class="img-responsive img-user" src="<?=base_url();?>assets/media/<?=$value['foto'];?>">
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
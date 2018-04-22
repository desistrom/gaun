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
                        <div class="col col-md-5 col-sm-12 col-xs-12 desrip-news">
                            
                            <div class="isi-news" style="padding: 0 15px;color: #919191;"><?php echo $about['content']; ?></div>
                            
                            
                        </div>
                        <div class="col col-md-7 col-sm-12 col-xs-12 descrip-img">
                            <img class="img-responsive" width="100%" src="<?=base_url();?>assets/images/logo/ttg.png">
                        </div>
                    </div>
                </div>
            
            </div>
        </div>

    </section>
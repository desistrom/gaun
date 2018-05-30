<!-- <link rel="stylesheet" href="<?=base_url();?>assets/css/benefit.min.css?t=<?=time();?>">
    <section class="detail_layanan">
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h1 style="">Benefit </h1></div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row content-news">
               
                <div class="col-md-12 col-sm-12 col-xs-12 content-left">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                    <img class="img-benefit" width="100%;" src="<?php echo $benefit['picture']; ?>" >
                        <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                            
                            <div class="isi-news" style="padding: 0 15px;color: #919191;"><?php echo $benefit['benefit']; ?></div>
                    </div>
                </div>
            
            </div>
        </div>

    </section> -->
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
            padding-bottom: 3em;
        }
    </style>
    <section class="detail_layanan">
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h1 style="">Benefit</h1></div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row content-news">
                <div class="col col-md-2 col-sm-2 col-xs-2"></div>
                <div class="col-md-8 col-sm-8 col-xs-12 content-left">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding img-news">
                       
                        <img class="img-responsive" width="100%;" src="<?php echo base_url().$benefit['picture']; ?>" >                          
                        
                        </div>
                        <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                        
                            <div class="isi-news" style="padding: 0 15px;"><?php echo $benefit['benefit']; ?></div>
                            
                            
                        </div>
                    </div>
                </div>
                <div class="col col-md-2 col-sm-2 col-xs-2"></div>
            </div>
        </div>

    </section>
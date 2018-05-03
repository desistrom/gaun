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
                    <h1 style=""><?=$layanan['nama_page'];?> </h1></div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row content-news">
                <div class="col col-md-2 col-sm-2 col-xs-2"></div>
                <div class="col-md-8 col-sm-8 col-xs-12 content-left">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding img-news">
                        <?php if ($layanan['image'] != '' || $layanan['image'] == 'dummy'): ?>                            
                            <img class="img-responsive" src="<?=base_url();?>media/<?=$layanan['image'];?>"><?php endif ?>
                        </div>
                        <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                            <h4 class="title-news"><?=date("d M Y", strtotime($layanan['tgl_update']));?></h4>
                            <div class="isi-news" style="padding: 0 15px;"><?=$layanan['content'];?></div>
                            
                            
                        </div>
                    </div>
                </div>
                <div class="col col-md-2 col-sm-2 col-xs-2"></div>
            </div>
        </div>

    </section>
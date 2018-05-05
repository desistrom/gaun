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
       .img-news img{
        max-height: 250px;
        width: 100%;
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
                    <div class="col col-md-6 col-sm-6 col-xs-12">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding img-news"><img class="img-responsive" src="<?=base_url();?>media/<?=$book['image'];?>"></div>
                        <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                            <h4 class="title-news">ID-BOOK</h4>
                             <p class="isi-news"> <?=word_limiter($book['content'],5);?> </p> 
                        </div>
                        <a href="<?php echo site_url('web/layanan/id_book') ?>" class="btn btn-danger btn-read-more" type="button"  >Read More</a>
                    </div>
                    </div>
                    <div class="col col-md-6 col-sm-6 col-xs-12">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding img-news"><img class="img-responsive" src="<?=base_url();?>media/<?=$journal['image'];?>"></div>
                        <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                            <h4 class="title-news">ID-JOURNAL</h4>
                             <p class="isi-news"><?=word_limiter($journal['content'],5);?> </p> 
                        </div>
                        <a href="<?php echo site_url('web/layanan/id_journal') ?>" class="btn btn-danger btn-read-more" type="button"  >Read More</a>
                    </div>
                    </div>
                    <div class="col col-md-6 col-sm-6 col-xs-12">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding img-news"><img class="img-responsive" src="<?=base_url();?>media/<?=$tube['image'];?>"></div>
                        <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                            <h4 class="title-news">ID-TUBE</h4>
                             <p class="isi-news"> <?=word_limiter($tube['content'],5);?> </p> 
                        </div>
                        <a href="<?php echo site_url('web/layanan/id_tube') ?>" class="btn btn-danger btn-read-more" type="button"  >Read More</a>
                    </div>
                    </div>
                    <div class="col col-md-6 col-sm-6 col-xs-12">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding img-news"><img class="img-responsive" src="<?=base_url();?>media/<?=$mail['image'];?>"></div>
                        <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                            <h4 class="title-news">ID-Mail</h4>
                             <p class="isi-news"> <?=word_limiter($mail['content'],5);?></p> 
                        </div>
                        <a href="<?php echo site_url('web/layanan/id_mail') ?>" class="btn btn-danger btn-read-more" type="button"  >Read More</a>
                    </div>
                    </div>
                    <div class="col col-md-6 col-sm-6 col-xs-12">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding img-news"><img class="img-responsive" src="<?=base_url();?>media/<?=$research['image'];?>"></div>
                        <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                            <h4 class="title-news">ID-Research</h4>
                             <p class="isi-news"> <?=word_limiter($research['content'],5);?> </p> 
                        </div>
                        <a href="<?php echo site_url('web/layanan/id_research') ?>" class="btn btn-danger btn-read-more" type="button"  >Read More</a>
                    </div>
                    </div>
                    <div class="col col-md-6 col-sm-6 col-xs-12">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding img-news"><img class="img-responsive" src="<?=base_url();?>media/<?=$link['image'];?>"></div>
                        <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                            <h4 class="title-news">ID-Link</h4>
                             <p class="isi-news"> <?=word_limiter($link['content'],5);?> </p> 
                        </div>
                        <a href="<?php echo site_url('web/layanan/id_link') ?>" class="btn btn-danger btn-read-more" type="button"  >Read More</a>
                    </div>
                    </div>
                    <div class="col col-md-6 col-sm-6 col-xs-12">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding img-news"><img class="img-responsive" src="<?=base_url();?>media/<?=$rank['image'];?>"></div>
                        <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                            <h4 class="title-news">ID-RANK</h4>
                             <p class="isi-news"> <?=word_limiter($rank['content'],5);?> </p> 
                        </div>
                        <a href="<?php echo site_url('web/layanan/id_rank') ?>" class="btn btn-danger btn-read-more" type="button"  >Read More</a>
                    </div>
                    </div>

               </div> 
</div>
</section>
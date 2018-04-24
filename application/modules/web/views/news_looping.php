<?php if($news != ''){ foreach ($news as $key => $value) : ?>
    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
        <div class="col col-md-6 col-sm-12 col-xs-12 none-padding img-news"><img class="img-responsive" src="<?php echo $value['gambar']; ?>"></div>
        <div class="col col-md-6 col-sm-12 col-xs-12 desrip-news">
            <h4 class="title-news"><?php echo $value['title']; ?></h4>
             <?php echo word_limiter($value['news_content'],20); ?> 
            
            <ul class="list-inline date_event">
                <div style="padding: 10px 0 5px 0;"><span><i class="fa fa-link" style="padding-right: 5px;"> </i></span><?php echo $value['sumber']; ?></div>
                <li><i class="glyphicon glyphicon-calendar"></i><?php echo date('d m Y', strtotime($value['tanggal'])); ?></li>
                <li><i class="glyphicon glyphicon-briefcase"></i> <?php echo $value['kategori']; ?></li>
                
            </ul>

        </div>
        <a href="<?=base_url();?>web/news/get_news?data=<?php echo $value['newsId']; ?>" class="btn btn-danger btn-read-more" type="button"  >Read More</a>
    </div>
<?php endforeach; }else{
    return false;
    } ?>
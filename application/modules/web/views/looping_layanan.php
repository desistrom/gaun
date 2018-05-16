<?php if($page != ''){ foreach ($page as $key => $value): ?>
                    <div class="col col-md-6 col-sm-6 col-xs-12">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                            <div class="col col-md-12 col-sm-12 col-xs-12 none-padding img-news text-center">
                                <div class="filter-img-layanan">
                                    <img class="img-responsive img-layanan" src="<?=base_url();?><?php if($value['image'] != ''){ echo 'media/'.$value['image']; }else{ echo 'assets/images/logo/IDREN-2.png'; }?>">
                                </div>
                            </div>
                            <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                            <h4 class="title-news text-center"><?=$value['label'];?></h4>
                             <p class="isi-news"> <?=word_limiter($value['content'],5);?> </p> 
                            </div>
                            <a href="<?php echo site_url($value['link']); ?>" class="btn btn-danger btn-read-more" type="button"  >Read More</a>
                        </div>
                    </div>
                <?php endforeach; }else{ return false; }?>
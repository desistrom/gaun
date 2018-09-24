<?php if($page != ''){ foreach ($page as $key => $value): ?>
                    <div class="col col-md-6 col-sm-6 col-xs-12">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                            <div class="col col-md-12 col-sm-12 col-xs-12 none-padding img-news text-center">
                                <div class="filter-img-layanan">
                                    <img class="img-responsive img-layanan" src="<?=base_url();?><?php if($value['futured_image'] != '' && $value['futured_image'] != ''){ echo 'assets/media/'.$value['futured_image']; }else{ echo 'assets/images/logo/IDREN-2.png'; }?>">
                                </div>
                            </div>
                            <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                            <h4 class="title-news text-center"><?=$value['judul_event'];?></h4>
                             <p class="isi-news"> <?=word_limiter($value['deskripsi_event'],5);?> </p> 
                            </div>
                            <div class="col-md-12" style="margin-bottom: 30px">
                                <div class="col-md-4"><i class="fa fa-calendar"></i> <?=date('d-m-Y', strtotime($value['tgl_event']));?></div>
                                <div class="col-md-4"><i class="fa fa-clock-o"></i> <?=date('H:i', strtotime($value['start_event']));?> - <?=date('H:i',strtotime($value['end_event']));?></div>
                                <div class="col-md-4"><i class="fa fa-map-marker"></i> <?=$value['tempat_event'];?></div>
                            </div>
                            <a href="<?php echo site_url('web/event/detail_event/'.$value['id_event']); ?>" class="btn btn-danger btn-read-more" type="button"  >Read More</a>
                        </div>
                    </div>
                <?php endforeach; }else{ return false; }?>
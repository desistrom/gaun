<?php if(!empty($keanggotaan) && $keanggotaan != 'data not found'){ foreach ($keanggotaan as $key => $value) : ?>
    <?php $ret = ''; ?><div class="col col-md-6 col-sm-6 col-xs-12 box-keanggotaan">
        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sub-box-keanggotaan">
            <div class="col col-md-3 col-sm-12 col-xs-12">
                <div class="box-keanggotaan-left">
                	<div class="filter-box-mg-keanggotaan">
                		<img class="img-responsive logo-instansi" src="<?php echo base_url().$value['image_thumbnail']; ?>">
                	</div>
                </div>
            </div>
            <div class="col col-md-9 col-sm-12 col-xs-12 none-padding box-keanggotaan-right">
                <h4 class="text-bold title-box-keanggotaan"><?php echo $value['instansi']; ?></h4>
                <ul class="list-unstyled">
                    <li>
                        <ul class="list-inline">
                            <li><i class="fa fa-map-marker"></i></li>
                            <li><?php echo $value['address']; ?></li>
                        </ul>
                    </li>
                    <li>
                        <ul class="list-inline">
                            <li><i class="fa fa-phone"></i></li>
                            <li><?php echo $value['number_phone']; ?></li>
                        </ul>
                    </li>
                    <li>
                        <ul class="list-inline">
                            <li><i class="fa fa-laptop"></i></li>
                            <li><a href="<?php $url = explode('/', $value['link']); if(isset($url[1])){ echo $value['link']; }else{ echo "http://".$value['link']; } ?>" target='_blank' class="website-anggota" style="color:#CF090A;text-decoration:none; "> <?php $url = explode('/', $value['link']); if(isset($url[1])){ echo $value['link']; }else{ echo "http://".$value['link']; } ?> </a></li>
                        </ul>

                </ul>
            </div>
        </div>
    </div>
<?php endforeach ; }else{ return false;  } ?>
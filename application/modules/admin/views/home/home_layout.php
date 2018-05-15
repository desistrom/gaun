<?php foreach ($daftar_instansi as $key => $value): ?>
 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
  <div class="small-box <?php if($key%2==0){ ?>bg-yellow <?php }else{ ?> bg-blue <?php } ?>">
    <div class="inner">
      <h3><?=$$value['nm_jenis_instansi'];?></h3>

      <p><?=$value['nm_jenis_instansi'];?></p>
    </div>
    <div class="icon">
      <i class="<?=$value['icon'];?>"></i>
    </div>
    <a href="<?=site_url('admin/keanggotaan/instansi');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div> 
<?php endforeach ?>
<!-- <div class="col-lg-3 col-xs-6">
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3><?=$user;?></h3>

      <p>Instansi</p>
    </div>
    <div class="icon">
      <i class="fa fa-university"></i>
    </div>
    <a href="<?=site_url('admin/keanggotaan/instansi');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div> -->

<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-aqua">
    <div class="inner">
      <h3><?=$news;?></h3>

      <p>News</p>
    </div>
    <div class="icon">
      <i class="fa fa-newspaper-o"></i>
    </div>
    <a href="<?=site_url('admin/news');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-red">
    <div class="inner">
      <h3><?=$video;?></h3>

      <p>Videos</p>
    </div>
    <div class="icon">
      <i class="fa fa-video-camera"></i>
    </div>
    <a href="<?=site_url('admin/galery/list_video');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-green">
    <div class="inner">
      <h3><?=$picture;?></h3>

      <p>Images</p>
    </div>
    <div class="icon">
      <i class="fa fa-picture-o"></i>
    </div>
    <a href="<?=site_url('admin/galery/list_image');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-purple">
    <div class="inner">
      <h3><?=$page;?></h3>

      <p>Pages</p>
    </div>
    <div class="icon">
      <i class="fa fa-picture-o"></i>
    </div>
    <a href="<?=site_url('admin/menu/page');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
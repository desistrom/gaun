<?php foreach ($daftar_instansi as $key => $value): ?>
 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
  <div class="small-box <?php if($key%2==0){ if($key%6==0){ ?> bg-yellow <?php }else { ?> bg-green <?php } }else{ if($key%3==0){ ?> bg-purple <?php }else { ?> bg-blue <?php } } ?>">
    <div class="inner">
      <h3><?=${$value['nm_jenis_instansi']};?></h3>

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

<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-orange">
    <div class="inner">
      <h3><?=$jdosen;?></h3>

      <p>Jumlah Dosen</p>
    </div>
    <div class="icon">
      <i class="fa fa-user"></i>
    </div>
    <a href="<?=site_url('admin/menu/page');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-yellow">
    <div class="inner">

      <h3><?=$jmahasiswa;?></h3>
      <p>Jumlah Mahasiswa</p>
    </div>
    <div class="icon">
      <i class="fa fa-user"></i>
    </div>
    <a href="<?=site_url('admin/menu/page');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-blue">
    <div class="inner">
      <h3><?=$dosen;?></h3>

      <p>Dosen Aktif Login</p>
    </div>
    <div class="icon">
      <i class="fa fa-user"></i>
    </div>
    <a href="<?=site_url('admin/menu/page');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-aqua">
    <div class="inner">
      <h3><?=$mahasiswa;?></h3>

      <p>Mahasiswa Aktif Login</p>
    </div>
    <div class="icon">
      <i class="fa fa-user"></i>
    </div>
    <a href="<?=site_url('admin/menu/page');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
  <!-- <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="pieChart" height="150"></canvas>
                  </div>

                </div>

                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                    <li><i class="fa fa-circle-o text-green"></i> IE</li>
                    <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                    <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                    <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                    <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
                  </ul>
                </div>
          
              </div>
   
            </div> -->

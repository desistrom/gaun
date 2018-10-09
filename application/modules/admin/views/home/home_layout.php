<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Summary Report</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-md-12">
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
</div>
</div>
</div>
</div>
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Data Instansi</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-12">
        <div class="chart-responsive">
          <canvas id="pieChart" height="200"></canvas>
        </div>
        <!-- ./chart-responsive -->
      </div>
      <!-- /.col -->
      <!-- <div class="col-md-4">
        <ul class="chart-legend clearfix">
          <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
          <li><i class="fa fa-circle-o text-green"></i> IE</li>
          <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
          <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
          <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
          <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
        </ul>
      </div> -->
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
</div>
<script src="<?=base_url();?>assets/js/Chart.min.js"></script>
<script type="text/javascript">
    var PieData = [
    <?php foreach ($daftar_instansi as $key => $value): ?>
      <?php if($key != 0){ echo ",";} ?>
    {
      value: <?=${$value['nm_jenis_instansi']};?>,
      // color: "#f56954",
      // <?php if($value['nm_jenis_instansi'] == 'University'){ ?>
      // highlight: "#f56954",
      // <?php } ?>
      // <?php if($value['nm_jenis_instansi'] == 'Business'){ ?>
      // highlight: "#00a65a",
      // <?php } ?>
      // <?php if($value['nm_jenis_instansi'] == 'Goverment'){ ?>
      // highlight: "#f39c12",
      // <?php } ?>
      // <?php if($value['nm_jenis_instansi'] == 'Comunity'){ ?>
      // highlight: "#00c0ef",
      // <?php } ?>
      // <?php if($value['nm_jenis_instansi'] == 'Media'){ ?>
      // highlight: "#3c8dbc",
      // <?php } ?>
      label: "<?=$value['nm_jenis_instansi'];?>"
    }
    <?php endforeach ?>
    /*{
      value: 500,
      color: "#00a65a",
      highlight: "#00a65a",
      label: "IE"
    },
    {
      value: 400,
      color: "#f39c12",
      highlight: "#f39c12",
      label: "FireFox"
    },
    {
      value: 600,
      color: "#00c0ef",
      highlight: "#00c0ef",
      label: "Safari"
    },
    {
      value: 300,
      color: "#3c8dbc",
      highlight: "#3c8dbc",
      label: "Opera"
    },
    {
      value: 100,
      color: "#d2d6de",
      highlight: "#d2d6de",
      label: "Navigator"
    }*/
  ];
</script>
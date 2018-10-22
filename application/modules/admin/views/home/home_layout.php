<style type="text/css">
  .pieLabel div{
    color: black!important;
  }
</style>
<div class="col col-md-12 col-sm-12 col-xs-12">
<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">Summary Report</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
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
    <a href="<?=site_url('admin/pengguna/list_dosen');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
    <a href="<?=site_url('admin/pengguna/list_mahasiswa');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-red">
    <div class="inner">
      <h3><?=$total_journal;?></h3>

      <p>Journal terdownload</p>
    </div>
    <div class="icon">
      <i class="fa fa-book"></i>
    </div>
    <a href="<?=site_url('admin/journal/report_download');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-purple">
    <div class="inner">
      <h3><?=$total_artikel;?></h3>

      <p>Artikel terdownload</p>
    </div>
    <div class="icon">
      <i class="fa fa-file"></i>
    </div>
    <a href="<?=site_url('admin/journal/report_download');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col col-md-6 col-sm-6 col-xs-12">
  <div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">Data Instansi</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <!-- <div class="chart-responsive">
          <canvas id="pieChart" height="200"></canvas>
        </div> -->
              <div id="donut-chart" style="height: 250px;"></div>
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
</div>
<!-- <script src="<?=base_url();?>assets/js/Chart.min.js"></script> -->
       <script src="<?=base_url();?>assets/admin-jur/plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?=base_url();?>assets/admin-jur/plugins/flot/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?=base_url();?>assets/admin-jur/plugins/flot/jquery.flot.pie.min.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="<?=base_url();?>assets/admin-jur/plugins/flot/jquery.flot.categories.min.js"></script>
<script type="text/javascript">
    var PieData = [
    <?php foreach ($daftar_instansi as $key => $value): ?>
      <?php if($key != 0){ echo ",";} ?>
    {
      value: <?=${$value['nm_jenis_instansi']};?>,
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
<script>
  $(function () {
    /*

     * DONUT CHART
     * -----------
     */
    

    var donutData = [
      {label: "<?=$daftar_instansi[0]['nm_jenis_instansi'];?>", data: <?=${$daftar_instansi[0]['nm_jenis_instansi']};?>, color: "#FEDEDE"},
      {label: "<?=$daftar_instansi[1]['nm_jenis_instansi'];?>", data: <?=${$daftar_instansi[1]['nm_jenis_instansi']};?>, color: "#FDBFBF"},
      {label: "<?=$daftar_instansi[2]['nm_jenis_instansi'];?>", data: <?=${$daftar_instansi[2]['nm_jenis_instansi']};?>, color: "#FC9898"},
      {label: "<?=$daftar_instansi[3]['nm_jenis_instansi'];?>", data: <?=${$daftar_instansi[3]['nm_jenis_instansi']};?>, color: "#FB8585"},
      {label: "<?=$daftar_instansi[4]['nm_jenis_instansi'];?>", data: <?=${$daftar_instansi[4]['nm_jenis_instansi']};?>, color: "#FA6666"},
      // {label: "Series6", data: 50, color: "#04598A"}

    ];
    $.plot("#donut-chart", donutData, {
      series: {
        pie: {
          show: true,
          radius: 1,
          innerRadius: 0.5,
          label: {
            show: true,
            radius: 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: true
      }
    });
    /*
     * END DONUT CHART
     */

  });

  /*
   * Custom Label formatter
   * ----------------------
   */
  function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
        + label
        + "<br>"
        + Math.round(series.percent) + "%</div>";
  }
</script>
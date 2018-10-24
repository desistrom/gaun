<style type="text/css">
  #cke_content{
    width: 100% !important;
  }
    .form-goup-file{
    height: auto;
    overflow: hidden;
    padding: 0;
  }
  .form-goup-file div{
    display: inline-block;
  }
  .form-goup-file .input-file-left{
    width: 100%;
  }
  .form-goup-file .input-file-left input{
  width: 100%;
  }
  .form-goup-file .input-file-right{
    position: absolute;
    left: 0;
    top: 0;
  }
  .form-goup-file .input-file-right .btn-choose-foto{
    height: 34px;
    width: 105px;
    border-radius: 0;
    padding-left: 7px;
  }
  .logo-fav{
    width: 100px;
  }
  .fa-upload{
    padding-right: 10px;
  }
  .flot {
    left: 0px;
    top: 0px;
    width: 610px;
    height: 250px;
}
#flotTip {
    padding: 3px 5px;
    background-color: #000;
    z-index: 100;
    color: #fff;
    opacity: .80;
    filter: alpha(opacity=85);
}
</style>

<?php if ($view == 'list') { ?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">
<div class="col col-md-12 col-sm-12 col-xs-12">
  <h3 class="box-title">Report Download</h3>

</div>
<div class="col col-md-6 col-sm-6 col-s-6" style="margin-bottom: 20px;">
  <div class="box box-warning" >
    <div class="box-header with-border">
          <i class="fa fa-bar-chart-o"></i>

          <h3 class="box-title">Grafik Download Journal</h3>

        </div>
    <div class="box-body">
      <div <?php if($sum_journal['total_download'] != 0){ ?>id="donut-chart" style="height: 250px;" <?php } ?>>
        <?php if($sum_journal['total_download'] == 0){ ?>
          <div class="alert alert-warning btn-bg"><h3><center>Tidak ada journal yang didownload</center></h3></div>
        <?php } ?>
      </div>
    </div>
  </div>

</div>
<div class="col col-md-6 col-sm-6 col-s-6" style="margin-bottom: 20px;">
  <div class="box box-warning" >
    <div class="box-header with-border">
          <i class="fa fa-bar-chart-o"></i>

          <h3 class="box-title">Grafik Download Artikel</h3>

        </div>
    <div class="box-body">
      <div <?php if($sum_artikel['total_download'] != 0){ ?> id="donut-chart-2" style="height: 250px;" <?php } ?>>
        <?php if($sum_artikel['total_download'] == 0){ ?>
          <div class="alert alert-warning btn-bg"><h3><center>Tidak ada artikel yang didownload</center></h3></div>
        <?php } ?>
      </div>
    </div>
  </div>

</div>
<div class="col col-md-12 col-sm-12 col-xs-12">
  
<div class="box  box-warning">
  <div class="box-header with-border">
    <i class="fa fa-bar-chart-o"></i>

    <h3 class="box-title">List Journal Download</h3>

  </div>
  <div class="box-body">
    <div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
    </div>
    <div class="col col-md-12 col-xs-12 table-responsive">
      <table class="table table-bordered  dataTable" id="table">
        <thead>
          <th>No.</th>
          <th>Journal</th>
          <th>ISSN</th>
          <th>Total Download</th>
          <th>Publisher</th>
          <th>Action</th>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
  
<?php } ?>
<div class="modal" tabindex="-1" role="dialog" id="modal_comment">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Success</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="progresLoading" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-body">
                  <div class="box box-danger">
                      <div class="box-header">
                      </div>
                      <div class="box-body">
                      </div>
                      <div class="overlay">
                        <i class="fa fa-refresh fa-spin"></i>
                      </div>
                  </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- <script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script> -->
<script src="<?=base_url();?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/datatables/js/dataTables.bootstrap.min.js"></script>
       <script src="<?=base_url();?>assets/admin-jur/plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?=base_url();?>assets/admin-jur/plugins/flot/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?=base_url();?>assets/admin-jur/plugins/flot/jquery.flot.pie.min.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="<?=base_url();?>assets/admin-jur/plugins/flot/jquery.flot.categories.min.js"></script>
<script src="<?=base_url();?>assets/admin-jur/plugins/flot/flot-tooltip.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','.btn-acc', function(){
      var id = $(this).attr('id');
      $('#modalacc #id').val(id);
      $('#modalacc').modal('show');
    });

    $('body').on('click','.btn-ign', function(){
      var id = $(this).attr('id');
      $('#modalign #id').val(id);
      $('#modalign').modal('show');
    });
    $('#modalSuccess').modal('show');
  });
</script>
<script type="text/javascript">
 
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('user/journal/ajax_list_journal_download')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
});
</script>
<?php if($sum_journal['total_download'] != 0){ ?>
<script>
  $(function () {
    /*

     * DONUT CHART
     * -----------
     */

    var donutData = [
      {label: "<?php echo $sum_journal['nama_1']; ?>", data: <?php echo $sum_journal['download_1']; ?>, color: "#FCE6D6"},
      {label: "<?php echo $sum_journal['nama_2']; ?>", data: <?php echo $sum_journal['download_2']; ?>, color: "#FAD2B6"},
      {label: "<?php echo $sum_journal['nama_3']; ?>", data: <?php echo $sum_journal['download_3']; ?>, color: "#F3A065"},
      {label: "<?php echo $sum_journal['nama_4']; ?>", data: <?php echo $sum_journal['download_4']; ?>, color: "#F08940"},
      {label: "<?php echo $sum_journal['nama_5']; ?>", data: <?php echo $sum_journal['download_5']; ?>, color: "#E06812"},
      {label: "Anonymus", data: <?php echo $sum_journal['anonym']; ?>, color: "#C85D10"}

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
         grid: {
        hoverable: true
    },
    tooltip: true,
    tooltipOpts: {
        cssClass: "flotTip",
        content: "%s: %p.0%",
        defaultTheme: false
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
<?php } ?>
<?php if($sum_artikel['total_download'] != 0){ ?>
<script>
  $(function () {
    /*
     * Flot Interactive Chart
     * -----------------------

     * DONUT CHART
     * -----------
     */
     // //// warna 
    /* color: "#FCE6D6"
      color: "#FAD2B6"
      color: "#F3A065"
      color: "#F08940"
      color: "#E06812"*/
    var donutData = [
      {label: "<?php echo $sum_artikel['nama_1']; ?>", data: <?php echo $sum_artikel['download_1']; ?>, color: "#FCE6D6"},
      {label: "<?php echo $sum_artikel['nama_2']; ?>", data: <?php echo $sum_artikel['download_2']; ?>, color: "#FAD2B6"},
      {label: "<?php echo $sum_artikel['nama_3']; ?>", data: <?php echo $sum_artikel['download_3']; ?>, color: "#F3A065"},
      {label: "<?php echo $sum_artikel['nama_4']; ?>", data: <?php echo $sum_artikel['download_4']; ?>, color: "#F08940"},
      {label: "<?php echo $sum_artikel['nama_5']; ?>", data: <?php echo $sum_artikel['download_5']; ?>, color: "#E06812"},
      {label: "Anonymus", data: <?php echo $sum_artikel['anonym']; ?>, color: "#C85D10"}

    ];
    $.plot("#donut-chart-2", donutData, {
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
            grid: {
        hoverable: true
    },
    tooltip: true,
    tooltipOpts: {
        cssClass: "flotTip",
        content: "%s: %p.0%",
        defaultTheme: false
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
<?php } ?>
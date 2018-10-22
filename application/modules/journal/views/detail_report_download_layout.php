<style type="text/css">
  .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{
    border-top: 1px solid white;
  }  
  .pieLabel div{
    color: black!important;
  }
</style>
<div class="col col-md-12 col-sm-12 col-xs-12">
 <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik download artikel</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="padding:15px  0;">
              <div class="col col-md-6 col-sm-7 col-xs-12">
                <table class="table " style="margin-top: 0;">
                <tbody>
                <tr>
            
                  <td><?php echo $artikel['nama_1']; ?> : <?php echo $artikel['download_1']; ?> </td>
               
                </tr>
                <tr>
              
                  <td><?php echo $artikel['nama_2']; ?> : <?php echo $artikel['download_2']; ?></td>
                 
                </tr>
               
                <tr>
             
                  <td><?php echo $artikel['nama_3']; ?> : <?php echo $artikel['download_3']; ?></td>
                  
                </tr>
                <tr>
             
                  <td><?php echo $artikel['nama_4']; ?> : <?php echo $artikel['download_4']; ?></td>
                  
                </tr>
                <tr>
             
                  <td><?php echo $artikel['nama_5']; ?> :<?php echo $artikel['download_5']; ?> </td>
                  
                </tr>
                <tr>
             
                  <td>Anonymus :<?php echo $artikel['anonym']; ?> </td>
                  
                </tr>
                 <tr>
             
                  <td><b>Total download : <?php echo $artikel['total']; ?> </b></td>
                  
                </tr>
         
              </tbody></table>
              </div>
              <div class="col col-md-5 col-sm-5 col-xs-12">
                      <!-- Donut chart -->
                  
                      <div id="donut-chart" style="height: 250px;"></div>

            </div>
            <!-- /.box-body -->
         
          </div>
  </div>
</div>
<!-- <div class="col col-md-12 col-sm-12 col-xs-12">
 <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Detail download artikel Abtrak</h3>
            </div>

            <div class="box-body" style="padding:15px  0;">
              <div class="col col-md-6 col-sm-7 col-xs-12">
                <table class="table " style="margin-top: 0;">
                <tbody>
                <tr>
            
                  <td><?php echo $artikel['namaabs_1']; ?> : <?php echo $artikel['downloadabs_1']; ?> </td>
               
                </tr>
                <tr>
              
                  <td><?php echo $artikel['namaabs_2']; ?> : <?php echo $artikel['downloadabs_2']; ?></td>
                 
                </tr>
               
                <tr>
             
                  <td><?php echo $artikel['namaabs_3']; ?> : <?php echo $artikel['downloadabs_3']; ?></td>
                  
                </tr>
                <tr>
             
                  <td><?php echo $artikel['namaabs_4']; ?> : <?php echo $artikel['downloadabs_4']; ?></td>
                  
                </tr>
                <tr>
             
                  <td><?php echo $artikel['namaabs_5']; ?> :<?php echo $artikel['downloadabs_5']; ?> </td>
                  
                </tr>
                <tr>
             
                  <td>Anonymus :<?php echo $artikel['anonym_abs']; ?> </td>
                  
                </tr>
                 <tr>
             
                  <td><b>Total download : <?php echo $artikel['total_abs']; ?> </b></td>
                  
                </tr>
         
              </tbody></table>
              </div>
              <div class="col col-md-5 col-sm-5 col-xs-12">

                  
                      <div id="donut-chart-abs" style="height: 250px;"></div>

            </div>
 
         
          </div>
  </div>
</div>
 -->
<!-- Page script -->
       <script src="<?=base_url();?>assets/admin-jur/plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?=base_url();?>assets/admin-jur/plugins/flot/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?=base_url();?>assets/admin-jur/plugins/flot/jquery.flot.pie.min.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="<?=base_url();?>assets/admin-jur/plugins/flot/jquery.flot.categories.min.js"></script>

<script>
  $(function () {
    /*

     * DONUT CHART
     * -----------
     */

    var donutData = [
      {label: "<?php echo $artikel['nama_1']; ?>", data: <?php echo $artikel['download_1']; ?>, color: "#BCF4B2"},
      {label: "<?php echo $artikel['nama_2']; ?>", data: <?php echo $artikel['download_2']; ?>, color: "#7CE969"},
      {label: "<?php echo $artikel['nama_3']; ?>", data: <?php echo $artikel['download_3']; ?>, color: "#238012"},
      {label: "<?php echo $artikel['nama_4']; ?>", data: <?php echo $artikel['download_4']; ?>, color: "#4EE135"},
      {label: "<?php echo $artikel['nama_5']; ?>", data: <?php echo $artikel['download_5']; ?>, color: "#35C41C"},
      {label: "Anonymus", data: <?php echo $artikel['anonym']; ?>, color: "#04598A"}

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
     var donutDataAbs = [
      {label: "<?php echo $artikel['namaabs_1']; ?>", data: <?php echo $artikel['downloadabs_1']; ?>, color: "#BCF4B2"},
      {label: "<?php echo $artikel['namaabs_2']; ?>", data: <?php echo $artikel['downloadabs_2']; ?>, color: "#7CE969"},
      {label: "<?php echo $artikel['namaabs_3']; ?>", data: <?php echo $artikel['downloadabs_3']; ?>, color: "#238012"},
      {label: "<?php echo $artikel['namaabs_4']; ?>", data: <?php echo $artikel['downloadabs_4']; ?>, color: "#4EE135"},
      {label: "<?php echo $artikel['namaabs_5']; ?>", data: <?php echo $artikel['downloadabs_5']; ?>, color: "#35C41C"},
      {label: "Anonymus", data: <?php echo $artikel['anonym_abs']; ?>, color: "#04598A"}

    ];
    $.plot("#donut-chart-abs", donutData, {
      series: {
        pie: {
          show: true,
          radius: 1,
          innerRadius: 0.5,
          label: {
            show: true,
            radius: 2 / 3,
            formatter: labelFormatterAbs,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: true
      }
    });

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

  function labelFormatterAbs(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
        + label
        + "<br>"
        + Math.round(series.percent) + "%</div>";
  }
</script>
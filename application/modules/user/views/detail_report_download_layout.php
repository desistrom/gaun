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
              <h3 class="box-title">Detail download artikel</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="padding:15px  0;">
              <div class="col col-md-6 col-sm-7 col-xs-12">
                <table class="table " style="margin-top: 0;">
                <tbody>
                <tr>
            
                  <td>Universitas : 10 </td>
               
                </tr>
                <tr>
              
                  <td>Media : 10</td>
                 
                </tr>
               
                <tr>
             
                  <td>Community : 10</td>
                  
                </tr>
                <tr>
             
                  <td>Goverment : 20</td>
                  
                </tr>
                <tr>
             
                  <td>Business :20 </td>
                  
                </tr>
                 <tr>
             
                  <td><b>Total download : 70 </b></td>
                  
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
            {label: "Universitas", data: 10, color: "#FDECDF"},
      {label: "Media", data: 10, color: "#FAD1B2"},
      {label: "Community", data: 10, color: "#8172022"},
      {label: "Goverment", data: 20, color: "#F39B57"},
      {label: "Business", data: 20, color: "#F07E26"},
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
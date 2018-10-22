<style type="text/css">
  .btn-download-front{
    position: absolute;
    z-index: 100;
    top: 10px;
    right: 10px;
    padding: 5px 9px;
    border-radius: 50%;
  }
</style>
<?php if(count($journal) == 0){
	?> <div class="jumbotron">
	<h2 style="color: #A8A8A8;text-align: center;">Data Not found</h2>
</div>  <?php 
}
?>
<div class="add-data">
<?php foreach ($journal as $key => $value): ?>
	<div class="col col-md-2 col-sm-4 col-xs-12 filter-box-jurnal" >
		<div class="box-jurnal" >
      <a href="#" class="btn btn-warning btn-download-front" alt="download" title="download"><i class="fa fa-download"></i></a>
			<div class="box-header">
				<!-- <div class="filter-lighten" style="background-color: green;height: 20px;width: 100%;">
					
				</div> -->
				<img class="img-responsive thumbnail-jurnal" src="<?=base_url();?>assets/media/<?=$value['futured_image'];?>">
			</div>
			<div class="box-body">
				<h5><a href="<?=site_url('journal/detail_journal/'.$value['slug']);?>"><?=$value['judul'];?></a></h5>
				<h5>Jumlah Volume : <?=$value['jumlah'];?></h5>
				<!-- <h5>2016 - 12</h5> -->
			</div>
			<a href="<?=site_url('journal/detail_journal/'.$value['slug']);?>" class="link_detail"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
      <!-- <div class="box-footer"> -->
        
      <!-- </div> -->
		</div>
	</div>
<?php endforeach ?>
</div>
<div class="col col-md-12 col-sm-12 col-xs-12 text-center" style="padding: 20px 15px;">
              	<button class="btn btn-danger btn-bg"> Load More</button>
              </div>
<input type="hidden" name="limit" id="limit" value="12">
<input type="hidden" name="ofset" id="ofset" value="12">
<script src="<?=base_url();?>mockup_statis/assets/js/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','.btn-bg',function(){
      var limit = $('#limit').val();
      var ofset = $('#ofset').val();
      var set = parseInt(limit) + parseInt(ofset);
      $.ajax({
        url : base_url+'journal/loadmore/'+limit+'/'+ofset,
        dataType : 'json'
      }).done(function(data){
        $('.add-data').append(data);
        if (data == '') {
          $('.btn-bg').text('No More data found');
        }
        $('#limit').val(set);
      });
    });

    function get_url(url){
      return url.split('/').pop()
    }

    //a step by step breakdown
    function getImageDirectoryByFullURL(url){
        url = url.split('/'); //url = ["serverName","app",...,"bb65efd50ade4b3591dcf7f4c693042b"]
        url = url.pop();      //url = "bb65efd50ade4b3591dcf7f4c693042b"
        return url;           //return "bb65efd50ade4b3591dcf7f4c693042b"
    }
  });
</script>
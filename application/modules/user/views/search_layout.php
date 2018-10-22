<style type="text/css">
	.sub-date{
		display: inline-block;
		/*width: 100px;*/
	}
	.form-search{
		margin-bottom: 15px;
	}
	.sec-search{
		padding: 2em 15px;
		background-color: #CBCBCB;
	}
	.sec-accordion{
		padding: 3em 3em;
	}
	.sec-accordion .panel-heading{
		padding: 1.5em;
		background-color: #E1E1E1;
		border-radius: 20px;
		border:none;
	}
	.sec-accordion .panel-heading h4{
		font-size: 24px;
		font-weight: 600;
		color: #5B5D5C;

	}
	.panel-default{
		border:none;
	}
	.panel-default>.panel-heading+.panel-collapse>.panel-body{
		border:white;
	}
	.box-header{
		height: 150px;
		padding: 15px 0;
		overflow: hidden;
		text-align: center;
	}
	.box-body{
		padding: 0 ;

	}
	.box-body-left{
		background-color: yellow;
		padding: 15px;
	}
	.box-body-left h4{
		padding-left: 20px;
	}
		.box-body{
		border-bottom-left-radius: 20px;
	    height: auto;
	    overflow: hidden;
	    border-bottom-right-radius: 20px;
	}
	.img-logo{
		border-top-left-radius: 20px;
	    border-top-right-radius: 20px;
	    display: inline-block;
    width: 120px;
	}
	a:hover, a:active, a:focus{
		color: #EF7314;
	}


</style>
<div class="col col-md-12 col-sm-12 col-xs-12 sec-search ">
	<form>
		
		<div class="col col-md-5 col-sm-6 col-xs-12">
			<div class="form-group">
		        <div class="form-search"><label>Date</label></div>
		        <div class="sub-date">
		        	<input type="date" name="start" class="form-control" >
		        </div>
		        <span style="padding: 0 5px;"> To </span>
		        <div class="sub-date">
		        	<input type="date" name="end" class="form-control" >
		        </div>
		        <div class="error" id="ntf_volume"></div>
		      </div>
		</div>
		<div class="col col-md-3 col-sm-6 col-xs-12">
			<div class="form-group">
		        <div class="form-search"><label>Kategori</label></div>
		   		<select class="form-control " name="kategori" id="kategori">
		   			<option value="">-- Kategori --</option>
		   			<?php foreach ($kategori as $key => $value): ?>
		   				<option value="<?=$value['id_kategori'];?>"><?=$value['nama'];?></option>
		   			<?php endforeach ?>
		   		</select>
		        <div class="error" id="ntf_kategori"></div>
		     </div>
		</div>
		<div class="col col-md-3 col-sm-6 col-xs-12">
			<div class="form-group">
		        <div class="form-search"><label>Title</label></div>
		   		<input type="text" name="search" class="form-control" id="search">
		        <div class="error" id="ntf_title"></div>
		     </div>
		     <div class="form-group">
		     	<button class="btn btn-warning btn-bg" style="float: right;">Submit</button>
		     </div>
		</div>
	</form>
	
</div>
<div class="col col-md-12 col-sm-12 col-xs-12 sec-accordion">
	<div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="width: 100%;">Journal Nasional<i class="fa fa-angle-down" style="float: right;"></i></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">
        	<?php foreach ($journal as $key => $value): ?>
	        	<div class="col col-md-4 col-sm-4 col-xs-12 filter-box">
	        	<div class="box-search" style="border:solid 1px #D2D2D2;border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;overflow: hidden;">
	        			<div class="box-header" >
	        			<img src="<?=base_url();?>media/<?=$value['gambar']?>" class="img-responsive img-logo">
	        		</div>
	        		<div class="box-body">
	        			<div class="col col-md-9 col-sm8 col-xs-7 none-padding box-body-left">
	        				<h4><a href="<?php echo site_url('user/journal/detail_search/'.$value['id_instansi']);?>"><?=$value['nm_instansi']?><a/</h4>
	        			</div>
	        			<div class="col col-md-3 col-sm-4 col-xs-5 none-padding">
	        				<h4 class="text-center"><?=$value['jumlah'];?></h4>
	        			</div>
	        		</div>
	        	</div>
	        	</div>        		
        	<?php endforeach ?>
        </div>
      </div>
    </div>
    <!-- <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="width: 100%;">Journal Internasional <i class="fa fa-angle-down" style="float: right;"></i></a>
          
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
        	<div class="col col-md-4 col-sm-4 col-xs-12 filter-box">
        		<div class="box-header">
        			<img src="http://192.168.88.15/idren/assets/media/1539161415.jpg" class="img-responsive img-logo">
        		</div>
        		<div class="box-body">
        			<div class="col col-md-9 col-sm8 col-xs-7 none-padding box-body-left">
        				<h4>Universitas Indonesia</h4>
        			</div>
        			<div class="col col-md-3 col-sm-4 col-xs-5 none-padding">
        				<h4 class="text-center">150</h4>
        			</div>
        		</div>
        	</div>
        	<div class="col col-md-4 col-sm-4 col-xs-12 filter-box">
        		<div class="box-header">
        			<img src="http://192.168.88.15/idren/assets/media/1539161415.jpg" class="img-responsive img-logo">
        		</div>
        		<div class="box-body">
        			<div class="col col-md-9 col-sm-8 col-xs-7 none-padding box-body-left" style="background-color: blue;color: white;">
        				<h4>Universitas Indonesia</h4>
        			</div>
        			<div class="col col-md-3 col-sm-4 col-xs-5 none-padding">
        				<h4 class="text-center">150</h4>
        			</div>
        		</div>
        	</div>
        </div>
      </div>
    </div> -->
  
  </div> 

</div>
<script type="text/javascript">
      $(document).ready(function() {
        $('body').on('click','.btn-search',function(){
          console.log('hmm');
          var search = $('#search').val();
          window.location.href = base_url+'user/journal/search/'+search;
        });
      });
  $('#modalSuccess').modal('show');
</script>
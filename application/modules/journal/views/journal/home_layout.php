<?php if(count($journal) == 0){
	?> <div class="jumbotron">
	<h2 style="color: #A8A8A8;text-align: center;">Data Not found</h2>
</div>  <?php 
}
?>

<?php foreach ($journal as $key => $value): ?>
	<div class="col col-md-2 col-sm-4 col-xs-12 filter-box-jurnal" >
		<div class="box-jurnal" >
			<div class="box-header">
				<!-- <div class="filter-lighten" style="background-color: green;height: 20px;width: 100%;">
					
				</div> -->
				<img class="img-responsive thumbnail-jurnal" src="<?=base_url();?>assets/media/<?=$value['futured_image'];?>">
			</div>
			<div class="box-body">
				<h5><a href="<?=site_url('journal/detail_journal/'.$value['id_journal']);?>"><?=$value['judul'];?></a></h5>
				<h5>Jumlah Volume : <?=$value['jumlah'];?></h5>
				<!-- <h5>2016 - 12</h5> -->
			</div>
			<a href="detail.html" class="link_detail"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
		</div>
	</div>
<?php endforeach ?>
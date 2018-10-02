<?php foreach ($journal as $key => $value): ?>
	<div class="col col-md-2 col-sm-4 col-xs-12 filter-box-jurnal" >
		<div class="box-jurnal" >
			<div class="box-header">
				<!-- <div class="filter-lighten" style="background-color: green;height: 20px;width: 100%;">
					
				</div> -->
				<img class="img-responsive thumbnail-jurnal" src="<?=base_url();?>assets/media/<?=$value['futured_image'];?>">
			</div>
			<div class="box-body">
				<h5><a href="detail.html"><?=$value['judul'];?></a></h5>
				<h5>Jumlah Volume : <?=$value['jumlah'];?></h5>
				<!-- <h5>2016 - 12</h5> -->
			</div>
			<a href="detail.html" class="link_detail"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
		</div>
	</div>
<?php endforeach ?>
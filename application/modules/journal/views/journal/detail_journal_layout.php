		<section class="content-page detail-jurnal col-md-12 col-sm-12 col-xs-12 none-padding">
			<div class="container-fluid">
				

					<div class="row">
<div class="col col-md-12 col-sm-12 col-xs-12 none-padding content-wrap">
	<div class="col col-ms-12 col-sm-12 col-xs-12">
		<h4 class="title-content-wrap">Table Of Content <?=$journal[0]['judul'];?></h4>
	</div>
	<div class="col col-md-3 col-sm-4 col-xs-12 right-content-wrap">
		<div class="flter-side-bar">
			<div class="sidebar">
				<h4>About <?=$journal[0]['judul'];?></h4>
				<div class="line-sidebar-title">
					
				</div>
				<ul class="list-unstyled">
						
					</ul>
			</div>
			<div class="sidebar">
				<h4>Last Update</h4>
				<div class="line-sidebar-title">
					
				</div>
				<ul class="list-unstyled">
					<?php foreach ($last as $key => $value): ?>
						<li>
							<a href="<?=site_url('journal/detail_journal/'.$value['slug']);?>"><?=$value['judul'];?></a>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="col col-md-9 col-sm-8 col-xs-12 left-content-wrap ">
		<div class="col col-md-3 col-sm-4 col-xs-12 sub-left-content none-padding">
			<div class="filter-cover-jurnal">
				<img src="<?=base_url();?>assets/media/<?=$journal[0]['futured_image'];?>" class="cover-jurnal-img">
			</div>
		</div>
		<div class="col col-md-9 col-sm-8 col-xs-12 sub-right-content">
			<h4><?=$journal[0]['judul'];?></h4>
			<div class="line-sub-title-jurnal"></div>
			<ul class="list-unstyled list-info-jurnal">
				<li><?=$journal[0]['issn'];?></li>
				<!-- <li>Volume 5 / Nomor : 1 / Published : 2016-12</li> -->
			</ul>
			<ul class="list-unstyled list-detail-jurnal">
				<?php foreach ($journal as $key => $value): ?>
					<li><a href="<?=site_url('journal/detail_volume/'.$value['id_volume']);?>">
						<span>Volume </span> <?=$value['volume'];?></a></li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>
</div>
</div>
</div></section>
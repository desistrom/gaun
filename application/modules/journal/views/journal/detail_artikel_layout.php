<div class="col col-md-12 col-sm-12 col-xs-12 none-padding content-wrap">
	<div class="col col-ms-12 col-sm-12 col-xs-12">
		<h4 class="title-content-wrap">Table Of Content JPPP</h4>
	</div>
	<div class="col col-md-3 col-sm-4 col-xs-12 right-content-wrap">
		<div class="flter-side-bar">
			<!-- <div class="sidebar">
				<h4>About JPPP</h4>
				<div class="line-sidebar-title">
					
				</div>
				<ul class="list-unstyled">
						<li>
							<a href="#">About</a>
						</li>
						<li>
							<a href="#">Contact</a>
						</li>
						<li>
							<a href="#">Editor Team</a>
						</li>
					</ul>
			</div> -->
			<div class="sidebar">
				<h4>LAst Update</h4>
				<div class="line-sidebar-title">
					
				</div>
				<ul class="list-unstyled">
						<?php foreach ($last as $key => $value): ?>
						<li>
							<a href="<?=site_url('journal/detail_journal/'.$value['id_journal']);?>"><?=$value['judul'];?></a>
						</li>
					<?php endforeach ?>
					</ul>
			</div>
		</div>
	</div>
	<div class="col col-md-9 col-sm-8 col-xs-12 left-content-wrap ">
		<h4><?=$journal['journal'];?></h4>
			<div class="line-sub-title-jurnal"></div>
			<ul class="list-unstyled list-info-jurnal">
				<li><?=$journal['issn'];?></li>
				<li>Volume <?=$journal['volume'];?>/ Nomor : <?=$journal['nomor'];?> / Published : <?=$journal['publish'];?></li>
			</ul>

			<h4 class="title-sub-detail-jurnal">Original Article</h4>
			<div class="  line-sub-title-jurnal"></div>
			<ul class="list-unstyled list-info-jurnal">
				<li> <?=$journal['judul'];?></li>
			
			</ul>

			<h4 class="title-sub-detail-jurnal">Author</h4>
			<div class="  line-sub-title-jurnal"></div>
			<ul class="list-unstyled list-info-jurnal">
				<?php foreach ($author as $key => $value): ?>
					<li><?=$value['nama'];?></li>
					<li><?=$value['jabatan'];?></li>
					<br>
				<?php endforeach ?>
				

			</ul>

			<h4 class="title-sub-detail-jurnal">Abstract</h4>
			<div class="  line-sub-title-jurnal"></div>
			<ul class="list-unstyled list-info-jurnal">
				<li style="text-align: justify;"><?=$journal['abstrak'];?>.</li>

			
			</ul>
			<h4 class="title-sub-detail-jurnal">Keyword</h4>
			<div class="  line-sub-title-jurnal"></div>
			<ul class="list-unstyled list-info-jurnal">
				<li><?=$journal['keyword'];?></li>

			
			</ul>


			<h4 class="title-sub-detail-jurnal">References</h4>
			<div class="  line-sub-title-jurnal"></div>
			<ul class="list-unstyled list-info-jurnal">
				<li><?=$journal['references'];?></li>

			
			</ul>

			<div class="filter-btn-download">
				<?php if($journal['abstract_file'] != ''){?> 
				<div class="inline-block"><a href="<?=site_url('journal/downloads_abs/'.$journal['id_artikel']);?>" class="btn btn-danger btn-abstract-download">Abstract Download </a></div>
				<?php }?>
				<?php if($journal['file'] != ''){?> 
				<div class="inline-block"><a href="<?=site_url('journal/downloads/'.$journal['id_artikel']);?>" class="btn btn-danger btn-download">Download</a></div>
				<?php }?>
			</div>




			<h4 class="title-sub-detail-jurnal" style="margin-top: 3em;">Archieve Article</h4>
			<div class="  line-sub-title-jurnal" style="margin-bottom: 2em;"></div>
			<div class="col col-md-3 col-sm-4 col-xs-12 sub-left-content none-padding">
			<div class="filter-cover-jurnal">
				<img src="<?=base_url();?>assets/media/<?=$no_vol[0]['futured_image'];?>" class="cover-jurnal-img">
			</div>
		</div>
		<div class="col col-md-9 col-sm-8 col-xs-12 sub-right-content">
			<h4><?=$no_vol[0]['judul'];?></h4>
			<div class="line-sub-title-jurnal"></div>
			<ul class="list-unstyled list-info-jurnal" style="margin-bottom: 1em;">
				<!-- <li>ISSN : 2301-7104</li> -->
				<li>Volume <?=$no_vol[0]['volume'];?> / Nomor : <?=$no_vol[0]['nomor'];?> / Published : <?=$no_vol[0]['publish'];?></li>
			</ul>
			<ul class="list-unstyled list-detail-jurnal">
				<?php foreach ($no_vol as $key => $value): ?>
					<li><a href="<?=site_url('journal/detail_artikel/'.$value['id_artikel']);?>">
						<span><?=($key+1);?> . </span><?=$value['artikel']?>
					</a></li>
				<?php endforeach ?>
				
				
				

			</ul>
		</div>

		



		
	</div>
</div>
<style type="text/css">
	/*sub-detail*/ 
	.line-sub-title-jurnal {
    margin: 15px 0;
    width: 150px;
    height: 3px;
    background-color: #A2A2A2;
}
.bg-red {
    background-color: #D10909;
    background: #D10909;
}
	.title-sub-detail-jurnal{
  font-weight: 600;
  margin-top: 10px;
  font-size: 16px;
}
.list-info-jurnal li{
  padding: 4px 0;
  color: #A2A2A2;
}
/*.sub-detail-jurnal .list-info-jurnal li {
   color: #D10909;
}*/
.list-info-jurnal{
  margin-bottom: 3em;
}
.inline-block{
  display: inline-block;
}
.btn-download,
.btn-abstract-download{
  padding: 1em 3em;
  background:#EF7314;
  margin-right: 15px;
}
.list-detail-jurnal li a{
    color: #A2A2A2;
}
.line-sub-title-jurnal{
	width: 80px;
}
</style>
<div class="col col-md-10 col-sm-10 col-xs-12 right-content" style="">
    <div class=" title-box">
		<h3 class="title">Detail Artikel</h3>
    </div>
    <div class="box-content">
    	<div class="row">
    	     <div class="col col-md-12 col-sm-12 col-xs-2">
    	     	<h4 class="text-red title-sub-detail-jurnal"><?=$artikel['journal'];?></h4>
									<div class=" btn-bg line-sub-title-jurnal"></div>
									<ul class="list-unstyled list-info-jurnal">
										<li>ISSN : <?=$artikel['issn'];?></li>
										<li>Volume <?=$artikel['volume'];?> / Nomor : <?=$artikel['nomor'];?> / Published : <?=$artikel['publish'];?></li>
										<!-- <li>TOC : 2, and page :9 - 17</li> -->
										<!-- <li>Related with : <span class="text-red">Schoolar</span>,<span class="text-red">yahoo</span>,<span class="text-red">Bing</span></li> -->
									</ul>

									<h4 class="title-sub-detail-jurnal">Original Article</h4>
									<div class="  line-sub-title-jurnal"></div>
									<ul class="list-unstyled list-info-jurnal">
										<li><?=$artikel['judul'];?></li>
									
									</ul>

									<h4 class="title-sub-detail-jurnal">Author</h4>
									<div class="  line-sub-title-jurnal"></div>
									<ul class="list-unstyled list-info-jurnal">
									<?php foreach ($author as $key => $value): ?>
										<li><?=$value['nama'];?></li>
										<li><span><?=$value['jabatan'];?></span></li>
									<?php endforeach ?>
									
									</ul>

									<h4 class="title-sub-detail-jurnal">Abstract</h4>
									<div class="  line-sub-title-jurnal"></div>
									<ul class="list-unstyled list-info-jurnal">
										<li><?=$artikel['abstrak'];?></li>
						
									
									</ul>
									<h4 class="title-sub-detail-jurnal">Keyword</h4>
									<div class="  line-sub-title-jurnal"></div>
									<ul class="list-unstyled list-info-jurnal">
										<li><?=$artikel['keyword'];?></li>
						
									
									</ul>


									<h4 class="title-sub-detail-jurnal">References</h4>
									<div class="  line-sub-title-jurnal"></div>
									<ul class="list-unstyled list-info-jurnal">
										<li><?=$artikel['references'];?></li>
						
									
									</ul>

									<div class="filter-btn-download">
										<?php if($artikel['abstract_file'] != ''){?> 
										<div class="inline-block"><a href="<?=site_url('user/journal/downloads_abs/'.$artikel['id_artikel']);?>" class="btn btn-warning btn-bg btn-abstract-download">Abstract Download </a></div>
										<?php }?>
										<?php if($artikel['file'] != ''){?> 
										<div class="inline-block"><a href="<?=site_url('user/journal/downloads/'.$artikel['id_artikel']);?>" class="btn btn-warning btn-bg btn-download">Download</a></div>
										<?php }?>
									</div>




									<h4 class="title-sub-detail-jurnal" style="margin-top: 3em;">Archieve Article</h4>
									<div class="  line-sub-title-jurnal" style="margin-bottom: 2em;"></div>
									<div class="col col-md-3 col-sm-4 col-xs-12 sub-left-content none-padding">
									<div class="filter-cover-jurnal">
										<img src="<?=base_url();?>assets/media/<?=$artikel['futured_image'];?>" class="cover-jurnal-img" style="width: 100%;">
									</div>
								</div>
								<div class="col col-md-9 col-sm-8 col-xs-12 sub-right-content">
									<h4><?=$artikel['journal'];?></h4>
									<div class="line-sub-title-jurnal"></div>
									<ul class="list-unstyled list-info-jurnal" style="margin-bottom: 1em;">
										<li>ISSN : <?=$artikel['issn'];?></li>
										<li>Volume <?=$artikel['volume'];?> / Nomor : <?=$artikel['nomor'];?> / Published : <?=$artikel['publish'];?></li>
									</ul>
									<ul class="list-unstyled list-detail-jurnal">
										<?php foreach ($no_vol as $key => $value): ?>
						                    <li><a href="<?=site_url('user/journal/detail_artikel/'.$value['id_artikel']); ?>">
						                      <!-- <?=site_url('user/journal/detail_artikel/'.$value['id_artikel']);?> -->
						                      Artikel : <?=$value['artikel'];?>
						                    </a></li>
						                <?php endforeach ?>
										
										

									</ul>
								</div>
    	     </div>
    	 </div>
    </div>
</div>
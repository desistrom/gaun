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
  background:#D10909;
  margin-right: 15px;
}
.list-detail-jurnal li a{
    color: #A2A2A2;
}
</style>
<div class="col col-md-10 col-sm-10 col-xs-12 right-content" style="">
    <div class=" title-box">
		<h3 class="title">Detail Volume</h3>
    </div>
    <div class="box-content">
    	<div class="row">
    	     <div class="col col-md-12 col-sm-12 col-xs-2">
    	     	<h4 class="text-red title-sub-detail-jurnal"><?=$artikel['journal'];?></h4>
									<div class=" bg-red line-sub-title-jurnal"></div>
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
										<div class="inline-block"><a href="#" class="btn btn-danger btn-abstract-download">Abstract Download </a></div>
										<div class="inline-block"><a href="<?=site_url('assets/file/'.$artikel['file']);?>" class="btn btn-danger btn-download">Download</a></div>
									</div>




									<h4 class="title-sub-detail-jurnal" style="margin-top: 3em;">Archieve Article</h4>
									<div class="  line-sub-title-jurnal" style="margin-bottom: 2em;"></div>
									<div class="col col-md-3 col-sm-4 col-xs-12 sub-left-content none-padding">
									<div class="filter-cover-jurnal">
										<img src="assets/img/jur-1.jpg" class="cover-jurnal-img">
									</div>
								</div>
								<div class="col col-md-9 col-sm-8 col-xs-12 sub-right-content">
									<h4>Jurnal Psikologi Pendidikan dan Perkembangan</h4>
									<div class="line-sub-title-jurnal"></div>
									<ul class="list-unstyled list-info-jurnal" style="margin-bottom: 1em;">
										<li>ISSN : 2301-7104</li>
										<li>Volume 5 / Nomor : 1 / Published : 2016-12</li>
									</ul>
									<ul class="list-unstyled list-detail-jurnal">
										<li><a href="#">
											<span>1 . </span> Hubungan antara school bonding dengan kecenderungan melakukan bullying pada siswa sekolah menengah atas
										</a></li>
										<li><a href="#">
											<span>2 . </span> Perbedaan kemandirian pada remaja yang berstatus sebagai anak tunggal ditinjau dari persepsi pola asuh orangtua
										</a></li>
										<li><a href="#">
											<span>3 . </span> Perbedaan student well-being ditinjau dari persepsi siswa terhadap perilaku internasional guru
										</a></li>
										<li><a href="#">
											<span>5 . </span> Strategi orang tua dalam mengoptimalkan potensi seni anak berbakat istimewa
										</a></li>
										
										

									</ul>
								</div>
    	     </div>
    	 </div>
    </div>
</div>
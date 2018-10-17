<style type="text/css">
	.cat-head{
		border-color: #D10909!important;
	}
	.list-content-catalog.head-list-cat{
		padding: 7px 15px;
		color: white;
	}
</style>
<div class="col col-md-12 col-sm-12 col-xs-12 none-padding content-wrap">
	<div class="col col-ms-12 col-sm-12 col-xs-12">
		<h4 class="title-content-wrap">Catalog</h4>
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
		<div class="col col-md-12 col-sm-12 col-xs-12">
			<h4 class="title-keyword">Keyword " <span><?=$param;?></span> "</h4>
		</div>
		<div class="col col-md-12 col-sm-12 col-xs-12 list-content-catalog head-list-cat  cat-head">List katalog</div><!-- <div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog head-list-cat cat-head"></div><div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog head-list-cat cat-head"></div> -->
		<?php foreach ($journal as $key => $value): ?>
			<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="<?=site_url('journal/detail_journal/'.$value["id_journal"]);?>"><?=$value['judul'];?></a></div>
		<?php endforeach ?>
		<!-- <div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div>
		<div class="col col-md-4 col-sm-6 col-xs-12 list-content-catalog"> <a href="#antibody/anti-inhibin">antibody/anti-inhibin</a>	</div> -->



		
	</div>
</div>
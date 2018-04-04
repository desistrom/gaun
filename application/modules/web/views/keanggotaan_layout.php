<!-- <link rel="stylesheet" href="<?=base_url();?>assets/css/owl.transitions.css">
<link rel="stylesheet" href="<?=base_url();?>assets/css/owl.carousel.css"> -->
<!-- <link rel="stylesheet" href="<?=base_url();?>assets/css/main.css"> -->
<style type="text/css">
/*	div.col.col-md-12.col-sm-12.col-xs-12.testimoni-box{
  background:rgba(200,200,200,0.4);

  border-radius:10px;
  padding:20px 15px;
  height:auto;
  max-height:150px;
  color:white;

}

section.testimonial{
  background-color:#4C0808;
  background-image: url('<?=base_url();?>assets/images/logo/parallax-4-home-main.jpg'); 
  background-attachment: fixed;
}
.testimonial .client-box h3{
	color: #ED0231;
	font-weight: bold;
	margin:  5px 0;
}
.testimonial .client-box h4{
	color: white;
	margin-top: 0;
}
.testimonial .triangle{
	    width: 0;
    height: 0;
    border-left: 12px solid transparent;
    border-right: 12px solid transparent;
    border-top: 17px solid #E3E3E3;
   margin-top: -0.51px;
    right: 10px;
    margin-bottom: 15px;
    opacity: 0.4;
}
.line{
	display: inline-table;
	width: 100px;
	height: 3px;
	background-color: white;
}*/
.line{
	display: inline-table;
	width: 100px;
	height: 3px;
	background-color: white;
	}
.logo-comp{
	padding: 20PX 0;
}
.cara-daftar{
	margin-top: 8em;
}
.list-manfaat{

	

}
.list-manfaat .sub-list{
	border:solid 1px #A5A5A5;
	background-color:white; 
	border-right:solid 10px #A5A5A5;
	border-left:solid 10px #A5A5A5; 
	padding: 0 15px;
	transition: 0.8s;
	height: 200px;
	max-height: 
}
.list-manfaat .sub-list:hover{
	border:solid 1px #ED0231;
	background-color:white; 
	border-right:solid 10px #ED0231;
	border-left:solid 10px #ED0231; 
	padding: 0 15px;
	transition: 0.8s;
	cursor: pointer;
}
.list-manfaat .sub-list h3{
	color: black;
	transition: 0.8s;
}
.list-manfaat .sub-list:hover h3{
	color: #ED0231;
}
</style>

	<section>
		<div class="container">
			
		</div>
	</section>
	<section class="cara-daftar">
		<div class="container">
			<div class="col col-md-12 col-sm-12 col-xs-12">
                <div class=" col col-md-12 col-sm-12 col-xs-12 text-center">
                    <h2 class="text-center" style="color: #ED0231;font-weight: bold;">Anggota </h2>
                    <div class="line" style="background-color: #ED0231;display: inline-block;margin-bottom: 15px;"></div>
                </div>
				<p>
					<?php echo $keanggotaan; ?><!-- Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent -->
				</p>
			
				<div class=" col col-md12-col-sm-12 col-xs-12 img-keanggotaan text-center">
					<img src="<?=base_url();?>assets/images/logo/keanggotaan.png" style="width: 720px;" >
				</div>
			</div>
		</div>
	</section>
	<section class="Manfaat">
		<div class="container">
		     <div class=" col col-md-12 col-sm-12 col-xs-12 tex-left">
                <h3 class="text-left" style="color: #ED0231;font-weight: bold;">Kenapa Harus Bergabung Dengan IDREN? </h3>
                <div class="line" style="background-color: #ED0231;display: inline-block;"></div>
            </div>
			<div class="col col-md-6 col-sm-6 col-xs-6 list-manfaat" style="margin: 20px 0;">
				<div class="sub-list">
				<h3><b>1. SMARTCONSYS</b></h3>
				<p>
					Adalah sistem computerize yang disusun dari beberapa elemen sistem konsultasi siswa terpadu yang tersedia dalam paket Layanan Siswa Primagama.
				</p>
				</div>
			</div>
			<div class="col col-md-6 col-sm-6 col-xs-6 list-manfaat" style="margin: 20px 0;">
				<div class="sub-list">
				<h3><b>2. EMS SYSTEM</b></h3>
				<p>
					Di Primagama, pengujian kemajuan siswa selain dilaksanakan dalam bentuk PBT (Paper Based Test) juga dalam format EMS System.
				</p>
				</div>
			</div>
			<div class="col col-md-6 col-sm-6 col-xs-7 list-manfaat" style="margin: 20px 0;">
				<div class="sub-list">
				<h3><b>3. FISITARU</b></h3>
				<p>
					Belajar menyelesaikan soal-soal fisika tanpa menggunakan rumus-rumus yang rumit.
				</p>
				</div>
			</div>
			<div class="col col-md-6 col-sm-6 col-xs-6 list-manfaat" style="margin: 20px 0;">
				<div class="sub-list">
				<h3><b>4. PELAYANAN</b></h3>
				<p>
					Primagama adalah bimbingan belajar yang selalu memberikan pelayanan yang prima agar para siswa dan siswi Primagama mencapai hasil yang optimal.
				</p>
				</div>
			</div>
		</div>
	</section>
 
    </section>

<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
<!-- <script src="<?=base_url();?>assets/js/owl.carousel.min.js"></script>
<script src="<?=base_url();?>assets/js/main-owl.js"></script> -->
<!-- <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script> -->
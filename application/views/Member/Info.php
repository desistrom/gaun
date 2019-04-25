	<?php $this->load->view('templates/User/Header'); ?>

	<!-- ____________________info gaun______________________________--> 
	<div class="allcontain">
		<div class="feturedsection">
		<div class="col-md-12" style="margin-top: 20px; padding:40px; background-image: url('<?php echo base_url();?>assets/image/bung.jpg'); background-repeat: no-repeat; background-size: 200%">
		<div class="col-md-12" style="margin-top: 20px; padding:40px;">
			<h1 class="text-center"><span class="bdots">&bullet; INFO PENYEWAAN GAUN  &bullet; </span></h1>
		</div>
		<div class="feturedimage">
			<div class="row firstrow">
				<?php foreach ($hunian as $key => $value) { ?>

				<div class="col-lg-6 col-md-6 costumcol colborder1" style="height: 400px">
					<div class="row costumrow">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 img1colon">
							<img src="<?php echo site_url()?>assets/admin/uploads/<?php echo $value->gambar; ?>" alt="" style="width: 100%">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 txt1colon ">
							<div class="featurecontant">
								<h1><?php echo $value->nama_hunian; ?></h1>
								<p>Fasilitas : <?php echo $value->deskripsi_hunian; ?></p>
								<p>Status : <b><?php echo $value->status_hunian; ?></b></p>
								<h2>Harga Rp.<?php echo $value->hargaf; ?></h2><br>
								<center><a  href="<?php echo base_url()."Welcome/Regis";?>" class="btn btn-primary">PESAN</a></center>

							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>

	<?php $this->load->view('templates/User/Footer'); ?>
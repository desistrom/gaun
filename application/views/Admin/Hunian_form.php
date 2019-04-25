<?php $this->load->view('templates/Admin/Header'); ?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"> Data Gaun</h1>
		</div>
		<?php $this->session->flashdata('pesan') ?>
		<form action="<?php echo $aksi; ?>" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Gaun: </label>
				<input type="text" name="nama" class="form-control" placeholder="Inputkan Nama Gaun" 
				required value="<?php echo $nama; ?>">
			</div>
			<div class="form-group">
				<label>Jenis Gaun: </label>
				<input type="text" name="jenis" class="form-control" placeholder="Inputkan Jenis Gaun" 
				required value="<?php echo $jenis; ?>">
			</div>

			<div class="form-group">
				<label>Deskripsi Gaun: </label><br/>
				<textarea name="deskripsi" cols="150" rows="5"><?php echo $deskripsi; ?></textarea>
			</div>

			<div class="form-group">
				<label>Status Gaun: </label>
				<input type="text" name="status" class="form-control" placeholder="Inputkan Status Gaun" 
				required value="<?php echo $status; ?>">
			</div>
			<div class="form-group">
				<label>Harga Gaun: </label>
				<input type="text" name="harga" class="form-control" placeholder="Inputkan Harga Gaun" 
				required value="<?php echo $harga; ?>">
			</div>

			<div class="form-group">
				<label>Denda Gaun: </label>
				<input type="text" name="denda" class="form-control" placeholder="Inputkan Denda Gaun" 
				required value="<?php echo $denda; ?>">
			</div>
			
			<div class="form-group">
				<label>Gambar Gaun: </label>
				<input type="file" name="filefoto" class="form-control" placeholder="Inputkan Gambar Gaun">
			</div>

			<input type="hidden" name="id_hunian" value="<?php echo $id_hunian; ?>">
			<button class="btn btn-primary" type="submit"><?php echo $button; ?></button>
			<a href="<?php echo site_url('hunian')?>" class="btn btn-default">Cancel</a>
		</form>
	</div>
</div>
<?php $this->load->view('templates/Admin/Footer'); ?>
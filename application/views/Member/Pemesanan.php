<?php $this->load->view('templates/User/Header_member'); ?>
		<!--_______________________________________Register_________________________________ -->

		<<div class="allcontain">
			<div class="feturedsection">
				<h1 class="text-center"><span class="bdots">&bullet; Pemesanan Gaun Pengantin  &bullet; </span></h1>
			</div>
		</div>	
				<center>
					<form action="<?php echo $aksi; ?>" method="POST">
						<table align ="text-center">
							<input type="hidden" name="id_pesan" value="<?php echo $id_pesan; ?>">
							<input type="hidden" name="id_hunian" value="<?php echo $id_hunian; ?>">
          					<input type="hidden" name="id_member" value="<?php echo $id_member; ?>">
          					

							<tr> <td>Tanggal Mulai</td>
								<td> : </td>
								<td><div class="form-group">
									<input type="date" class="form-control" name="tanggal_mulai" placeholder="Tanggal Mulai menyewa kost">
								</div></td>
							</tr>

							<tr> <td>Durasi per Hari</td>
								<td> : </td>
								<td><div class="form-group">
									<input type="radio" name="durasi" value="1 Hari"> 1 Hari &nbsp;
									<input type="radio" name="durasi" value="3 Hari"> 3 Hari &nbsp;
									<input type="radio" name="durasi" value="6 Hari"> 6 Hari
								</div></td>
							</tr>
							<tr> <td></td>
								<td><button type="submit" class="btn btn-warning btn-block" value="PESAN"><?php echo $button; ?> </button></td>
								<td></td>
							</tr>
						</table>
					</form>
				</center>
			</div>
		</div>
	</div>
	<BR>
	<BR>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<?php $this->load->view('templates/User/Footer'); ?>
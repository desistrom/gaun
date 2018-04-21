<link rel="stylesheet" href="<?=base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">
		<div class="box">
		<div class="box-body">
			<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
				<!-- <a href="<?=site_url('admin/keanggotaan/add_instansi');?>" class="btn btn-success">Tambah Instansi</a> -->
			</div>
			<div class="col col-md-12 col-xs-12">
				<table class="table table-bordered  dataTable" id="example2">
					<thead>
						<th>No</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Message</th>
					</thead>
					<tbody>
					<?php foreach ($contact as $key => $value): ?>
						<tr>
							<td><?=($key+1);?></td>
							<td><?=$value['nama'];?></td>
							<td><?=$value['email'];?></td>
							<td><?=word_limiter($value['pesan'],10);?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<div class="col col-md-12 col-xs-12 text-right">
					<!-- <a href="#" class="btn btn-default">Setting</a> -->
				</div>
			</div>
		</div>
		</div>
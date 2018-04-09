<div class="box">
	<?php if($view == 'list'){ ?>
		<div class="box-body">
			<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
				<a href="<?=site_url('admin/keanggotaan/add');?>" class="btn btn-success">Tambah User</a>
			</div>
			<div class="col col-md-12 col-xs-12">
				<table class="table table-bordered  dataTable">
					<tr>
						<th>No</th>
						<th>Kategori</th>
						<th>Subject</th>
						<th>Title</th>
						<th>Content</th>
					</tr>
					<?php foreach ($anggota as $key => $value): ?>
						<tr>
							<td><?=($key+1);?></td>
							<td><?=$value['name'];?></td>
							<td><?=$value['email'];?></td>
							<td><?=$value['phone'];?></td>
							<td>
								<!-- <button class="btn btn-default">disable</button> -->
								<a href="<?=site_url('admin/keanggotaan/edit/'.$value['id_user']);?>"><button class="btn btn-primary" id="edit">Edit</button></a>
							</td>
						</tr>
					<?php endforeach ?>
				</table>
				<div class="col col-md-12 col-xs-12 text-right">
					<!-- <a href="#" class="btn btn-default">Setting</a> -->
				</div>
			</div>
		</div>
	<?php }elseif ($view == 'add') { ?>
		
	<?php } ?>
</div>
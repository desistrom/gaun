<div class="box">
	<?php if($view == 'list'){ ?>
		<link rel="stylesheet" href="<?=base_url();?>assets/datatables/css/dataTables.bootstrap.min.css">
		<div class="box-body">
			<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-left: 0; margin-bottom: 15px;">
				<a href="<?=site_url('admin/menu/add_page');?>" class="btn btn-success">Tambah Page</a>
			</div>
			<div class="col col-md-12 col-xs-12">
				<table class="table table-bordered  dataTable" id="example2">
					<thead>
						<th>No</th>
						<th>Title</th>
						<th>Content</th>
						<th>Action</th>
					</thead>
					<tbody>
					<?php foreach ($menu as $key => $value): ?>
						<tr>
							<td><?=($key+1);?></td>
							<td><?=$value['title'];?></td>
							<td><?=word_limiter($value['content'],10);?></td>
							<td>
								<a href="<?=site_url('admin/menu/edit_page/'.$value['id_general_page']);?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Edit</a>
								<button class="btn btn-danger btn-sm btn_delete" id="<?=$value['id_general_page'];?>"><i class="fa fa-trash"> Delete</i></button>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<div class="col col-md-12 col-xs-12 text-right">
					<!-- <a href="#" class="btn btn-default">Setting</a> -->
				</div>
			</div>
		</div>
		<?php if ($this->session->flashdata('notif') != '') { ?>
		<div class="modal" tabindex="-1" role="dialog" id="modalSuccess">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h3 class="modal-title">Success</h3>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <p><?=$this->session->flashdata('notif');?></p>
		      </div>
		      <div class="modal-footer">
		        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
		<?php } ?>
		<div class="modal fade" id="progresLoading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="vertical-alignment-helper">
		        <div class="modal-dialog vertical-align-center">
		            <div class="modal-content">
		                <div class="modal-body">
		                  <div class="box box-danger">
		                      <div class="box-header">
		                      </div>
		                      <div class="box-body">
		                      </div>
		                      <div class="overlay">
		                        <i class="fa fa-refresh fa-spin"></i>
		                      </div>
		                  </div>
		                </div>

		            </div>
		        </div>
		    </div>
		</div>
		<div class="modal" tabindex="-1" role="dialog" id="ntfmodal">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title"></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        
		      </div>
		    </div>
		  </div>
		</div>
		<?php }elseif($view == 'add'){ ?>
		<div class="box-header with-border">
			<h3 class="box-title">Add page</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<form role="form">
				<!-- text input -->
				<div class="form-group">
					<label>Title Page</label>
					<input type="text" name="label" class="form-control" id="label" placeholder="Masukan Title Page ..." value="">
					<div class="error" id="ntf_label"></div>
				</div>
				<input type="hidden" name="slug" class="form-control" id="slug" placeholder="" value="">
				<div class="form-group">
			      <label>Content</label>
			        <?php  echo $this->ckeditor->editor("content", "" ); ?>
			        <input type="hidden" name="content" id="content">
			        <div class="error" id="ntf_content"></div>
			    </div>
				<div class="form-group">
			      	<label>Image Page</label>
			        <input type="file" class="form-control" name="userfile" id="userfile">
			        <div class="error" id="ntf_userfile"></div>
			        <div class="error" id="ntf_error"></div>
			    </div>
				<div class="form-group">
					<label>Setting to Menu</label>
					<select name="menu" id="menu" class="form-control">
						<option value="">-- Select Menu --</option>
						<?php foreach ($menu as $key => $value): ?>
							<option value="<?=$value['link'];?>"><?=$value['label'];?></option>	
						<?php endforeach ?>
					</select>
					<div class="error" id="ntf_menu"></div>
				</div>

				<div class="form-group">
					<label>Page Template</label>
					<select name="menu" id="menu" class="form-control">
						<option value="">-- Select Menu --</option>
						<option value="1">General</option>	
						<option value="2">Galery</option>	
					</select>
					<div class="error" id="ntf_menu"></div>
				</div>

				<button type="button" class="btn btn-primary" id="submit">Submit</button>
			</form>
		</div>
		<?php }else{ ?>
		<div class="box-header with-border">
			<h3 class="box-title">Edit Menu</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<form role="form">
				<!-- text input -->
				<div class="form-group">
					<label>Nama Menu</label>
					<input type="text" name="label" class="form-control" id="label" placeholder="Masukan Nama Menu ..." value="<?=$current['title'];?>">
					<div class="error" id="ntf_label"></div>
				</div>
				<input type="hidden" name="slug" class="form-control" id="slug" placeholder="" value="<?=$current['link'];?>">
				<div class="form-group">
			      <label>Content</label>
			        <?php echo $this->ckeditor->editor("content", $current['content'] ); ?>
			        <input type="hidden" name="content" id="content">
			        <div class="error" id="ntf_content"></div>
			    </div>
				<div class="form-group">
			      	<label>Image Page</label>
			        <input type="file" class="form-control" name="userfile" id="userfile">
			        <div class="error" id="ntf_userfile"></div>
			        <div class="error" id="ntf_error"></div>
			    </div>
				<div class="form-group">
					<label>Setting to Menu</label>
					<select name="menu" id="menu" class="form-control">
						<option value="">-- Select Menu --</option>
						<?php foreach ($menu as $key => $value): ?>
							<option <?php if($current['link'] == $value['link']){ ?> selected <?php } ?> value="<?=$value['link'];?>"><?=$value['label'];?></option>
						<?php endforeach ?>
					</select>
					<div class="error" id="ntf_menu"></div>
				</div>
			    <img src="<?=base_url();?>media/<?=$current['img'];?>" width="250px">
				<button type="button" class="btn btn-primary" id="submit">Submit</button>
			</form>
		</div>
		<?php } ?>
</div>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<!-- <script src="<?=base_url().'assets/js/jquery.slugify.js';?>"></script> -->
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click','#submit',function(){
    	$('#content').val(CKEDITOR.instances.content.getData());
    	var form_data = new FormData();
      	var data_file = $('#userfile').prop('files')[0];
		form_data.append('userfile',data_file);
		form_data.append('label',$('#label').val());
		form_data.append('slug',$('#slug').val());
		form_data.append('content',$('#content').val());
		form_data.append('menu',$('#menu').val());
    	console.log($('#slug').val());
    	$.ajax({
    		url : window.location.href,
    		type : 'POST',
    		data : form_data,
    		dataType : 'json',
    		async : false,
			cache : false ,
			contentType : false , 
			processData : false
    	}).done(function(data){
    		if (data.state == 1) {
    			if (data.status == 1) {
    				window.location.href = data.url;
    			}
    		}
    		$.each(data.notif,function(key,value){
	            $('.error').show();
	            $('#ntf_'+ key).html(value);
	            $('#ntf_'+ key).css({'color':'red', 'font-style':'italic'});
            });
    	});
    });
    $('body').on('click','.btn_delete',function(){
    	var id = $(this).attr('id');
    	if (confirm("Sure Delete this page ?")) {
    		$('#progresLoading').modal('show');
    		setTimeout(function(){
		    	$.ajax({
		    		url : base_url+'admin/menu/delete_page',
		    		type : 'POST',
		    		data : {'id' : id},
		    		dataType : 'json'
		    	}).done(function(data){
		    		$('#progresLoading').modal('hide');
		    		if (data.status == 1) {
		    			$('#ntfmodal .modal-title').text('Success');
		    			$('#ntfmodal .modal-body').text(data.notif);
		    			$('#ntfmodal').modal('show');
		    			$('#ntfmodal').on('hidden.bs.modal',function(){
							window.location.href = base_url+'admin/menu';
						});
		    		}else{
		    			$('#ntfmodal .modal-title').text('Failed');
		    			$('#ntfmodal .modal-body').text(data.notif);
		    			$('#ntfmodal').modal('show');
		    		}
		    	});
	    	},2000);
    	}
    });
    function slugify(text)
    {
      return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');            // Trim - from end of text
    }
    $('#label').keyup(function () {
      var slug = slugify($('#label').val());
      $('#slug').val(slug);
    });
    $('#modalSuccess').modal('show');
  });
</script>
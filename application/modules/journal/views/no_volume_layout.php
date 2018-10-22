<style type="text/css">
    #table_paginate{
        text-align: right!important;
    }
</style>
<div class="col col-md-12 col-sm-12 col-xs-12">
    <a href="<?=site_url('journal/admin/add_no_volume');?>" class="btn btn-success" style="margin-bottom: 15px;" ><i class="fa fa-plus"></i> Add No Volume</a>
    <div class="table-responsive">
        <table class="table table-striped" id="table">
            <thead>
                <th>No.</th>
                <th>Nomor Volume</th>
                <th>Volume</th>
                <th>Journal</th>
                <th>Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script src="<?=base_url();?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/datatables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
 
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('journal/admin/ajax_list_no_volume')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
});
</script>
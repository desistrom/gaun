   
<style type="text/css">
    .content-foto{
        margin-top: 6em;
    }
        .line{
        width: 100px;
        height: 3px;
        background-color:#BD0E0E;
        display: inline-table; 
    }
    .text-title{
            position: absolute;
    z-index: 10;
    bottom: 0;
    font-weight: bold;
    color: #E91515;
    transition: 0.8s;
    }
    div.box:hover .text-title,
    div.box:active .text-title,
    div.box:focus .text-title
    {
        margin-bottom: 50%;
        color: white;

    }
</style>

    <div class="container content-foto">
        <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <h3 style="color: #BD0E0E;font-weight: bold;margin-bottom: 0;">Gallery Foto</h3>
                <div class="line"></div>
            <div class="col-md-12 search-img">
                <div>
                    <input type="search" class="input-search" name="search" id="search">
                    <button class="btn btn-primary btn-search" type="button">Cari </button>
                </div>
            </div>
            <div class="replace-content">

        <?php
        if (is_array($foto)) {
            foreach ($foto as $key => $value) :  ?>
                <div class="col-lg-4 col-md-4 col-xs-6 filter-img">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="<?php echo $value['title']; ?>" data-caption="<?php echo $value['keterangan']; ?>" data-image="<?=base_url();?>assets/media/<?php echo $value['title'] ?>" data-target="#image-gallery" data-date="<?php echo $value['modify_date']; ?> " data-user="by : <?php echo $value['nama_user']; ?>" style="padding: 0;">
                        <div class="box">
                            <h3 class="text-title" style="width: 100%;text-align: center;}"><?php echo $value['title']; ?></h3>
                            <div class="sub-box">
                                <div class="filter-image">
                                    
                                    <i class="glyphicon glyphicon-zoom-in"></i>
                                </div>
                                <img src="<?=base_url();?>assets/media/<?php echo $value['file'] ?>" class="image-gallery" id="myImg">
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach;
        }else{
            echo "Data Not Found";
        }
                 ?>
            </div>


                    


        </div>
    </div>

<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" style="">×</button>
              <div class="modal-body-gallery">                
              </div>
            <div class="modal-footer" style="padding: 0 15px;">
              <div class="col col-md-12 col-sm-12 col-xs-12 none-padding">
                <div class="col col-md-6 col-sm-6 col-xs-6 none-padding">
                    <h5 class="date-upload text-left" id="image-gallery-title"></h5></div>
                <div class="col col-md-6 col-sm-6 col-xs-6 none-padding">
                    <h5 class="author text-right" id="image-gallery-date" ></h5></div>
                <div class="col col-md-12 col-sm-12 col-xs-12 none-padding text-left">

                    <p id="image-gallery-caption"></p>
                </div>
                <p id="image-gallery-user" style="text-align: right;"></p>
            </div>
          </div>
        </div>
    </div>
</div>
    <script src="<?=base_url().'assets/js/jquery-v1.11.3.min.js';?>"></script>
    <script src="<?=base_url();?>assets/js/modal-custom.js"></script>
<!--  <script src="<?=base_url().'assets/js/modal-custom.js' ;?>"></script> -->

<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click','.btn-search',function(){
            var data = $('#search').val();
            if (data != '') {
                // window.location.href = '<?=base_url();?>web/galery/search_foto?data='+data;
                $.ajax({
                url : '<?=base_url();?>web/galery/search_foto?data='+data,
                type : 'POST',
                dataType : 'json',
                data :""
            }).done(function(data){
                console.log(data);
                $('.replace-content').html(data);
            });
            }
        });
    });
</script>

<style type="text/css">
    .video-box{
        width: 100%;
    }
    .video-box iframe{
        width: 100%;
        height: 250px;
    }
    .content-video{
        margin-top: 6em;
    }
    .line{
        width: 100px;
        height: 3px;
        background-color:#BD0E0E;
        display: inline-table; 
    }
</style>
    <!-- <div class="container content-video">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <h2>Gallery Video</h2></div>
            <div class="col-md-12 search-img" style="margin-bottom: 2em;">
                <div>
                    <input type="search" class="input-search" name="search" id="search">
                    <button class="btn btn-primary btn-search" type="button">Cari </button>
                </div>
            </div>

            <?php foreach ($video as $key => $value) : ?>
            <div class="col col-ms-4 col-sm-4 col-xs-4">
                <div class="video-box">
                    <iframe  src="<?php echo $value['file_name'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
                   <div class="col col-md-12 col-sm-12 col-xs-12">
                    <div class="col col-md-6 col-sm-6 col-xs-6 none-padding">
                        <h5 class="date-upload"><?php echo $value['tgl_upload'] ?></h5></div>
                    <div class="col col-md-6 col-sm-6 col-xs-6 none-padding">
                        <h5 class="author text-right">by : <?php echo $value['name'] ?></h5></div>
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding">
                        <p><?php echo $value['deskripsi'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
        </div>
    </div>
     <script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click','.btn-search',function(){
            var data = $('#search').val();
            if (data != '') {
                window.location.href = '<?=base_url();?>web/galery/search_video?data='+data;
            }
        });
    });
</script> -->
<div class="container content-video">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <h3 style="color: #BD0E0E;font-weight: bold;margin-bottom: 0;">Gallery Video</h3>
                <div class="line"></div>
            </div>
            <div class="col-md-12 search-img" style="margin-bottom: 2em;">
                <div>
                    <input type="search" class="input-search" name="search" id="search">
                    <button class="btn btn-primary btn-search" type="button">Cari </button>
                </div>
            </div>
        <?php foreach ($video as $key => $value) :  ?>
        <div class="col-lg-4 col-md-4 col-xs-6 filter-img">
            <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="<?php echo $value['judul']; ?>" data-caption="<?php echo $value['deskripsi']; ?>" data-image="<?=base_url();?>assets/media/<?php echo $value['file_name'] ?>" data-target="#image-gallery" data-date="<?php echo $value['tgl_upload']; ?> " style="padding: 0;">
                <div class="box">
                    <div class="sub-box">
                        <div class="filter-image">
                            <i class="glyphicon glyphicon-zoom-in"></i>
                        </div>
                        <iframe class="video-up"  src="<?php echo $value['file_name'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        
                    </div>
                </div>
            </a>
        </div>
                <?php endforeach ?>


                    


        </div>
    </div>

<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            </div>
          </div>
        </div>
    </div>
</div>
    <script src="<?=base_url().'assets/js/jquery-v1.11.3.min.js';?>"></script>

<!--  <script src="<?=base_url().'assets/js/modal-custom.js' ;?>"></script> -->

<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click','.btn-search',function(){
            var data = $('#search').val();
            if (data != '') {
                window.location.href = '<?=base_url();?>web/galery/search_video?data='+data;
            }
        });
    });
</script>

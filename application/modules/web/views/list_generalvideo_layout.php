<style type="text/css">
.header-title h2{
font-size: 50px;color: #BDBDBD;
}

   @media(max-width:500px){
  .title-page-news{
    margin-top: 0!important;
  }
</style>
<link rel="stylesheet" href="<?=base_url();?>assets/css/style_list_video.min.css?t=<?=time();?>"> 
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h2 style="">ID-TUBE </h2></div>
            </div>
        </div>
        <section class="content-video">
          <div class="container-fluid ">
            <div class="row">
              <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-video">
                <?php foreach ($id_tube as $key => $value): ?>
                  
                
                <div class="col-md-4 col-sm-6 col-xs-12 text-center" style="height: auto;overflow: hidden;">
                    <div class="box-img-galery "> 
                        <div class="filter-img-galery" >
                          <a href="#" class="show-video" id="<?php echo $value['file'] ?>" ></a>
                           <iframe  width="100%" height="270px" src="<?php echo $value['file'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                      </div>
                      <div class="galery-deskripsi text-left">
                        <h3><?php echo $value['title']; ?> </h3>
                        <ul class="list-inline">
                          <li><?php echo $value['modify_date']; ?></li>
                          <li>100 views</li>
                        </ul>
                      </div>
                    </div>
                </div>
                <?php endforeach ?>
              
              </div>
            </div>
          </div>
            <div class="container-fluid section-pagination">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <!-- <ul class="list-inline pagination list-pagination"> -->
                        <?php echo $this->pagination->create_links(); ?>
                    <!-- </ul> -->
                </div>
            </div>
        </div>
          
        </section>


        <div class="modal fade modal-list-video" id="list-video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" style="">×</button>
              <div class="modal-body-gallery"> 
              <iframe src="" id="tampil-video"></iframe>               
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
<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
<script src="<?=base_url();?>assets/js/modal-custom.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $(".show-video").click(function(){
        var file = $(this).attr('id');
          $('#list-video iframe').attr('src',file);
          
          $(".modal-list-video").modal();
      });
    });
</script>



   
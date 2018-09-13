      <link rel="stylesheet" href="<?=base_url();?>assets/css/style_foto.min.css?t=<?=time();?>"> 
      <style type="text/css">
        .content-img-top-left{
          margin-top: 2em;
        }
        .filter-img-galery img{
          width: 100%;
          height: 205px;
        }
        @media(max-width:500px){
           .content-img-top-left{
          margin-top: 1em;
        }
        }
      </style>

        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h1 style="">PHOTO </h1></div>
            </div>
        </div>
        <section id="img-page">
        <div class="container-fluid">
          <div class="row">
            <div class="col col-md-12 col-sm-12 col-xs-12 none-padding">
              <div class="col col-md-5 col-sm-12 col-xs-12 content-img-top-left">
                     <h2 class="text-img-page" style="color: #747474;"><?php echo $album_id[0]['title']; ?></h2>
                     <h4 style="color: #BDBDBD"><?php echo $album_id[0]['date_album']; ?></h4>
              </div>
              <div class="col col-md-7 col-sm-12 col-xs-12 none-padding">
                <div class="carousel-top">
                      <div id="myCarousel" class="carousel slide col col-md-12 col-sm-12 col-xs-12 " data-ride="carousel">
                     

                          <!-- Wrapper for slides -->
                          <div class="carousel-inner">
                            <?php foreach ($album_id as $key => $value) : ?>

                              <div class="item img-page <?php if ($key==0): ?>active
                                
                              <?php endif ?>">
                             
                              <div class="col col-md-12 col-sm-12 col-xs-12 none-padding content-img-top-right">
                                <img class="img-responsive img-slider" src="<?php echo $value['image']; ?>"  style="width:100%;">
                              </div>   
                            </div>
                            <?php endforeach ?>
                          </div>

                     
                         <!-- Indicators -->
                          <ol class="carousel-indicators text-right col col-md-12 col-sm-12 col-xs-12">
                            <?php foreach ($album_id as $key => $value) : ?>
                            <li data-target="#myCarousel" data-slide-to="<?php echo $key; ?>" class="<?php if ($key==0): ?>active <?php endif ?>"></li>
                           <?php endforeach ?>
                          </ol>
                     </div>
                  </div>
              </div>
                   <!-- Left and right controls -->
                        <a class="slide-control left " href="#myCarousel" data-slide="prev">
                          <span class="fa fa-angle-left"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="slide-control right " href="#myCarousel" data-slide="next">
                          <span class="fa fa-angle-right"></span>
                          <span class="sr-only">Next</span>
                        </a>  
            
            </div>
          </div>
        </div>
        </section>

        <div class="container-fluid album-galery" id="album-galery" >
          <div class="col col-md-12 col-sm-12 col-xs-12">
            <h2 style="color:#747474; ">Album Galery</h2>
            <div class="line-galery" style=""></div>
          </div>
            <div class="img-galery" id="owl-demo">
              <?php foreach ($foto as $key => $value) : ?>
                <div class="col-md-12 col-sm-12 col-xs-12 text-center item" >
                    <div class="box-img-galery">
                      <a href="#" class="show-album" id="<?php echo $value['albumId'] ?>" data-toggle="modal" >
                        <div class="filter-img-galery" >
                        <img class="img-responsive" src="<?php echo $value['image']; ?>">
                      </div>
                      </a>
                      <div class="galery-deskripsi text-left">
                        <h3><?php echo $value['title']; ?></h3>
                        <p><?php echo $value['date_album']; ?></p>
                      </div>
                    </div>
                </div>
            <?php endforeach ?>
              
            </div>
          
        </div>



</section>







<!-- Modal -->
<div id="myModal" class="modal fade modal-album" role="dialog">
  <div class="modal-dialog modal-lg modal-md modal-sm modal-xs">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" ">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <div class="">
          <h2 class="replace-title">Entrepeneur class berbasis IT</h2>
          <p class="replace-date">14 april 2018</p>
        </div>
      </div>
      <div class="modal-body">
          
          <div id="myCarousel-pop" class="carousel slide" data-ride="carousel">
             

              <!-- Wrapper for slides -->
              <div class="carousel-inner carousel-replace">

                <!-- <div class="item active">
                  <img width="100%" src="<?=base_url();?>assets/images/logo/nota-kesepahaman.jpg" alt="Los Angeles">
                </div>

                <div class="item">
                  <img width="100%" src="<?=base_url();?>assets/images/logo/nota-kesepahaman.jpg" alt="Chicago">
                </div>

                <div class="item">
                  <img width="100%" src="<?=base_url();?>assets/images/logo/nota-kesepahaman.jpg"" alt="New York">
                </div> -->
              </div>
                <p>aaaaaaaaaaaaaaaaaa</p>

              <!-- Left and right controls -->
              <a class="left carousel-control" href="#myCarousel-pop" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel-pop" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>

      </div>
      <div class="modal-footer">
         <!-- Indicators -->
              <ol class="carousel-indicators col col-md-12 col-sm-12 col-xs-12 carousel-indicators-replace">
                <!-- <li class="thumbnail-indicator" data-target="#myCarousel-pop" data-slide-to="0" class="active">
                   <img class="img-responsive" src="<?=base_url();?>assets/images/logo/nota-kesepahaman.jpg">
                </li>
                <li class="thumbnail-indicator" data-target="#myCarousel-pop" data-slide-to="1">
                   <img class="img-responsive" src="<?=base_url();?>assets/images/logo/nota-kesepahaman.jpg">
                </li>
                <li class="thumbnail-indicator" data-target="#myCarousel-pop" data-slide-to="2">
                   <img class="img-responsive" src="<?=base_url();?>assets/images/logo/nota-kesepahaman.jpg">
                </li> -->
              </ol>
      </div>
    </div>

  </div>
</div>
<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
 <script type="text/javascript">
    $(document).ready(function(){
      $(".show-album").click(function(){
          $(".modal-album").modal();
      });


      $('body').on('click','.show-album',function(){
            var data = $(this).attr('id');
            console.log(data);
            if (data != '') {
                // window.location.href = '<?=base_url();?>web/galery/search_video?data='+data;
                $.ajax({
                url : '<?=base_url();?>web/galery/detail_album?data='+data,
                type : 'GET',
                dataType : 'json',
                data :""
            }).done(function(data){
                console.log(data);
                $('.replace-title').html(data.judul);
                $('.replace-date').html(data.tanggal);
                $('.carousel-replace').html(data.slideshow);
                $('.carousel-indicators-replace').html(data.thumbnail_album);
            });

            }
        });
    });
     </script>






   
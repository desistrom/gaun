   

<style type="text/css">
 .content-video{
  background-color: #F2F2F2;
}
.title-page-news{
  padding-bottom: 0;
}
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

     .filter-title-page-news{
        margin-top: 5em;
      }



    .list-video{
      padding: 2em 15px;
      margin: 1.5em 0;
      background-color: white;
    }
    .list-video .line-list{
      width: 150px;
      height: 3px;
      background-color: #CF090A;
      margin-bottom: 2em;
    }
          .example-desc {
        margin:3px 0;
        padding:5px;
      }

      #carousel {
        width:100%;
        height:400px;
     
        position:relative;
        clear:both;
    
      
      }
      #carousel img {
        visibility:hidden; /* hide images until carousel can handle them */
        cursor:pointer; /* otherwise it's not as obvious items can be clicked */
      }
      .btn-nav-video{
        position: absolute;
        font-size: 80px;
        font-weight: 700;
        color: #747474;
      }
      .btn-nav-video:hover{
         color: #747474;
      }
      .btn-nav-video i:hover{
       
        color: black;
      }
      .btn-nav-video.button-right{
        right: 0;
        padding: 160px 0 160px 3.5em;
        z-index: 100;
        background-color: transparent;
           margin-right: -10px;
      }
       .btn-nav-video.button-left{
        left: 0;
        padding: 160px 3.5em 160px 0;
        z-index: 100;
        background-color: transparent;
        margin-left: -10px;

      }
      .slider-waterwheel{
        box-shadow:0px 0px 28px 0px #000000;
      }

         /* The Modal (background) */


      </style>
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h2 style="font-size: 50px;color: #BDBDBD;">Video </h2></div>
            </div>
        </div>
        <section class="content-video">
          <div class="container-fluid ">
            <div class="row">
              <div class="col col-md-12 col-sm-12 col-xs-12">
                




                <div  id="carousel">

                      <?php for ($i=0; $i < 3 ; $i++) { ?>
                  <?php if (isset($video[$i]['title'])) { ?>
                
                            <iframe class="slider-waterwheel" width="640px" height="360px" src="<?php echo $video[$i]['file'] ?> " frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            

                 <?php } } ?>

                 <a href="#" class="btn-nav-video button-left"><i class="fa fa-angle-left" id="prev"></i></a>  <a href="#" class="btn-nav-video button-right" ><i class="fa fa-angle-right" id="next"></i></a>
                </div>

                


 




              </div>
              <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-video">
                <div class="col col-sm-12 col-sm-12 col-xs-12 none-padding">
                  <div class="col-md-6 col-sm-6 col-xs-6">
                  <h3>Lastest Video</h3>
                  <div class="line-list"></div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                  <a href="<?php echo site_url('web/galery/list_video') ?>" class="btn btn-danger">View All</a>
                </div>
                </div>
                  <?php for ($i=0; $i < 3 ; $i++) { ?>
                  <?php if (isset($video[$i]['title'])) { ?>
                <div class="col-md-4 col-sm-6 col-xs-12 text-center item" >
                    <div class="box-img-galery">
                      <a href="#" class="show-album" data-toggle="modal" ">
                        <div class="filter-img-galery" >
                           <iframe width="100%" height="270px" src="<?php echo $video[$i]['file'] ?> " frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                      </div>
                      </a>
                      <div class="galery-deskripsi text-left">
                        <h3><?php echo $video[$i]['title']; ?></h3>
                        <ul class="list-inline">
                          <li><?php echo $video[$i]['modify_date']; ?></li>
                          <li>100 views</li>
                        </ul>
                      </div>
                    </div>
                </div>
                 <?php } } ?>
              </div>
         
            </div>
          </div>
        </section>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
        var carousel = $("#carousel").waterwheelCarousel({
          flankingItems: 1,
          movingToCenter: function ($item) {
            $('#callback-output').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');
          },
          movedToCenter: function ($item) {
            $('#callback-output').prepend('movedToCenter: ' + $item.attr('id') + '<br/>');
          },
          movingFromCenter: function ($item) {
            $('#callback-output').prepend('movingFromCenter: ' + $item.attr('id') + '<br/>');
          },
          movedFromCenter: function ($item) {
            $('#callback-output').prepend('movedFromCenter: ' + $item.attr('id') + '<br/>');
          },
          clickedCenter: function ($item) {
            $('#callback-output').prepend('clickedCenter: ' + $item.attr('id') + '<br/>');
          }
        });

        $('#prev').bind('click', function () {
          carousel.prev();
          return false
        });

        $('#next').bind('click', function () {
          carousel.next();
          return false;
        });

        $('#reload').bind('click', function () {
          newOptions = eval("(" + $('#newoptions').val() + ")");
          carousel.reload(newOptions);
          return false;
        });

      });
    </script>


   
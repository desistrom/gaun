   

<style type="text/css">
 .content-video{
  background-color: #F2F2F2;
}
.title-page-news{
  padding-bottom: 0em;
  margin-top: 5em;
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
    .show-video{
      width: 100%;
      height: 100%;
      position: absolute;
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
              <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-video">
                <<?php foreach ($video as $key => $value): ?>
                  
                
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="height: auto;overflow: hidden;">
                    <div class="box-img-galery "> 
                        <div class="filter-img-galery" >
                          <a href="#" class="show-video" data-toggle="modal" ></a>
                           <iframe width="100%" height="270px" src="https://www.youtube.com/embed/rbvRXK9gMpc" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                      </div>
                      <div class="galery-deskripsi text-left">
                        <h3>Variasi makanan </h3>
                        <ul class="list-inline">
                          <li>12 april 2018</li>
                          <li>100 views</li>
                        </ul>
                      </div>
                    </div>
                </div>
                <?php endforeach ?>
              
              </div>
            </div>
          </div>
        </section>


    <div class="modal fade modal-list-video" id="list-video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $(".show-video").click(function(){
          $(".modal-list-video").modal();
      });
    });
</script>



   
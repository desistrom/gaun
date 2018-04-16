   

<style type="text/css">
 .content-video{
  background-color: #F2F2F2;
}
.title-page-news{
  padding-bottom: 2em;
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
</style>

   <section class="detail_news">
      <style type="text/css">
     .filter-title-page-news{
        margin-top: 5em;
      }

    .ktrv {
       
       
        height: 500px;
        position: relative;
        clear: both;
        overflow: hidden;
     
    }
    .noselect {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/*        .wwkt img {
      display: inline-block;
      width: 100%;
      height: 100%;
      opacity: 0;

    }*/

    .ktrv>div.wwkt>div:nth-child(2) {
        position: absolute;
        top: 0;
        width: 100%;
        height: inherit;
        display: table;
        background-color: #0a3b52;
        border-radius: 5px;
    }
    .ktrv>div.wwkt>div:last-child {
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
        display: table;
    }
    .ktrv > div.wwkt > div:first-child {

    display: table-cell;
    vertical-align: middle;
    height: 100%;
    width: 100%;

}

    h2 {

        display: table-cell;
        vertical-align: middle;
        height: inherit;
        width: 100%;
        text-align: center;
        color:black;
    }


    #callback-output {
        height: 250px;
        overflow: scroll;
    }



    .ktrv>div.wwkt {
        display: inline-block;
        cursor: pointer;
    }
    #wwcp-2{
    
    }
    #wwcp-3{
      
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
    
         /* The Modal (background) */


      </style>
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h2 style="font-size: 50px;color: #BDBDBD;margin-bottom: 1em;">PHOTO </h2></div>
            </div>
        </div>
        <section class="content-video">
          <div class="container-fluid ">
            <div class="row">
              <div class="col col-md-12 col-sm-12 col-xs-12">
                




                <div class="ktrv col col-md-12 col-sm-12 col-xs-12">

                      <?php for ($i=0; $i < 3 ; $i++) { ?>
                  <?php if (isset($video[$i]['title'])) { ?>
                  <div class="wwkt" id="wwcp-1">
                        <div>
                        </div>
                        <div>
                            <iframe width="100%" height="100%" src="<?php echo $video[$i]['file'] ?> " frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                        <div>
                        </div>
                    </div>

                 <?php } } ?>

               
                    <!--img src="images/4.jpg" id="wwcp-4" />
                  <img src="images/5.jpg" id="wwcp-5" />
                  <img src="images/6.jpg" id="wwcp-6" />
                  <img src="images/7.jpg" id="wwcp-7" />
                  <img src="images/8.jpg" id="wwcp-8" />
                  <img src="images/9.jpg" id="wwcp-9" /-->
                </div>
                   <a href="{{data.url}}">
                 </a>

 




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
                <div class="col-md-4 col-sm-4 col-xs-4 text-center item" >
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

             <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>



   
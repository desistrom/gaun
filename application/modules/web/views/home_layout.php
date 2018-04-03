<style type="text/css">
  .line{
    height: 3px;
    width: 100px;
    background-color: #BD0E0E;
    display: inline-table;
    margin-bottom: 15px;
  }
</style> 
 <section id="img-page" style="margin-top: 6em">
        <!-- <div class="col-md-12 sub-mg-page">
            <div class="container-fluid filter-mg-page"><img class="img-responsive" src="assets/img/landing page image edit.png">
                <h3 class="text-img-page">Belajar jadi <b>Mudah</b> dan <b>Menyenangkan</b></h3></div>
        </div> -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
              <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
              <div class="item img-page active">
                <img src="<?=base_url();?>assets/images/image.jpg"  style="width:100%;">

              </div>

              <div class="item img-page">
                <img src="<?=base_url();?>assets/images/image.jpg"  style="width:100%;">
              </div>
            
              <div class="item img-page">
                <img src="<?=base_url();?>assets/images/image.jpg"  style="width:100%;">

              </div>
            <div class="item img-page">
                <img src="<?=base_url();?>assets/images/image.jpg"  style="width:100%;">

              </div>

            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
    </section>
    <section id="about-us">
        <div class="container sub-aboutus">
          <div class="col col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
              <h3>About Us</h3>
              <div class="line"></div>
          </div>
            <div class="col-md-12 col-sm-12 text-center">
                <p><?php echo $about['content']; ?> </p>
            </div>
        </div>
    </section>
<style type="text/css">
  .line{
    height: 3px;
    width: 100px;
    background-color: #BD0E0E;
    display: inline-table;
    margin-bottom: 15px;
  }
    div.col.col-md-12.col-sm-12.col-xs-12.testimoni-box{
  background:rgba(200,200,200,0.4);

  border-radius:10px;
  padding:20px 15px;
  height:auto;
  max-height:150px;
  color:white;

}

section{
  padding: 2em 0;
}
section.testimonial{
  background-color:#4C0808;
  background-image: url('<?=base_url();?>assets/images/logo/parallax-4-home-main.jpg'); 
  background-attachment: fixed;
}
.testimonial .client-box h3{
  color: #ED0231;
  font-weight: bold;
  margin:  5px 0;
}
.testimonial .client-box h4{
  color: white;
  margin-top: 0;
}
.testimonial .triangle{
      width: 0;
    height: 0;
    border-left: 12px solid transparent;
    border-right: 12px solid transparent;
    border-top: 17px solid #E3E3E3;
   margin-top: -0.51px;
    right: 10px;
    margin-bottom: 15px;
    opacity: 0.4;
}
.testimonial .line{
  display: inline-table;
  width: 100px;
  height: 3px;
  background-color: white;
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
       <section class="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-md-12 top-white text-center">
                    <h2 class="text-center" style="color: white;">Testimoni </h2>
                    <div class="line"></div>
                </div>
                <div id="owl-demo">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  item">
                         <div class="col col-md-12 col-sm-12 col-xs-12 testimoni-box">
                              <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam</p>
                          </div>
                          <div class="col col-md-12 col-sm-12 col-xs-12 tex-left">
                            <div class="triangle"></div>
                          </div>
                          <div class="col col-md-8 col-sm-8 col-xs-8 client-box">
                              <h3>Dika Pratana</h3>
                              <h4>mahasiswa</h4></div>
                          <div class="col col-md-4 col-sm-4 col-xs-4 img-client-box"><img class="img-responsive img-client" src="<?=base_url();?>assets/images/logo/icon-user1.png"></div>
                      </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                        <div class="col col-md-12 col-sm-12 col-xs-12 testimoni-box">
                            <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam</p>
                        </div>
                        <div class="col col-md-12 col-sm-12 col-xs-12 tex-left">
                            <div class="triangle"></div>
                       </div>
                        <div class="col col-md-8 col-sm-8 col-xs-8 client-box">
                            <h3>Dika Pratana</h3>
                            <h4>mahasiswa</h4></div>
                        <div class="col col-md-4 col-sm-4 col-xs-4 img-client-box"><img class="img-responsive img-client" src="<?=base_url();?>assets/images/logo/icon-user1.png"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                        <div class="col col-md-12 col-sm-12 col-xs-12 testimoni-box">
                            <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam</p>
                        </div>
                        <div class="col col-md-12 col-sm-12 col-xs-12 tex-left">
                            <div class="triangle"></div>
                          </div>
                        <div class="col col-md-8 col-sm-8 col-xs-8 client-box">
                            <h3>Dika Pratana</h3>
                            <h4>mahasiswa</h4></div>
                        <div class="col col-md-4 col-sm-4 col-xs-4 img-client-box"><img class="img-responsive img-client" src="<?=base_url();?>assets/images/logo/icon-user1.png"></div>
                    </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                        <div class="col col-md-12 col-sm-12 col-xs-12 testimoni-box">
                            <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam</p>
                        </div>
                        <div class="col col-md-12 col-sm-12 col-xs-12 tex-left">
                            <div class="triangle"></div>
                          </div>
                        <div class="col col-md-8 col-sm-8 col-xs-8 client-box">
                            <h3>Dika Pratana</h3>
                            <h4>mahasiswa</h4></div>
                        <div class="col col-md-4 col-sm-4 col-xs-4 img-client-box"><img class="img-responsive img-client" src="<?=base_url();?>assets/images/logo/icon-user1.png"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="logo-comp">
      <div class="container">
            <div class="row">
                <div id="owl-demo">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  item">
                        <img class="img-responsive img-client" width="100px"  src="<?=base_url();?>assets/images/logo/Logo-Ristekdikti-Arza.jpg">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                        <img class="img-responsive img-client" src="<?=base_url();?>assets/images/logo/images_telkom.jpg">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                        <img class="img-responsive img-client" width="100px"  src="<?=base_url();?>assets/images/logo/Logo-Ristekdikti-Arza.jpg">
                    </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                        <img class="img-responsive img-client" src="<?=base_url();?>assets/images/logo/images_telkom.jpg">
                    </div>
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  item">
                        <img class="img-responsive img-client" width="100px"  src="<?=base_url();?>assets/images/logo/Logo-Ristekdikti-Arza.jpg">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                        <img class="img-responsive img-client" src="<?=base_url();?>assets/images/logo/images_telkom.jpg">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                        <img class="img-responsive img-client" width="100px"  src="<?=base_url();?>assets/images/logo/Logo-Ristekdikti-Arza.jpg">
                    </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                        <img class="img-responsive img-client" src="<?=base_url();?>assets/images/logo/images_telkom.jpg">
                    </div>
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  item">
                        <img class="img-responsive img-client"  width="100px" src="<?=base_url();?>assets/images/logo/Logo-Ristekdikti-Arza.jpg">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                        <img class="img-responsive img-client" src="<?=base_url();?>assets/images/logo/images_telkom.jpg">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                        <img class="img-responsive img-client"  width="100px" src="<?=base_url();?>assets/images/logo/Logo-Ristekdikti-Arza.jpg">
                    </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                        <img class="img-responsive img-client" src="<?=base_url();?>assets/images/logo/images_telkom.jpg">
                    </div>
                </div>
            </div>
        </div>
    </section>
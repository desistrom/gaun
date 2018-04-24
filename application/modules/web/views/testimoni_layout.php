  <style type="text/css">
  	.testimoni .box-testimoni-left{
  background-color:white;
 
  width:11em;
  height:11em;
  box-shadow:1px 1px 18px 4px #bdbdbd;
  margin-top:-4.5em;
 
  text-align: center;
  border-radius: 50%;
  overflow: hidden;
  display: inline-block;
}

section.testimoni{
  background-color:#F2F2F2;
  padding-bottom:0em;
  margin-top: 6em;
}

div.sub-box-testimoni{
  background-color:white;
  padding:0 15px 2em 15px;
  text-align: center;
  
  height:28em;
  box-shadow: 1px 1px 18px 4px #bdbdbd;
  margin-bottom: 5em;
}
.title-page-news{
	padding-bottom: 3em;
}
.testimoni .content-testimoni{
  padding:1em 5em;
}

.text-bold{
  font-weight:bold;
}

span.website-testimoni{
  color:#D10909;
}

.testimoni .box-testimoni-right ul li{
  padding:5px 0;
}

.box-testimoni{
  padding:15px 4em;
}
.filter-box-mg-testimoni{
	text-align: center;
	display: inline-block;
}
@media(max-width:767px){
  .testimoni .content-testimoni{
  padding:1em;
}

}
@media(max-width:500px){
  .testimoni .content-testimoni{
  padding:1em 0;
}
.box-testimoni{
  padding:15px 1em;
}
}


  </style>

   <section class="testimoni">
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h1>Testimonial </h1></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 content-testimoni">
              
              <?php foreach ($testimoni as $key => $value) : ?>
                <div class="col col-md-6 col-sm-6 col-xs-12 box-testimoni">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sub-box-testimoni">
                        <div class="col col-md-12 col-sm-12 col-xs-12 text-center">
                            <div class="box-testimoni-left ">
                            	<div class="filter-box-mg-testimoni">
                            		<img class="img-responsive" src="<?php echo $value['image']; ?>">
                            	</div>
                            </div>
                        </div>
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding box-testimoni-right">
                            <h4 class="text-bold title-box-testimoni" style="color: #CF090A;"><?php echo $value['user']; ?></h4>
                            <p class="text-bold" style="color: #747474;">Menteri Riset, Teknologi dan Pendidikan Tinggi Republik Indonesia </p>
                            <div style="color: #BDBDBD;"><i class="fa fa-quote-left"></i> <?php echo $value['testimoni']; ?> <i class="fa fa-quote-right"></i> </div>
                        </div>
                    </div>
                </div>
              <?php endforeach ?>
               
              
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </section>
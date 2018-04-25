<link rel="stylesheet" href="<?=base_url();?>assets/css/style_testimoni.min.css?t=<?=time();?>"> 

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
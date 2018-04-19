  <style type="text/css">
  	.keanggotaan .box-keanggotaan-left{
  background-color:white;
  padding:20px 15px;
  width:9em;
  height:9em;
  box-shadow:1px 1px 38px 4px #bdbdbd;
  margin-left:-4.5em;
  margin-top:1.1em;
  text-align: center;
}

section.keanggotaan{
  background-color:#F2F2F2;
  padding-bottom:0em;
  margin-top: 6em;
}

div.sub-box-keanggotaan{
  background-color:white;
  padding:2em 0;
  max-height:21em;
  height:15em;
}
.title-page-news{
	padding-bottom: 0;
}
.keanggotaan .content-keanggotaan{
  padding:1em 5em;
}

.text-bold{
  font-weight:bold;
}

span.website-anggota{
  color:#D10909;
}

.keanggotaan .box-keanggotaan-right ul li{
  padding:5px 0;
}

.box-keanggotaan{
  padding:15px 4em;
}
.filter-box-mg-keanggotaan{
	text-align: center;
	display: inline-block;
}
.keanggotaan .box-keanggotaan-right ul li ul li{
    padding:0; 
}
.logo-instansi{
    width: auto;
    max-width: 85px;
    height: auto;
    max-height: 85px;
}
@media(max-width:900px){
.keanggotaan .content-keanggotaan{
    padding: 5px 2em;
}
.box-keanggotaan{
    padding: 0 7px !important;
}
.keanggotaan .content-keanggotaan{
    padding: 15px;
}
.box-keanggotaan{
    padding: 0;
    margin: 15px 0;
}
div.sub-box-keanggotaan{
    height: auto;
    max-height: none;
    text-align: center;
    padding-bottom: 15px;
}
.box-keanggotaan-right{
    margin-top: 20px;
}
.keanggotaan .box-keanggotaan-left{
    margin-left: 0;
    display: inline-block;
}
}
@media(max-width:400px){
.keanggotaan .content-keanggotaan{
    padding: 15px;
}
.box-keanggotaan{
    padding: 0;
    margin: 15px 0;
}
div.sub-box-keanggotaan{
    height: auto;
    max-height: none;
    text-align: center;
    padding-bottom: 15px;
}
.box-keanggotaan-right{
    margin-top: 20px;
}
.keanggotaan .box-keanggotaan-left{
    margin-left: 0;
    display: inline-block;
}
}

  </style>

   <section class="keanggotaan">
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h1>Keanggotaan </h1></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 content-keanggotaan">
              
              <?php foreach ($keanggotaan as $key => $value) : ?>
                <div class="col col-md-6 col-sm-6 col-xs-12 box-keanggotaan">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sub-box-keanggotaan">
                        <div class="col col-md-3 col-sm-12 col-xs-12">
                            <div class="box-keanggotaan-left">
                            	<div class="filter-box-mg-keanggotaan">
                            		<img class="img-responsive logo-instansi" src="<?php echo $value['image_thumbnail']; ?>">
                            	</div>
                            </div>
                        </div>
                        <div class="col col-md-9 col-sm-12 col-xs-12 none-padding box-keanggotaan-right">
                            <h4 class="text-bold title-box-keanggotaan"><?php echo $value['instansi']; ?></h4>
                            <ul class="list-unstyled">
                                <li>
                                    <ul class="list-inline">
                                        <li><i class="fa fa-map-marker"></i></li>
                                        <li><?php echo $value['address']; ?></li>
                                    </ul>
                                </li>
                                <li>
                                    <ul class="list-inline">
                                        <li><i class="fa fa-phone"></i></li>
                                        <li><?php echo $value['number_phone']; ?></li>
                                    </ul>
                                </li>
                                <li>
                                    <ul class="list-inline">
                                        <li><i class="fa fa-laptop"></i></li>
                                        <li><a href="<?php echo $value['link']; ?>" class="website-anggota" style="color:#CF090A;text-decoration:none; "> <?php echo $value['link']; ?> </a></li>
                                    </ul>

                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
         <!--        <div class="col col-md-6 col-sm-6 col-xs-6 box-keanggotaan">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sub-box-keanggotaan">
                        <div class="col col-md-3 col-sm-3 col-xs-3">
                            <div class="box-keanggotaan-left">
                            	<div class="filter-box-mg-keanggotaan">
                            		<img class="img-responsive" src="<?=base_url();?>assets/images/logo/logo3.png">
                            	</div>
                            </div>
                        </div>
                        <div class="col col-md-9 col-sm-9 col-xs-9 none-padding box-keanggotaan-right">
                            <h4 class="text-bold title-box-keanggotaan">Institut teknologi sepuluh Nopember</h4>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-map-marker"></i> Jl. Airlangga No. 4 - 6, Airlangga, Gubeng, Airlangga,Gubeng, Kota SBY, Jawa Timur 60115</li>
                                <li><i class="fa fa-phone"></i> Telp. (031) 5915551, 5914042 ext. 227</li>
                                <li><i class="fa fa-laptop"></i><span class="website-anggota"> www.unair.ac.id </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col col-md-6 col-sm-6 col-xs-6 box-keanggotaan">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sub-box-keanggotaan">
                        <div class="col col-md-3 col-sm-3 col-xs-3">
                            <div class="box-keanggotaan-left">
                            	<div class="filter-box-mg-keanggotaan">
                            		<img class="img-responsive" src="<?=base_url();?>assets/images/logo/logo4.png">
                            	</div>
                            </div>
                        </div>
                        <div class="col col-md-9 col-sm-9 col-xs-9 none-padding box-keanggotaan-right">
                            <h4 class="text-bold title-box-keanggotaan">Institut teknologi sepuluh Nopember</h4>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-map-marker"></i> Jl. Airlangga No. 4 - 6, Airlangga, Gubeng, Airlangga,Gubeng, Kota SBY, Jawa Timur 60115</li>
                                <li><i class="fa fa-phone"></i> Telp. (031) 5915551, 5914042 ext. 227</li>
                                <li><i class="fa fa-laptop"></i><span class="website-anggota"> www.unair.ac.id </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col col-md-6 col-sm-6 col-xs-6 box-keanggotaan">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sub-box-keanggotaan">
                        <div class="col col-md-3 col-sm-3 col-xs-3">
                            <div class="box-keanggotaan-left">
                            	<div class="filter-box-mg-keanggotaan">
                            		<img class="img-responsive" src="<?=base_url();?>assets/images/logo/logo5.png">
                            	</div>
                            </div>
                        </div>
                        <div class="col col-md-9 col-sm-9 col-xs-9 none-padding box-keanggotaan-right">
                            <h4 class="text-bold title-box-keanggotaan">Institut teknologi sepuluh Nopember</h4>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-map-marker"></i> Jl. Airlangga No. 4 - 6, Airlangga, Gubeng, Airlangga,Gubeng, Kota SBY, Jawa Timur 60115</li>
                                <li><i class="fa fa-phone"></i> Telp. (031) 5915551, 5914042 ext. 227</li>
                                <li><i class="fa fa-laptop"></i><span class="website-anggota"> www.unair.ac.id </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col col-md-6 col-sm-6 col-xs-6 box-keanggotaan">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sub-box-keanggotaan">
                        <div class="col col-md-3 col-sm-3 col-xs-3">
                            <div class="box-keanggotaan-left">
                            	<div class="filter-box-mg-keanggotaan">
                            		<img class="img-responsive" src="<?=base_url();?>assets/images/logo/logo6.png">
                            	</div>
                            </div>
                        </div>
                        <div class="col col-md-9 col-sm-9 col-xs-9 none-padding box-keanggotaan-right">
                            <h4 class="text-bold title-box-keanggotaan">Institut teknologi sepuluh Nopember</h4>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-map-marker"></i> Jl. Airlangga No. 4 - 6, Airlangga, Gubeng, Airlangga,Gubeng, Kota SBY, Jawa Timur 60115</li>
                                <li><i class="fa fa-phone"></i> Telp. (031) 5915551, 5914042 ext. 227</li>
                                <li><i class="fa fa-laptop"></i><span class="website-anggota"> www.unair.ac.id </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col col-md-6 col-sm-6 col-xs-6 box-keanggotaan">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sub-box-keanggotaan">
                        <div class="col col-md-3 col-sm-3 col-xs-3">
                            <div class="box-keanggotaan-left">
                            	<div class="filter-box-mg-keanggotaan">
                            		<img class="img-responsive" src="<?=base_url();?>assets/images/logo/logo7.png">
                            	</div>
                            </div>
                        </div>
                        <div class="col col-md-9 col-sm-9 col-xs-9 none-padding box-keanggotaan-right">
                            <h4 class="text-bold title-box-keanggotaan">Institut teknologi sepuluh Nopember</h4>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-map-marker"></i> Jl. Airlangga No. 4 - 6, Airlangga, Gubeng, Airlangga,Gubeng, Kota SBY, Jawa Timur 60115</li>
                                <li><i class="fa fa-phone"></i> Telp. (031) 5915551, 5914042 ext. 227</li>
                                <li><i class="fa fa-laptop"></i><span class="website-anggota"> www.unair.ac.id </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col col-md-6 col-sm-6 col-xs-6 box-keanggotaan">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sub-box-keanggotaan">
                        <div class="col col-md-3 col-sm-3 col-xs-3">
                            <div class="box-keanggotaan-left">
                            	<div class="filter-box-mg-keanggotaan">
                            		<img class="img-responsive" src="<?=base_url();?>assets/images/logo/logo8.png">
                            	</div>
                            </div>
                        </div>
                        <div class="col col-md-9 col-sm-9 col-xs-9 none-padding box-keanggotaan-right">
                            <h4 class="text-bold title-box-keanggotaan">Institut teknologi sepuluh Nopember</h4>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-map-marker"></i> Jl. Airlangga No. 4 - 6, Airlangga, Gubeng, Airlangga,Gubeng, Kota SBY, Jawa Timur 60115</li>
                                <li><i class="fa fa-phone"></i> Telp. (031) 5915551, 5914042 ext. 227</li>
                                <li><i class="fa fa-laptop"></i><span class="website-anggota"> www.unair.ac.id </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col col-md-6 col-sm-6 col-xs-6 box-keanggotaan">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding sub-box-keanggotaan">
                        <div class="col col-md-3 col-sm-3 col-xs-3">
                            <div class="box-keanggotaan-left">
                            	<div class="filter-box-mg-keanggotaan">
                            		<img class="img-responsive" src="<?=base_url();?>assets/images/logo/logo2.png">
                            	</div>
                            </div>
                        </div>
                        <div class="col col-md-9 col-sm-9 col-xs-9 none-padding box-keanggotaan-right">
                            <h4 class="text-bold title-box-keanggotaan">Institut teknologi sepuluh Nopember</h4>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-map-marker"></i> Jl. Airlangga No. 4 - 6, Airlangga, Gubeng, Airlangga,Gubeng, Kota SBY, Jawa Timur 60115</li>
                                <li><i class="fa fa-phone"></i> Telp. (031) 5915551, 5914042 ext. 227</li>
                                <li><i class="fa fa-laptop"></i><span class="website-anggota"> www.unair.ac.id </span></li>
                            </ul>
                        </div>
                    </div>
                </div> -->
             
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <?php echo $this->pagination->create_links(); ?>
        </div>
    </section>
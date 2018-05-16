<!--      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
   <link href="https://fonts.googleapis.com/css?family=Nunito|Nunito+Sans:300,600,700" rel="stylesheet">
   <link rel="stylesheet" href="<?=base_url();?>assets/css/style_penta.min.css?t=<?=time();?>">

    <section class="detail_layanan">
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h1 style="">Pentahelix </h1></div>
            </div>
        </div>
        <div class="container-fluid content-pentahelix">
            <div class="row content">
            	<div class="col col-md-12 col-sm-12 col-xs-12 content-top">
            		<div class="col col-md-12 col-sm-12 col-xs-12 desc-content">
            			<p><?=$penta['deskripsi'];?></p>
            		</div>
            		<div class="col col-md-12 col-sm-12 col-xs-12 header-fitur-content">
            			<h3><b>Kompnen Platform :</b></h3>
            		</div>
            		<?php foreach ($helix as $key => $value): ?>
                    <div class="col col-md-4 col-sm-4 col-xs-12 fitur-content">
                        <div class="fitur-box text-center">
                            <div class="icon-box"><i class="glyphicon <?php if($value['jenis'] == 2){ ?> glyphicon-link <?php }elseif($value['jenis'] == 3){ ?> glyphicon-search <?php }else{ ?> glyphicon-education <?php } ?>"></i><!-- <i class="glyphicon glyphicon-education"></i> --></div>
                            <h3><b><?=$value['judul'];?></b></h3>
                            <p><?=$value['deskripsi'];?></p>
                        </div>
                    </div>    
                <?php endforeach ?>
            	</div>
           
            </div>
        </div>
        <div class="container-fluid content-pentahelix  content-pentahelix_2 ">
              <div class="col col-md-12 col-sm-12 col-xs-12 content-bottom">
                <div class="panel-group text-center" id="accordion">
                          <?php foreach ($instansi as $key => $value): ?>
                            <div class="panel" style=" text-align: left;">
                                <div class="panel-heading" >
                                    <h4 class="panel-title">
                                      <span><i class="<?=$value['icon'];?>"></i></span>
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$key;?>" style="text-decoration: none;"><b><?=$value['nm_jenis_instansi']?></b></a>
                                  </h4>
                                    
                                </div>
                                <div id="collapse<?=$key;?>" class="panel-collapse collapse <?php if($key == 0){ ?> in <?php } ?>">
                                    <div class="panel-body">
                                        <p>
                                            <?=$value['deskripsi'];?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                          <?php endforeach ?>
                                </div>
              </div> 
        </div>

    </section>
   
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> -->
     <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        console.log($('.in').parent());
        // if ($(this).parent().parent().parent().find('.in').length > 0) {
            $('.in').parent().css('width','100%');
        // }
        $('.accordion-toggle').click(function(){
            $('.panel').css('width','60%');
          if ($(this).parent().parent().parent().find('.in').length > 0) {
            $(this).parent().parent().parent().css('width','60%');
          }else{
            $(this).parent().parent().parent().css('width','100%');
          }
        });
      });
    </script>
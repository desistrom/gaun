<link  href="<?=base_url();?>assets/share_link/css/social-share-kit.css" rel="stylesheet" >
<style type="text/css">
    .box-news{
        padding: 0 6em;
    }
    .list-inline li{
    	display: inline;
    }
    .sosmed_share{
    	padding: 10px;
    	font-size: 16px;
    	border-radius: 50%;
    	background-color: #D2D2D2;
    	color: #747474;
    	box-shadow: -1px 1px 1px 0 #bdbdbd;

    }
     .sosmed_share:hover{
    	background-color: #CF090A;
    	color: white;
    	box-shadow: -1px 1px 3px 0 #bdbdbd;

    }
    .sosmed_share.fb{
    	padding: 10px 13px;
    }
     .sosmed_share.ig{
    	padding: 10px 12px;
    }
    .detail_news{
        margin-top: 6em;
    }
    @media (max-width: 991px)
    {
         .box-news{
        padding: 0 4em;
    }
    }
    @media (max-width: 767px){
         .box-news{
        padding: 0 ;
    }
    .content-comment a.btn.btn-post{
        padding: 10px 15px;
        font-size: 16px;
    }
    }
      @media(max-width:500px){
          .detail_news{
        margin-top: 4em;
    }
        .title-page-news{
            padding-top: 1em;
        }
    }
</style>
<section class="detail_news" style="">
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h1>Berita </h1></div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row content-news">
                <div class="col-md-3 col-sm-4 col-xs-12 content-right">
                    <div class="filter-side-bar">
                        <h3 class="categoery">Recent News</h3>
                        <div class="line-category-title"></div>
                        <ul class="list-unstyled list-category">
                            <?php for ($i=0; $i < 5 ; $i++) { ?>
                            <li class="active"><a href="<?php if(isset($news[$i])){ echo site_url('berita').'/'.$news[$i]['sumber']; } ?>"> <?php if(isset($news[$i])){ echo $news[$i]['title']; } ?> </a></li>
                        <?php } ?>
                        </ul>
                         
                    </div>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-12 content-left box-news">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding img-news"><img class="img-responsive" src="<?php $c = explode('/', $detail_news['gambar']); if(isset($c[1])){ echo $detail_news['gambar']; }else{ if ($detail_news['gambar'] =='') { echo base_url()."assets/images/logo/IDREN-2.png";}else{ echo base_url().'assets/media/'.$detail_news['gambar']; }} ?>">
                        <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                        	<div class="col col-md-7 col-sm-7 col-xs-12"></div>
                            <h4 class="title-news"><?php echo $detail_news['title']; ?></h4>
                            <p class="isi-news"><?php echo $detail_news['news_content'] ?> </p>
                            
                            <div class="col col-md-12 col-sm-12 col-xs-12 filter-date-event" >
                            	<ul class="list-inline date_event" style="margin-bottom: 1.5em;">
                                    <a href="" data-url="<?=site_url('web/news/get_news').'/'.$detail_news['sumber'];?>" class="ssk ssk-facebook"></a>
                                    <a href="" class="ssk ssk-twitter" data-url="<?=site_url('web/news/get_news').'/'.$detail_news['sumber'];?>"></a>
                                    <!-- <a href="http://www.facebook.com/sharer.php?u=<?=site_url('web/news/get_news').'/'.$detail_news['sumber'];?>">hmm</a> -->
                                </ul>
                                <ul class="list-inline date_event">
                                    <li><i class="glyphicon glyphicon-calendar"></i><?php echo date('d M Y', strtotime($detail_news['tanggal'])); ?></li>
                                    <li><i class="glyphicon glyphicon-briefcase"></i> <?php echo $detail_news['kategori'];?></li>
                                    <li><i class="fa fa-link"></i> <?php echo $detail_news['sumber'];?></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid content-comment">
        <div class="row sub-content-comment">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2>Comment </h2></div>
            <div class="col-md-5 col-sm-12 col-xs-12 sub-comment">
                <div class="col col-md-12 col-sm-12 col-xs-12 none-padding filter-comment">
                    <?php if(isset($comment)){ foreach ($comment as $key => $value): ?>
                    <div class="comment-left col col-md-2 col-sm-2 col-xs-2 none-padding">
                        <div class="user text-center"><i class="fa fa-user"></i></div>
                    </div>
                    <div class="comment-right col col-md-10 col-sm-12 col-xs-12">
                        <h4><?=$value['nama'];?><span class="date-comment"><!-- <?=$value['email'];?> --></span></h4>
                        <p><?=$value['content'];?></p>
                    </div>
                    <?php endforeach; } ?>
                </div>
            </div>
            <div class="col-md-7 col-sm-12 col-xs-12 right-comment">
                <div class="sub-comment-right">
                    <form id="form_comment">
                        <div class="form-group">
                            <h2>Leave a Comment</h2>
                            <p>Yout email address will not be published . Required fields are marked*</p>
                            <div class="text-input">
                                <input type="text" name="nama" placeholder="Name" class="input-comment">
                                <div class="error" id="ntf_nama"></div>
                            </div>
                            <div class="text-input">
                                <input type="text" name="email" placeholder="Email" class="input-comment">
                                <div class="error" id="ntf_email"></div>
                            </div>
                            <!-- <div class="text-input">
                                <input type="text" nam placeholder="Website" class="input-comment">
                            </div> -->
                            <div class="text-input">
                                <p>Paragraph</p>
                                <textarea name="content"></textarea>
                                <div class="error" id="ntf_content"></div>
                            </div>
                            <div class="form-group" style="display: block;">
                              <?php echo $captcha // tampilkan recaptcha ?>
                              <div class="error" id="ntf_g-recaptcha-response" style="position: relative;"></div>
                            </div>
                            <input type="hidden" name="id_berita" value="<?=$detail_news['sumber'];?>">
                            <div class="text-right"><button class="btn btn-post" type="button">Post Comment</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var base_url = "<?=base_url();?>";
            $('body').on('click','.btn-post',function(){
                $.ajax({
                      url : base_url+"web/news/comment",
                      dataType : 'json',
                      type : 'POST',
                      data : $('#form_comment').serialize()
                  }).done(function(data){
                      console.log(data);
                      if(data.state == 1){
                        if (data.status == 1) {
                          window.location.href = window.location.href;
                          // $('#form_comment')[0].reset();
                        }
                      }
                        $.each(data.notif,function(key,value){
                        $('.error').show();
                        $('#ntf_'+ key).html(value);
                        $('#ntf_'+ key).css({'color':'white', 'font-style':'italic'});
                        });
                        grecaptcha.reset();
                  });
            });
        });
    </script>
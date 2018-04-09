<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css"><

        /*style recent news*/
        .recent-news{
            background-color: white;
            height: auto;
            padding-bottom: 30px;
    
        }
        
         .recent-news .top{
            text-align: center;
            color: black;
            margin: 60px 0 40px 0;
        }
         .recent-news .top span{
            color: #1196CC;
        }
        .recent-news .top h4{
            color: #7F7F7F;
        }
        .recent-news .bottom .box {
            margin-bottom: 15px;
        }
        .recent-news .bottom .box .head img{
            width: 100%;
        }
        .recent-news .bottom .box .head ul{
            padding-left: 0;
            background-color:#020202; 
            width: 100%;
            text-align: center;
            margin: 0;
            padding: 10px 0;
        }
        .recent-news .bottom .box .head ul li{
            display: inline;
            color: white;

        }
        .recent-news .bottom .box .head ul li i{
            margin-left: 10px;
            
        }
        .recent-news .bottom .box .body {
            padding: 10px 15px 20px 15px;
            background-color: #F7F7F7;
            width: 100%;
            height: 13em;
        }
        .recent-news .bottom .box .body h4 a{
            color: black;
            text-decoration: none;
        }
        .recent-news .bottom .box .body h4 a:hover{
            color: #9C9C9C;
        }
        .recent-news .bottom .box .body p{
            margin:  10px 0;
            font-size: 15px;
            color: #787879; 
        }
        .recent-news .bottom .box .body .btn{
            padding: 5px 20px;
            background-color:  #B7090A;
            border:none;
            border-radius: 3px;
            margin-top: 20px;
            position: absolute;
            bottom: 2.5em;
        }
        .recent-news .bottom .box .body .btn:hover,
        .recent-news .bottom .box .body .btn:active,
        .recent-news .bottom .box .body .btn:focus,

        .recent-news .bottom .box .body .btn:active:focus{
            background-color: #930404;

        }
        .recent-news .bottom .box .body .btn:hover a{

        }
                /*style artikel*/
        .detail-artikel {
    background-color: #FFFFFF;
    height: auto;
    overflow: hidden;
    /*padding: 0 30px 0 15px;*/
  }
  .img-artikel{
    height: auto;
    min-height: 213px;
    max-height: 213px;
    width: 362px;
  }
     .sidebar{
        background-color: #FFFFFF;
        height: auto;
        overflow: hidden;
        float: left;
      }
    .sidebar .sidebar-top ul{
        padding: 0;
      }
 .sidebar .sidebar-top ul a{
         text-decoration: none;
      }
     .sidebar .sidebar-top ul li{
        list-style: none;
        padding: 15px 5px;
        color: #A5A5A5;
        border-bottom: dashed #A5A5A5 1px;
      }
    .sidebar .sidebar-top ul li:hover{
        background-color: ;
        color: #E72A2A;
      }
     .sidebar .sidebar-top ul h4{
        border-bottom: solid #B7090A 3px;
        color: black;
        padding: 15px 0;
      }





</style>
<section> 
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 top" style="margin-top: 6em;">
    <h2> <span>News</span></b></h2>
    
</div>
<div class="col col-md-3 col-sm-3 sidebar">
    <div class="sidebar-top">
      <ul>
       <h4><b>Categoris</b></h4>
        <a href="#"><li>Creative(19)</li></a>
        <a href="#"><li>Potfolio(21)</li></a>
        <a href="#"><li>Fitness(15)</li></a>
        <a href="#"><li>Gym(35)</li></a>
        <a href="#"><li>Personal(16)</li></a>
      </ul>
    </div>
        <div class="sidebar-top">
      <ul>
       <h4><b>Lates Post</b></h4>
        <a href="#"><li>Creative(19)</li></a>
        <a href="#"><li>Potfolio(21)</li></a>
        <a href="#"><li>Fitness(15)</li></a>
        <a href="#"><li>Gym(35)</li></a>
        <a href="#"><li>Personal(16)</li></a>
      </ul>
    </div>
</div> 
<div class=" col col-md-9 col-sm-9 col-xs-12 recent-news" id="blog">
    <div class="container-fluid">
        <div id="">

            <?php foreach ($news as $key => $value) :?>
            <div class="item">
                    <div class="col-md-6 col-sm-6 bottom">
                        <div class="box">
                            <div class="head">
                                <div class="col"><img class="img-artikel" src="<?php echo $value['gambar']; ?>"></div>
                                <ul>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('d m Y', strtotime($value['tanggal'])); ?></li>
                                    <li><i class="fa fa-weixin" aria-hidden="true"></i> 100 Coments</li>
                                    <li><i class="fa fa-heart-o" aria-hidden="true"></i> 100 Likes</li>

                                </ul>
                            </div>
                            <div class="body">
                                <h4><a href="#"><b><?php echo $value['title']; ?></b></a></h4>
                                <p><?php echo word_limiter($value['news_content'],12); ?></p>
                                <a href="<?php echo site_url('web/news/get_news') ?>" class="btn btn-primary">Read More</a>
                            </div>

                        </div>
                    </div>
            </div>
        <?php endforeach; ?>
            <!-- <div class="item">
                    <div class="col-md-6 col-sm-6 bottom">
                        <div class="box">
                            <div class="head">
                                <div class="col"><img src="<?=base_url();?>assets/images/logo/1.png"></div>
                                <ul>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> 24 November</li>
                                    <li><i class="fa fa-weixin" aria-hidden="true"></i> 100 Coments</li>
                                    <li><i class="fa fa-heart-o" aria-hidden="true"></i> 100 Likes</li>

                                </ul>
                            </div>
                            <div class="body">
                                <h4><a href="#"><b>This Is A Standart Post With<br> Thumbnail Image</b></a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias eius illum libero dolor nobis deleniti, sint assumenda. Pariatur iste veritatis excepturi, ipsa optio nobis</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>

                        </div>
                    </div>
            </div>

            <div class="item">
                    <div class="col-md-6 col-sm-6 bottom">
                        <div class="box">
                            <div class="head">
                                <div class="col"><img src="<?=base_url();?>assets/images/logo/1.png"></div>
                                <ul>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> 24 November</li>
                                    <li><i class="fa fa-weixin" aria-hidden="true"></i> 100 Coments</li>
                                    <li><i class="fa fa-heart-o" aria-hidden="true"></i> 100 Likes</li>

                                </ul>
                            </div>
                            <div class="body">
                                <h4><a href="#"><b>This Is A Standart Post With<br> Thumbnail Image</b></a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias eius illum libero dolor nobis deleniti, sint assumenda. Pariatur iste veritatis excepturi, ipsa optio nobis</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>

                        </div>
                    </div>
            </div>
            <div class="item">
                    <div class="col-md-6 col-sm-6 bottom">
                        <div class="box">
                            <div class="head">
                                <div class="col"><img src="<?=base_url();?>assets/images/logo/1.png"></div>
                                <ul>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> 24 November</li>
                                    <li><i class="fa fa-weixin" aria-hidden="true"></i> 100 Coments</li>
                                    <li><i class="fa fa-heart-o" aria-hidden="true"></i> 100 Likes</li>

                                </ul>
                            </div>
                            <div class="body">
                                <h4><a href="#"><b>This Is A Standart Post With<br> Thumbnail Image</b></a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias eius illum libero dolor nobis deleniti, sint assumenda. Pariatur iste veritatis excepturi, ipsa optio nobis</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>

                        </div>
                    </div>
            </div>
 -->

        </div>
    </div>
</div>
        </div>
    </div>
</section>
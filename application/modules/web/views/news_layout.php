    <style type="text/css">
        .img-news img{
            width: 100%;
            min-height: 290px;
            max-height: 290px;
        }
        .news{
            margin-top: 6em;
        }
    </style>
    <section class="news">
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h1>Blog </h1></div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row content-news">
                <div class="col-md-3 col-sm-4 col-xs-12 content-right">
                    <div class="filter-side-bar">
                        <h3 class="categoery">Recent News</h3>
                        <div class="line-category-title"></div>
                        <ul class="list-unstyled list-category">
                            <li class="active"><a href="#" class="active">Nota Kesepahaman </a></li>
                            <li class="active"><a href="#">Bertemu dengan kemenristekdikti</a></li>
                            <li class="active"><a href="#">Membahas Arsitektur dan tata kelola</a></li>
                            <li class="active"><a href="#">Pertemuan Awal Menggagas IDren</a></li>
                        </ul>
                    </div>
                    <div class="filter-side-bar">
                        <h3 class="categoery">Recent Comment</h3>
                        <div class="line-category-title"></div>
                        <ul class="list-unstyled list-category">
                            <li><a href="#">Wahyu IS On Nota Kesepahaman</a></li>
                        </ul>
                    </div>
                    <div class="filter-side-bar">
                        <h3 class="categoery">Archieve </h3>
                        <div class="line-category-title"></div>
                        <ul class="list-unstyled list-category">
                            <li><a href="#">11 April 2018</a></li>
                            <li><a href="#">11 April 2018</a></li>
                            <li><a href="#">11 April 2018</a></li>
                            <li><a href="#">11 April 2018</a></li>
                        </ul>
                    </div>
                    <div class="filter-side-bar">
                        <h3 class="categoery">Category </h3>
                        <div class="line-category-title"></div>
                        <ul class="list-unstyled list-category">
                            <li><a href="#">Event </a></li>
                            <li><a href="#">Rapat </a></li>
                        </ul>
                    </div>
                    <div class="filter-side-bar">
                        <h3 class="categoery">Category </h3>
                        <div class="line-category-title"></div>
                        <ul class="list-unstyled list-category">
                            <li><a href="#">Login </a></li>
                            <li><a href="#">Entries RSS</a></li>
                            <li><a href="#">Comments RSS</a></li>
                            <li><a href="#">WordPress.org </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-12 content-left">
                    <?php foreach ($news as $key => $value) : ?>
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <div class="col col-md-6 col-sm-6 col-xs-6 none-padding img-news"><img class="img-responsive" src="<?php echo $value['gambar']; ?>"></div>
                        <div class="col col-md-6 col-sm-6 col-xs-6 desrip-news">
                            <h4 class="title-news"><?php echo $value['title']; ?></h4>
                             <?php echo word_limiter($value['news_content'],40); ?> 
                            
                            <ul class="list-inline date_event">
                                <li><i class="glyphicon glyphicon-calendar"></i><?php echo date('d m Y', strtotime($value['tanggal'])); ?></li>
                                <li><i class="glyphicon glyphicon-briefcase"></i> <?php echo $value['kategori']; ?></li>
                            </ul>

                        </div>
                        <a href="<?=base_url();?>web/news/get_news?data=<?php echo $value['newsId']; ?>" class="btn btn-danger btn-read-more" type="button"  >Read More</a>
                    </div>
                <?php endforeach ?>
    
               </div>
            </div>
        </div>
        <div class="container-fluid section-pagination">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <ul class="list-inline pagination list-pagination">
                        <li> <i class="fa fa-angle-left"></i> Prev</li>
                        <li class="active">1 </li>
                        <li>2 </li>
                        <li>3 </li>
                        <li>4 </li>
                        <li>5 </li>
                        <li>6 </li>
                        <li>7 </li>
                        <li>Next <i class="fa fa-angle-right"></i></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<section class="detail_news" style="margin-top: 6em;">
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
                            <li class="active"><a href="<?php echo site_url('web/news/get_news').'?data='.$news[$i]['newsId']; ?>"> <?php echo $news[$i]['title']; ?> </a></li>
                        <?php } ?>
                        </ul>
                         
                    </div>
                   <!--  <div class="filter-side-bar">
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
                    </div> -->
                 <!--    <div class="filter-side-bar">
                        <h3 class="categoery">Meta </h3>
                        <div class="line-category-title"></div>
                        <ul class="list-unstyled list-category">
                            <li><a href="#">Login </a></li>
                            <li><a href="#">Entries RSS</a></li>
                            <li><a href="#">Comments RSS</a></li>
                            <li><a href="#">WordPress.org </a></li>
                        </ul>
                    </div> -->
                </div>
                <div class="col-md-9 col-sm-8 col-xs-12 content-left">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding img-news"><img class="img-responsive" src="<?php echo $detail_news['gambar']; ?>">
                        <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                            <h4 class="title-news"><?php echo $detail_news['title']; ?></h4>
                            <p class="isi-news"><?php echo $detail_news['news_content'] ?> </p>
                            <div class="col col-md-12 col-sm-12 col-xs-12 filter-date-event">
                                <ul class="list-inline date_event">
                                    <li><i class="glyphicon glyphicon-calendar"></i><?php echo date('d m Y', strtotime($detail_news['tanggal'])); ?></li>
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
                    <div class="comment-left col col-md-2 col-sm-2 col-xs-2 none-padding">
                        <div class="user text-center"><i class="fa fa-user"></i></div>
                    </div>
                    <div class="comment-right col col-md-10 col-sm-12 col-xs-12">
                        <h4>Wahyu Kurniawan<span class="date-comment">11 Apri 2018</span></h4>
                        <p>Mohon info untuk tergabung dengan IDren,tx</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12 col-xs-12 right-comment">
                <div class="sub-comment-right">
                    <div class="form-group">
                        <h2>Leave a Comment</h2>
                        <p>Yout email address will not be published . Required fields are marked*</p>
                        <div class="text-input">
                            <input type="text" placeholder="Name" class="input-comment">
                        </div>
                        <div class="text-input">
                            <input type="text" placeholder="Email" class="input-comment">
                        </div>
                        <div class="text-input">
                            <input type="text" placeholder="Website" class="input-comment">
                        </div>
                        <div class="text-input">
                            <p>Paragraph</p>
                            <textarea></textarea>
                        </div>
                        <div class="text-right"><a href="#" class="btn btn-post">Post Comment</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
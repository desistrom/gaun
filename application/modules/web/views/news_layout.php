    <style type="text/css">
        .img-news img{
            width: 100%;
            min-height: 290px;
            max-height: 290px;
        }
        .news{
            margin-top: 6em;
        }
        #news .content-left{
            font-style: normal;
        }

    </style>
    <section class="news" id="news">
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h1 style="">Berita </h1></div>
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
                            <li class=""><a href="<?php if(isset($recent[$i])){ echo site_url('web/news/get_news').'?data='.$recent[$i]['newsId']; } ?>"> <?php if(isset($recent[$i])){ echo $recent[$i]['title']; } ?> </a></li>
                        <?php } ?>
                        </ul>
                    </div>
           <!--          <div class="filter-side-bar">
                        <h3 class="categoery">Recent Comment</h3>
                        <div class="line-category-title"></div>
                        <ul class="list-unstyled list-category">
                            <li><a href="#">Wahyu IS On Nota Kesepahaman</a></li>
                        </ul>
                    </div> -->
               <!--      <div class="filter-side-bar">
                        <h3 class="categoery">Archieve </h3>
                        <div class="line-category-title"></div>
                        <ul class="list-unstyled list-category">
                            <li><a href="#">11 April 2018</a></li>
                            <li><a href="#">11 April 2018</a></li>
                            <li><a href="#">11 April 2018</a></li>
                            <li><a href="#">11 April 2018</a></li>
                        </ul>
                    </div> -->
              <!--       <div class="filter-side-bar">
                        <h3 class="categoery">Category </h3>
                        <div class="line-category-title"></div>
                        <ul class="list-unstyled list-category">
                            <li><a href="#">Event </a></li>
                            <li><a href="#">Rapat </a></li>
                        </ul>
                    </div> -->
                   <!--  <div class="filter-side-bar">
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
                    <?php $this->load->view('news_looping', $news); ?>
    
               </div>
            </div>
        </div>
        <div class="ajax-load text-center" style="display:none">
            <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
        </div>
        <!-- <div class="container-fluid section-pagination">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center"> -->
                    <!-- <ul class="list-inline pagination list-pagination"> -->
                        <?php //echo $this->pagination->create_links(); ?>
                    <!-- </ul> -->
                <!-- </div>
            </div>
        </div> -->
    </section>
    <script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
    <script type="text/javascript">
        var page = 1;
        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                loadMoreData(page);
            }
        });


        function loadMoreData(page){
          $.ajax(
                {
                    url: '?page=' + page,
                    type: "get",
                    beforeSend: function()
                    {
                        $('.ajax-load').show();
                    }
                })
                .done(function(data)
                {
                    if(data == " "){
                        $('.ajax-load').html("No more records found");
                        return;
                    }
                    $('.ajax-load').hide();
                    $(".content-left").append(data);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                      alert('server not responding...');
                });
        }
    </script>
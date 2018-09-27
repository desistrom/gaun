   <style type="text/css">
.layanan .content-left{padding:3em 10em}.list-artikel{margin-bottom:7em}.layanan{background-color:#F2F2F2;height:auto}.img-news img{max-height:250px;width:250px}.filter-img-layanan{display:inline-block;overflow:hidden;margin-top:-5em;box-shadow:1px 1px 18px 4px #bdbdbd;background-color:white}.img-layanan{width:100%;height:100%}.btn-read-more{position:relative;right:0}@media(max-width:991px){.layanan .content-left{padding:3em 5em;margin-top:3em}}@media(max-width:500px){div.container-fluid.none-padding.filter-title-page-news{margin-top:0}.title-page-news{padding-top:0}.layanan .content-left{padding:3em 1em;margin-top:3em}.layanan{margin-top:3em}}

   </style>
   <section class="layanan">
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                <h1>EVENT </h1></div>
            </div>
       
             <div class="col-md-12 col-sm-12 col-xs-12 content-left text-center content-keanggotaan">
                <?php $this->load->view('looping_event', $page); ?> 
            </div> 
            <?php if ($total > $total_row){ ?>
                <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="padding-bottom: 15px;">
                    <button class="btn btn-danger loadmore" type="button">Load More</button>
                </div>
            <?php }else{ ?>
                <span class='btn btn-danger'>No Data found</span>
            <?php } ?>
            <div class="ajax-load text-center" style="display:none">
                <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More Data</p>
            </div>
        </div>
    </section>
    <script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
    <script type="text/javascript">
        var page = 0;
        $('.loadmore').click(function() {
                page++;
                loadMoreData(page);
                $('.content-keanggotaan').each(function() {
                    var text = $(this).html();
                    $(this).html(text.replace('null', '')); 
                });
        });


        function loadMoreData(page){
          $.ajax(
                {
                    url: '<?=site_url('web/event/');?>'+'?page=' + page,
                    type: "get",
                    dataType : 'text',
                    beforeSend: function()
                    {
                        $('.ajax-load').show();
                    }
                })
                .done(function(data)
                {
                
                    // console.log(data);
                    var ex = data.split("null");
                    // console.log(ex);
                    if(ex[1] == ""){
                        console.log('hmm');
                    }
                    if(ex[1] == ""){
                        $('.ajax-load').html("<span class='btn btn-danger'>No more Data found</span>");
                        $('.ajax-load').css({'margin-bottom' : '30px'});
                        $('.loadmore').css({'display' : 'none'});
                        return;
                    }
                    $('.ajax-load').hide();
                    if (ex[1] != "") {
                        $(".content-keanggotaan").append(ex[1]);
                        $('.content-keanggotaan').each(function() {
                            var text = $(this).html();
                            $(this).html(text.replace('null', '')); 
                        });
                        
                    }
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                      alert('server not responding...');
                });
        }
    </script>
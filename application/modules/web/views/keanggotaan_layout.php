<link rel="stylesheet" href="<?=base_url();?>assets/css/style_keanggotaan.min.css?t=<?=time();?>">
<link rel="stylesheet" href="<?=base_url();?>assets/css/style_keanggotaan_2.min.css?t=<?=time();?>">
   <section class="keanggotaan">
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h1>Member </h1></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 text-right sub-search">
                <div class="form-group">
                <form method="get" action="<?=site_url('web/keanggotaan/search')?>">
                    <div class="input-search input-search-left"><input type="text" class="form-control" name="data" id="search" placeholder="Cari"></div>
                    <div class="input-search input-search-right"><button type="submit" class="btn btn-danger btn-search"><i class="fa fa-search"></i></button></div>
                </form>
                  </div>
                  
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 content-keanggotaan">

              <?php $this->load->view('keanggotaan_looping', $keanggotaan); ?>

            </div>
            <?php if ($total > $total_row){ ?>
                <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="padding-bottom: 15px;">
                    <button class="btn btn-danger loadmore" type="button">Load More</button>
                </div>
            <?php } ?>
            <div class="ajax-load text-center" style="display:none">
                <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More Data</p>
            </div>
    </section>
    <script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
    <script type="text/javascript">
        var page = 1;
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
                    url: '<?=site_url('web/keanggotaan');?>'+'?page=' + page,
                    type: "get",
                    dataType : 'text',
                    beforeSend: function()
                    {
                        $('.ajax-load').show();
                    }
                })
                .done(function(data)
                {
                
                    console.log(data);
                    if(data == "null"){
                        $('.ajax-load').html("<span class='btn btn-danger'>No more Data found</span>");
                        $('.ajax-load').css({'margin-bottom' : '30px'});
                        $('.loadmore').css({'display' : 'none'});
                        return;
                    }
                    $('.ajax-load').hide();
                    if (data != "null") {
                        $(".content-keanggotaan").append(data);
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
        $(document).ready(function(){
        $('body').on('click','.btn-search',function(){
            var data = $('#search').val();
            if (data != '') {
                // window.location.href = '<?=base_url();?>web/galery/search_video?data='+data;
                $.ajax({
                url : '<?=base_url();?>web/keanggotaan/search?data='+data,
                type : 'POST',
                dataType : 'json',
                data :""
            }).done(function(data){
                console.log(data);
                $('.replace-content').html(data);
            });

            }
        });
    });
    </script>
<style type="text/css">
.header-title h2{
font-size: 50px;color: #BDBDBD;
}

   @media(max-width:500px){
  .title-page-news{
    margin-top: 0!important;
    padding-top: 1em;
  }
  .header-title h2{
    font-size: 30px;color: #BDBDBD;
    }
    .modal iframe{
        height: 260px;
    }
    }
@media(max-width:400px){

    .modal iframe{
        height: 260px !important;
    }
    }
</style>   

<link rel="stylesheet" href="<?=base_url();?>assets/css/style_list_video.min.css?t=<?=time();?>"> 
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h2 style="">Video </h2></div>
            </div>
        </div>
        <section class="content-video">
          <div class="container-fluid ">
            <div class="row">
              <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-video">
                <?php $this->load->view('video_looping', $video); ?>
              
              </div>
            <?php if ($total > $total_row){ ?>
                <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="padding-bottom: 15px;">
                    <button class="btn btn-danger loadmore" type="button">Load More</button>
                </div>
            <?php } ?>
            <div class="ajax-load text-center" style="display:none">
                <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More Data</p>
            </div>
            </div>
          </div>
          
        </section>


        <div class="modal fade modal-list-video" id="list-video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button class="close close-video" type="button" data-dismiss="modal" style="">×</button>
              <div class="modal-body-gallery"> 
              <iframe class="youtube-video" src="" id="tampil-video"></iframe>               
              </div>
            <div class="modal-footer" style="padding: 0 15px;">
              <div class="col col-md-12 col-sm-12 col-xs-12 none-padding">
                <div class="col col-md-6 col-sm-6 col-xs-6 none-padding">
                    <h5 class="date-upload text-left" id="image-gallery-title"></h5></div>
                <div class="col col-md-6 col-sm-6 col-xs-6 none-padding">
                    <h5 class="author text-right" id="image-gallery-date" ></h5></div>
                <div class="col col-md-12 col-sm-12 col-xs-12 none-padding text-left">

                    <p id="image-gallery-caption"></p>
                </div>
                <p id="image-gallery-user" style="text-align: right;"></p>
            </div>
          </div>
        </div>
    </div>
</div>
<!-- <script src="<?=base_url();?>assets/js/jquery.min.js"></script> -->
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script src="<?=base_url();?>assets/js/modal-custom.js"></script>
<script type="text/javascript">
	$('.close-video').click(function(){
	$('.youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
});
    $(document).ready(function(){
        $('.ajax-load').css({'margin-bottom' : '30px'});
      $("body").on('click','.show-video',function(){
        var file = $(this).attr('id')+'?enablejsapi=1&version=3&playerapiid=ytplayer';
          $('#list-video iframe').attr('src',file);
          console.log(file);
          $(".modal-list-video").modal('show');
      });
        var page = 0;
        $('.loadmore').click(function() {
                page++;
                loadMoreData(page);
                $('.list-video').each(function() {
                    var text = $(this).html();
                    $(this).html(text.replace('null', '')); 
                });
        });


        function loadMoreData(page){
          $.ajax(
                {
                    url: '<?=site_url('web/galery/list_video');?>'+'?page=' + page,
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
                        $(".list-video").append(data);
                        $('.list-video').each(function() {
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
    });
    </script>



   
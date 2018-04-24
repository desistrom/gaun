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
              <?php $this->load->view('keanggotaan_looping', $keanggotaan); ?>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="padding-bottom: 15px;">
                <button class="btn btn-danger loadmore" type="button">Load More</button>
            </div>
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
    </script>
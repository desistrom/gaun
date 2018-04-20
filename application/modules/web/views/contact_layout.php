    <style type="text/css">
        .img-news img{
            width: 100%;
            
        }
        .detail_layanan{
            margin-top: 6em;
            background-color: #F2F2F2;
        }
        div.row.content-news{
            background-color: #F2F2F2;
        }
        .list-artikel{
            padding: 3em 15px;
            background-image: url('<?=base_url();?>assets/images/logo/bg-form-comment.jpg');
        }
        form .text-input{
            margin: 2em 0;
        }
        .btn-send{
            background-color: white;
            color: #CF090A;
            padding: 1em 3em;
        }
        .btn-send:hover{
            background-color: white;
            color: #CF090A;
          
        }
        .content-left{
            padding: 15px;
        }
    </style>
    <section class="detail_layanan">
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h1 style=""> Contact Us </h1></div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row content-news">
                <div class="col col-md-2 col-sm-2 col-xs-2"></div>
                <div class="col-md-8 col-sm-8 col-xs-12 content-left">
                    <div class="col col-md-12 col-sm-12 col-xs-12 none-padding list-artikel">
                        <!-- h2 class="text-center" style="font-weight: bold;color: #9E9E9E;">Tentang IDren</h2> -->
                        <div class="col col-md-12 col-sm-12 col-xs-12 desrip-news">
                            <form class="form_contact">
                                
                                <p style="color: white;text-align: center;">Isilah form dibawah untuk mendapatkan info seputar IDren atau subyek lainnya. Pastikan Anda mengisi alamat email Anda dengan benar sehingga kami dapat membalas pesan Anda.</p>
                                <div class="text-input">
                                    <label style="color: white;">Name</label>
                                    <input class="form-control" type="text" name="name" placeholder="Name" class="input-comment">
                                    <div class="error" id="ntf_name"></div>
                                </div>
                                <div class="text-input">
                                    <label style="color: white;">Email</label>
                                    <input class="form-control" type="text" name="email" placeholder="Email" class="input-comment">
                                    <div class="error" id="ntf_email"></div>
                                </div>
                                <!-- <div class="text-input">
                                    <input class="form-control" type="text" placeholder="Website" class="input-comment">
                                </div> -->
                                <div class="text-input">
                                    <p style="color: white;">Pesan</p>
                                    <textarea class="form-control" name="pesan" style="height: 15em;"></textarea>
                                    <div class="error" id="ntf_pesan"></div>
                                </div>
                                <div class="text-right"><a class="btn btn-send">Send</a></div>
                            </div>
                            </form>
                            
                            
                            
                        </div>
                    </div>
                </div>
                <div class="col col-md-2 col-sm-2 col-xs-2"></div>
            </div>
        </div>

    </section>

     <div id="regSukses" class="modal fade modal-register" role="dialog" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">


        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="modal-title text-center" style="color:#CF090A; ">Pesan Berhasil terkirim</h2>
          </div>


        </div>

      </div>
    </div>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<script type="text/javascript">
   var base_url = "<?=base_url();?>"
    $(document).ready(function(){

      $('body').on('click','.btn-send', function(){
      $.ajax({
          url : base_url+"web/tentang/add_contact",
          dataType : 'json',
          type : 'POST',
          data : $('.form_contact').serialize()
      }).done(function(data){
          console.log(data);
          if(data.state == 1){
            if (data.status == 1) {
              $('#regSukses').modal('show');
              $('#form_contact')[0].reset();
            }else{
              $('.error_pass').show();
              $('.error_pass').css({'color':'white', 'font-style':'italic', 'text-align':'center'});
              console.log(data);
              $('.error_pass').html(data.error);
            }
          }
            $.each(data.notif,function(key,value){
            $('.error').show();
            $('#ntf_'+ key).html(value);
            $('#ntf_'+ key).css({'color':'white', 'font-style':'italic'});
            });
      });
    });

    });
 </script>
    <style type="text/css">
        .img-news img{
            width: 100%;
            
        }
        .detail_layanan{
            margin-top: 3em;
            padding: 7em 0;
            background-color: #F2F2F2;
        }
        div.row.content-news{
            background-color: #F2F2F2;
        }
         .content-error{
            padding: 0;
         }
        .content-error li{
            display: inline;
            color: red;
            font-size: 14px;
        }
        .btn-back{
            padding: 5px 130px;
        }
    </style>
    <section class="detail_layanan">
      <div class="container-fluid text-center" >
        <div style="display: inline-block;">
            <img src="<?=base_url();?>assets/images/logo/error.png">
            <ul class="content-error">
                <li><?php echo $error;?>.</li>
            </ul>
            <div>
                <a href="<?php echo site_url('user/login_user/'.$url);?>" class="btn btn-danger btn-back">Back</a>
            </div>
        </div>
      </div>
    </section>



<style type="text/css">
	.form-goup-file{
    height: auto;
    overflow: hidden;
    padding: 0;
  }
  .form-goup-file div{
    display: inline-block;
  }
  .form-goup-file .input-file-left{
    width: 100%;
  }
  .form-goup-file .input-file-left input{
  width: 100%;
  }
  .form-goup-file .input-file-right{
    position: absolute;
    left: 0;
    top: 0;
  }
  .form-goup-file .input-file-right .btn-choose-foto{
    height: 34px;
    width: 105px;
    border-radius: 0;
    padding-left: 7px;
  }
  .logo-fav{
    width: 100px;
  }
  .fa-upload{

  }
   .right-content .box-thumbnail .header-box-thumbnail{
    height: 150px;
    overflow: hidden;
    padding: 6px;
    position: relative;
   }
     .right-content .box-thumbnail .header-box-thumbnail .filter-button-action{
      

       top: 0;
       width: 100%;
       text-align: right;
     }
   .right-content .box-thumbnail .header-box-thumbnail .btn-action{
    height: 30px;
    width: 30px;
    background-color: #5AA7DF;
    box-shadow: 2px 2px 3px 0 #000000;
    border-radius: 50%;
    position: absolute;
    top: 0;
    right: -4em;
    margin:7px;
    transition: 0.4s;
    animation-delay: 0.2s;
    text-align: center;
   }
   .right-content .box-thumbnail .header-box-thumbnail .btn-action{
    padding-top: 6px;
    display: inline-block;
    color: white;
   }
    .right-content .box-thumbnail:hover .header-box-thumbnail .btn-action{
      right: 0;
      
    }
    .right-content .box-thumbnail:hover{
         box-shadow: 1px 1px 2px 0 #000000;
    }
   .right-content .box-thumbnail .header-box-thumbnail .btn-action a i{
    color: white;
   }
   .right-content .box-thumbnail .header-box-thumbnail .btn-action:hover{
    background-color: #247AB8;
   }
  .right-content .box-thumbnail .thumbnail-cover{
    width: 100%;
  }
   .right-content .box-thumbnail .body-box-thumbnail{
    padding: 0 10px;
   }
.right-content .box-thumbnail  .title-thumbnail a{
  text-decoration: none;
  text-align: center;
  color: #7B7B7B;
  font-size: 12px;
  font-weight: 600;
}
.right-content .box-thumbnail .body-box-thumbnail{
  color: #A2A2A2;
  font-size: 10px;
  font-weight: 400;
}
  .filter-cover-jurnal{
  border:solid 1px #A2A2A2;
  border-radius: 5px;
  padding: 10px;
  margin-top: 3em;
  display: inline-block;
  width: 100%;
}
  .filter-cover-jurnal img{
  width: 100%;
}
 .sub-right-content{
  padding: 3em;
}
 .sub-right-content h4{
  color: #545454;
  font-weight: 600;
}
.line-sub-title-jurnal{
  margin:15px 0;
  width: 150px;
  height: 3px;
  background-color: #A2A2A2;
}
 .list-info-jurnal{
  margin-bottom: 1em;
}
 .list-info-jurnal li{
  padding: 4px 0;
  color: #A2A2A2;
}
 .list-detail-jurnal li{
  padding: 5px 0;
  color: #A2A2A2;
}
 .list-detail-jurnal li a{
 text-decoration: underline;
  color: #A2A2A2;
}
..list-detail-jurnal li a:hover{
 
  color: #D10909;
}
.bg-red{
  background-color: #D10909;
  background:#D10909;

}
.text-red{
 color: #D10909;
}
.btn-upload{
  padding: 0px 15px;
}
</style>

<div class="col col-md-10 col-sm-10 col-xs-12 right-content" style="">
    <div class=" title-box">
		<h3 class="title">Detail Volume</h3>
    </div>
    <div class="box-content">
    	<div class="row">
    	     <div class="col col-md-12 col-sm-12 col-xs-2">
            <div class="col col-md-3 col-sm-4 col-xs-12 sub-left-content none-padding">
                  <div class="filter-cover-jurnal">
                    <img src="<?=base_url();?>assets/media/<?=$journal['futured_image']?>" class="cover-jurnal-img">
                  </div>
                </div>
                <div class="col col-md-9 col-sm-8 col-xs-12 sub-right-content">
                  <h4><?=$journal['judul']?></h4>
                  <div class="line-sub-title-jurnal"></div>
                  <ul class="list-unstyled list-info-jurnal">
                  <li>Volume : <?=$journal['volume'];?></li>
                    <li>Status : <?php if($journal['status'] == 0){ echo "Disabled";}elseif($journal['status'] == 1){ echo "Pending"; }else{ echo "Submited";} ?></li>
                    <!-- <li>Action : <?php if($journal['status'] == 0){ ?><a href="<?=site_url('journal/admin/submit/'.$journal['id_journal']);?>" class="btn btn-primary btn-upload"> <i class="fa fa-upload"></i> </a><?php }elseif($journal['status'] == 1){ ?><a href="#" class="btn btn-warning btn-clock-o"> <i class="fa fa-clock-o"></i> </a><?php }else{ ?><a href="#" class="btn btn-success btn-upload"> <i class="fa fa-check"></i> </a> <?php } ?></li> -->
                  </ul>
                  <ul class="list-unstyled list-detail-jurnal">
                  <?php foreach ($no_volume as $key => $value): ?>
                    <li><a href="<?=site_url('journal/admin/detail_no_volume/'.$value['id_no_volume']);?>">
                      Nomor Volume : <?=$value['nomor'];?>
                    </a></li>
                  <?php endforeach ?>
                    <!-- <li><a href="sub-detail.html">
                      Volume 2
                    </a></li>
                    <li><a href="sub-detail.html">
                      Volume 3
                    </a></li>
                    <li><a href="sub-detail.html">
                      Volume 4
                    </a></li> -->

                   
                    
                    

                  </ul>
                </div>
                


           </div>
    		</div>

    </div>
</div>


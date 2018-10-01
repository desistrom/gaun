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
    padding-right: 10px;
  }
   .right-content .box-thumbnail .header-box-thumbnail{
    height: 150px;
    overflow: hidden;
    padding: 6px;
    position: relative;
    background-color: white;
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
    padding: 10px 10px;
    background-color: white;
margin-top: -11px;
   }
   .right-content .box-thumbnail .footer-box-thumbnail{
    padding: 5px 10px;
    background-color: #F7F7F7;

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
.right-content .box-thumbnail{
   background-color: #F7F7F7
}
.sub-footer-box-thumbnail{
  display: inline-block;
}
.sub-footer-box-thumbnail .btn{
  padding-top: 2px;
  padding-bottom: 0;
  margin-top: 5px;
}
.float-right{
  float: right;
}
.btn-upload{
  display: none;
}
</style>

<div class="col col-md-10 col-sm-10 col-xs-12 right-content" style="">
    <div class=" title-box">
		<h3 class="title">Jurnal</h3>
    </div>
    <div class="box-content">
    	<div class="row">
    	     <div class="col col-md-12 col-sm-12 col-xs-2">
            <div class="col col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 30px;">
              <a href="<?=site_url('user/journal/add');?>" class="btn btn-success">Add Jurnal</a>
            </div>
            <?php foreach ($journal as $key => $value): ?>
              <div class="filter-box-thumbnail col-md-3 col-sm-3 col-xs-12 " style="">
                  <div class="box-thumbnail">
                    <div class="header-box-thumbnail">
                      <img class="thumbnail-cover" src="<?=base_url();?>assets/media/<?=$value['futured_image'];?>">
                      <div class="filter-button-action">
                        <div>
                          <a href="<?=site_url('user/journal/edit/'.$value['id_journal']);?>">
                            <div class="btn-action">
                              <i class="fa fa-pencil"></i>
                              
                            </div>
                          </a>
                        </div>
                        <div>
                          <!-- <div class="btn-action">
                            <a href="#"><i class="fa fa-pencil"></i></a>
                            
                          </div> -->
                        </div>
                      </div>
                    </div>
                    <div class="body-box-thumbnail">
                      <h5 class="title-thumbnail"><a href="<?=site_url('user/journal/detail_journal/'.$value['id_journal']);?>"><?=$value['judul'];?></a></h5>
                      <h6><?=$value['jumlah'];?> Volume</h6>
                    </div>
                    <div class="footer-box-thumbnail">
                      <div class="sub-footer-box-thumbnail">
                        <h5>status : publish</h5>
                      </div>
                      <div class="sub-footer-box-thumbnail float-right" >
                        <a href="#" class="btn btn-warning btn-clock-o"> <i class="fa fa-clock-o"></i> </a>
                        <a href="#" class="btn btn-success btn-upload"> <i class="fa fa-check"></i> </a>
                      </div>
                      
                    </div>
                  </div>
              </div>
              
            <?php endforeach ?>
              <!-- <div class="filter-box-thumbnail col-md-3 col-sm-3 col-xs-12 " style="">
                <div class="box-thumbnail">
                  <div class="header-box-thumbnail">
                    <img class="thumbnail-cover" src="<?=base_url();?>mockup_statis/assets/img/jur-3.jpg">
                    <div class="filter-button-action">
                      <div>
                        <a href="#">
                          <div class="btn-action">
                            <i class="fa fa-pencil"></i>
                            
                          </div>
                        </a>
                      </div>
                      <div>
                      </div>
                    </div>
                  </div>
                  <div class="body-box-thumbnail">
                    <h5 class="title-thumbnail"><a href="<?=site_url('user/journal/detail_jurnal');?>">Jurnal Psikologi Pendidikan dan Perkembangan</a></h5>
                    <h6>vol.5</h6>
                  </div>
                </div>
             </div>  -->
              <!-- <div class="filter-box-thumbnail col-md-3 col-sm-3 col-xs-12 " style="">
                <div class="box-thumbnail">
                  <div class="header-box-thumbnail">
                    <img class="thumbnail-cover" src="<?=base_url();?>mockup_statis/assets/img/jur-3.jpg">
                    <div class="filter-button-action">
                      <div>
                        <a href="#">
                          <div class="btn-action">
                            <i class="fa fa-pencil"></i>
                            
                          </div>
                        </a>
                      </div>
                      <div>
                      </div>
                    </div>
                  </div>
                  <div class="body-box-thumbnail">
                    <h5 class="title-thumbnail"><a href="<?=site_url('user/journal/detail_jurnal');?>">Jurnal Psikologi Pendidikan dan Perkembangan</a></h5>
                    <h6>vol.5</h6>
                  </div>
                </div>
             </div> -->
              <!-- <div class="filter-box-thumbnail col-md-3 col-sm-3 col-xs-12 " style="">
                <div class="box-thumbnail">
                  <div class="header-box-thumbnail">
                    <img class="thumbnail-cover" src="<?=base_url();?>mockup_statis/assets/img/jur-3.jpg">
                    <div class="filter-button-action">
                      <div>
                        <a href="#">
                          <div class="btn-action">
                            <i class="fa fa-pencil"></i>
                            
                          </div>
                        </a>
                      </div>
                      <div>
                      </div>
                    </div>
                  </div>
                  <div class="body-box-thumbnail">
                    <h5 class="title-thumbnail"><a href="<?=site_url('user/journal/detail_jurnal');?>">Jurnal Psikologi Pendidikan dan Perkembangan</a></h5>
                    <h6>vol.5</h6>
                  </div>
                </div>
             </div> -->
           </div>
    		</div>

    </div>
</div>


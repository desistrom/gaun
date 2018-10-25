<div class="col col-md-10 col-sm-10 col-xs-12 right-content" style="">
            <div class=" title-box">
              <h3>Dashboard</h3>
            </div>

            <div class="box-content">
                <div class="row">
                  <div class="col col-md-12 col-sm-12 col-xs-12">
                        <h4 class="welcome">
                       Selamat Datang <?=$user['nama'];?>
                      </h4>
                      <hr>
                  </div>
                </div>
               <div class="row">
                <!-- ./col -->
                <div class="col-lg-3 col-xs-12">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3><?=$journal;?></h3>

                      <p>Journal</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-book"></i>
                    </div>
                    <a href="<?php echo site_url('user/journal');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-12">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3><?=$artikel;?></h3>

                      <p>Artikel</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-newspaper-o"></i>
                    </div>
                    <a href="<?php echo site_url('user/journal');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
              </div>
            </div>
  
            </div>
            <?php if(is_null($this->general->status())){ ?>

    <div class="modal" tabindex="-1" role="dialog" id="modalSuccess">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Perhatian</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Anda harus melengkapi profil anda terlebih dahulu</p>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

            <?php } ?>

<script type="text/javascript">
  $('#modalSuccess').modal('show');
</script>
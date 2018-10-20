<div class="col col-md-10 col-sm-10 col-xs-12 right-content" style="">
            <div class=" title-box">
              <h3>Dashboard</h3>
            </div>

            <div class="box-content">
                <div class="row">
                  <div class="col col-md-12 col-sm-12 col-xs-12">
                        <h4 class="welcome">
                       Selamat Datang Admin Journal <?=$user;?>
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
                      <h3><?php echo $active;?></h3>

                      <p>Journal Active</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-check"></i>
                    </div>
                    <a href="<?php echo site_url('journal/admin/accepted');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-12">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3><?php echo $pending;?></h3>

                      <p>Journal Pending</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                    <a href="<?php echo site_url('journal/admin');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-12">
                  <!-- small box -->
                  <div class="small-box bg-red">
                    <div class="inner">
                      <h3><?php echo $ignore;?></h3>

                      <p>Journal Ignore</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-times"></i>
                    </div>
                    <a href="<?php echo site_url('journal/admin/rejected');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
              </div>
            </div>
  
            </div>
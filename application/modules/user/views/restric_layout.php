<div class="col col-md-10 col-sm-10 col-xs-12 right-content" style="">
  <div class=" title-box">
    <h3>Restrict</h3>
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
      <div class="col col-md-12 col-sm-12 col-xs-12">
        <div class="alert alert-warning btn-bg text-center">  
        <h4>Anda Tidak Bisa mengakses halaman ini. harap melengkapi Profil terlebih dahulu</h4>
      </div>
      </div>
      <div class="col col-md-12 col-sm-12 col-xs-12">
        <a href="<?php echo site_url('user/dashboard/profil');?>" class="btn btn-success"><i class="fa fa-chevron-left"> Menuju Profil</i></a>
      </div>
      <!-- ./col -->
      <!-- ./col -->
    </div>
  </div>

</div>
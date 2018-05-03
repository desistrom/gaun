<?php if($video != 'data not found'){ foreach ($video as $key => $value): ?>       
<?php $ret = ''; ?><div class="col-md-4 col-sm-6 col-xs-12 text-center" style="height: auto;overflow: hidden;">
    <div class="box-img-galery "> 
        <div class="filter-img-galery" >
          <a href="#" class="show-video" id="<?php echo $value['file'] ?>" ></a>
           <iframe  width="100%" height="270px" src="<?php echo $value['file'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
      <div class="galery-deskripsi text-left">
        <h3><?php echo $value['title']; ?> </h3>
        <ul class="list-inline">
          <!-- <li><?php echo $value['modify_date']; ?></li>
          <li>100 views</li> -->
        </ul>
      </div>
    </div>
</div>
<?php endforeach; }else{ return false;  } ?>
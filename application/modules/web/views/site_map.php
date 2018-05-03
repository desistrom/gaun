<?php header('Content-type: application/xml; charset="ISO-8859-1"',true);  ?>
 
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
     <loc><?php echo base_url();?></loc>
     <priority>1.0</priority>
  </url>

  <?php foreach ($menu as $key => $value) { ?>
  <url>
     <loc><?php echo $value['link'];?></loc>
     <priority>0.5</priority>
  </url>
  <?php } ?>

  <?php foreach ($news as $key => $news_value) { ?>
  <url>
     <loc><?php echo site_url('web/news/get_news').'/'.$news_value['link'];?></loc>
     <priority>0.5</priority>
     <lastmod><?php echo $news_value['created'];?></lastmod>
  </url>
  <?php } ?>
 
</urlset>
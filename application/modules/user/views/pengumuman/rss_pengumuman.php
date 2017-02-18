<rss version="2.0">
<channel>
  <title><?php echo $feed_name ?></title>
  <link><?php echo $feed_url ?></link>
  <description><?php echo $feed_description ?></description>
   <?php foreach($pengumuman as $p): ?>  
			  <item>
			  <title><?php echo $p->JUDUL ?></title>
			  <link><?php echo site_url('page/pengumuman/detail/' . $p->ID_PENGUMUMAN) ?> </link>
			  <pubdate><?php echo $p->TGL_POSTING." ".$p->JAM_POSTING ?></pubdate> 
			  </item>
						 
                 
           <?php endforeach; ?>  
  
</channel>
</rss> 
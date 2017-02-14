<rss version="2.0">
<channel>
  <title><?php echo $feed_name ?></title>
  <link><?php echo $feed_url ?></link>
  <description><?php echo $feed_description ?></description>
   <?php foreach($agenda as $p): ?>  
			  <item>
			  <title><?php echo $p->NAMA_AGENDA ?></title>
			  <link><?php echo site_url('page/agenda/detail/' . $p->ID_AGENDA) ?> </link>
			  <?php 
							$isi=preg_replace('/<p align="center">(&nbsp;|[\s\p{Z}\p{C}\x85\xA0\x{0085}\x{00A0}\x{FFFD}]+)*<\/p>/iu',"",htmlspecialchars_decode($p->DESKRIPSI));
							$isi=preg_replace('/<p>(&nbsp;|[\s\p{Z}\p{C}\x85\xA0\x{0085}\x{00A0}\x{FFFD}]+)*<\/p>/iu',"",$isi);
							$isi=preg_replace('/(&nbsp;)*/iu',"",$isi);
							?> 
			 <description><?php echo substr(strip_tags(html_entity_decode($isi)),0,200) ?>...</description>
			 <pubdate><?php echo $p->TGL_POSTING." ".$p->JAM_POSTING; ?></pubdate> 
			   </item>
           <?php endforeach; ?>  
</channel>
</rss> 

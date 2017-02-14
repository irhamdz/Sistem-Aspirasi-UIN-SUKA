<rss version="2.0">
<channel>
<title><?php echo $data['tk_kat2']; ?></title>
<link><?php echo $data['url_cur']; ?></link>
<description>UIN Sunan Kalijaga Yogyakarta</description>
<?php foreach($data['artikel'] as $d): ?>
<?php $kondisi_rss = explode("-", $this->security->xss_clean($this->uri->segment(2))); $kondisi_rss = $kondisi_rss[0];if($kondisi_rss=='agenda'){$judul = explode("#", $d[$data['col_sfx'].'JUDUL']);$judul =  $judul[0];$judul=str_replace("&", "dan", $judul);}else{$judul=str_replace("&", "dan", $d[$data['col_sfx'].'JUDUL']);		}?>

			<item>
			<title><?php echo $judul ?></title>
			<link><?php if($data['url_dx'] != ''){$link = str_replace('/-','/',$data['url_dx']);$link = str_replace('%LINK%',$d[$data['col_sfx'].'SLUG'],$link);echo site_url($link);} else {echo $d[$data['col_sfx'].'URL'];}?></link>
			<pubdate><?php echo date("D, d M Y H:i:s O", strtotime($d[$data['col_sfx'].'TGLLOG_F'])) ?></pubdate> 
			</item>
			
<?php endforeach; ?>
</channel>
</rss>


<?php 
	$xxx = ($data == false)? '1':'0'; #sigit #view liputan paling depan
	 // print_r($data);
?>
<?php 
	if($xxx<1): ?>
	<div class="app-blog">
			<h3 class="judul-02" style="margin:0;"><b>
				<?php $link1 = str_replace('%LINK%',$data['PG_SLUG'], str_replace('/-','/',$urlx));
				echo anchor($link1,$data['PG_JUDUL'],'title="'.sia_rip_tags($data['PG_JUDUL']).'" class="highyellow"'); ?>
			</b></h3>
			<span class="tgl-post"><?php echo date_trans_foracle($data['PG_TGLLOG_F'],1,'1 231 111',' '); ?> WIB<span class="page_counter">Dilihat : <?php echo $data['PG_LIHAT'];?> kali</span></span>
			<div class="clear5"></div>
			<div style="float:left; width: 320px; margin-top:7px;  margin-right:20px;">
				<img src="<?php echo admisi_urlfoto($data['URL_FOTO']); ?>" alt="<?php echo sia_rip_tags($data['PG_JUDUL']); ?>" title="<?php echo sia_rip_tags($data['PG_JUDUL']); ?>" style="width: 320px;">
			</div>
			<div><?php echo substr($data['PG_ISI'], 0, 380); ?></div>
			<?php /* <div style="clear:both"></div><br> */ ?>
					<?php echo anchor($link1,"Selengkapnya >>",'style="margin: 0; float: right; color: #FFF;" class="btn-uin btn btn-inverse btn btn-small" title="'.sia_rip_tags($data['PG_JUDUL']).'" class="highyellow"');?>
		<?php endif; ?>
	</div>
	
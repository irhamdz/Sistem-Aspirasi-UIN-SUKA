<div id="content-center">
	<?php foreach($agenda->result() as $d){ ?>
		<div id="news-list">
			<h1 class="judul"><a href="<?php echo site_url('page/agenda/detail/'.$d->id_agenda.'/'.url_title(strtolower($d->nama_agenda))) ?>"><?php echo $d->nama_agenda ?></a></h1>
			<div class="tgl-post"><?php echo nama_hari($d->tgl_posting).', '.tanggal_indonesia($d->tgl_posting).' '.$d->post_jam ?> WIB</div>
			<div class="cleaner_h10"></div>
				<table>
					<tr><td>Hari</td><td>:</td><td><?php echo nama_hari($d->tgl_mulai)?></td></tr>
					<tr><td>Tanggal</td><td>:</td><td><?php echo tanggal_indonesia($d->tgl_mulai); if($d->tgl_selesai!=$d->tgl_mulai and $d->tgl_selesai!="0000-00-00") echo " s/d ".tanggal_indonesia($d->tgl_selesai); ?></td></tr>
					<tr><td>Jam</td><td>:</td><td><?php echo $d->jam_mulai; if($d->jam_selesai=="00:00:00") echo " s/d 23:59:59"; ?> WIB</td></tr>
					<tr><td>Tempat</td><td>:</td><td><?php echo $d->tempat ?></td></tr>
				</table>
			<div style="clear:both"></div>
			<a class="btn-uin btn btn-inverse btn btn-small" style="float:right" href="<?php echo site_url('page/agenda/detail/'.$d->id_agenda.'/'.url_title(strtolower($d->nama_agenda))) ?>"><i class="btn-uin"></i>Selengkapnya >></a> 
			<div style="clear:both"></div>
		</div>
		<?php } ?>
		<div class="cleaner_h20"></div>
		<div class="pagination">
		<?php
		echo $this->pagination->create_links();
		?>
		</div>
</div>
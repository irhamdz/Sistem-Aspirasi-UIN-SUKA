<li id="li-ict" class="item">
	<a href="#ict" class="item"><span>Training & Sertifikasi</span></a>
	<div class="underline-menu"></div>
	<ol id="ol-ict" class="<?php echo $buka;?>" style="">
<?php
	 $jabatan = $this->session->userdata('jabatan');
		echo "<li class='submenu'><b>ICT</b></li>";
		foreach($jabatan as $key => $value){
			if($value == 'UED1000' || $value == 'UED1001'|| $value == 'AAZ001'|| $value == 'AAZ002'){
				$arr_li = array(
					array('operator/periode','Pengaturan Periode Sertifikasi ICT','Atur Periode ICT'),
					array('operator/ruang','Pengaturan Ruang Sertifikasi ICT','Atur Ruang ICT'),
					array('operator/penjadwalan','Penjadwalan Sertifikasi ICT','Penjadwalan ICT'),
					array('operator/jadwal','Lihat Jadwal yang Telah Terisi','Jadwal yang Telah Terisi'),
					array('operator/jadwalditawarkan','Lihat Jadwal yang Ditawarkan','Lihat Jadwal Ditawarkan'),
					array('operator/lihatnilai','Lihat Nilai Sertifikasi ICT','Lihat Nilai ICT'),
					array('operator/nilai','Input & Download Nilai Sertifikasi ICT','Input & Download Nilai'),
				);
				$arr_tools = array(
					// array('toefl/operator/mendaftarkan','Mendaftarkan TOEC/TOEFL','Mendaftarkan TOEC/TOEFL'),
					array('operator/historipeserta','Melihat Riwayat ICT','Lihat Riwayat Jadwal Peserta'),
					array('operator/cetaksertifikat','Mencetak Sertifikat ICT','Cetak Sertifikat ICT'),
					array('operator/inputnilai','Memasukkan Nilai per Peserta','Input Nilai per Peserta'),
				);
				foreach ($arr_li as $key => $value):	echo '<li class="submenu"><a href="'.base_url($value[0]).'" title="'.$value[1].'">'.$value[2].'</a></li>'; endforeach;
				if($arr_tools){
					echo "<li class='submenu'><b>Tools</b></li>";
					foreach ($arr_tools as $key => $value):	echo '<li class="submenu"><a href="'.base_url($value[0]).'" title="'.$value[1].'">'.$value[2].'</a></li>'; endforeach;
				}
			}elseif($value == 'UED1004'){
				$arr_li = array(
					array('operator/jadwalditawarkan','Lihat Jadwal yang Ditawarkan','Lihat Jadwal Ditawarkan'),					
					array('operator/historipeserta','Melihat Riwayat ICT','Lihat Riwayat Jadwal Peserta'),
					array('operator/cetaksertifikat','Mencetak Sertifikat ICT','Cetak Sertifikat ICT'),
				);
				foreach ($arr_li as $key => $value):	echo '<li class="submenu"><a href="'.base_url($value[0]).'" title="'.$value[1].'">'.$value[2].'</a></li>'; endforeach;
				if(isset($arr_tools) && !empty($arr_tools)){
					echo "<li class='submenu'><b>Tools</b></li>";
					foreach ($arr_tools as $key => $value):	echo '<li class="submenu"><a href="'.base_url($value[0]).'" title="'.$value[1].'">'.$value[2].'</a></li>'; endforeach;
				}
			}
		}
?>

	</ol>
</li>
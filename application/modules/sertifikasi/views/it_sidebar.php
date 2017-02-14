<?php 
	if($this->session->userdata('status') == 'staff'):
		$data = $this->security->xss_clean($this->uri->segment(1));
		$buka = ($data == 'operator')? 'buka':'';
		$jbt	= $this->session->userdata('jabatan');
		$allow = "UED1000#UED1001#UED1002#UED1003#UED1004#AAZ002#AAZ001";
		$who = array_intersect($jbt,explode("#",$allow));
		//print_r($jbt); die();
		if (count($who) > 0){
			//echo "hei"; die();
			$url_main = site_url('operator');
			$it = FALSE;
			foreach($who as $key => $value){
				if(substr($value,0,4) == 'UED1'){
					$it = TRUE;
				}
			}
			$m = array(
				'buka' => $buka,
				'url_main' => $url_main,
				'it' => $it,
				);
			$this->load->view('sertifikasi/sidebar_admin',$m);
		}else{ }
		/*$arr_li = array(
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
				); 	*/
	?>
		
	<?php 
	elseif($this->session->userdata('status') == 'pendaftar'):
		$data = $this->security->xss_clean($this->uri->segment(1));
		$buka = ($data == 'pendaftar')? 'buka':'';
		$arr_li = array(
					array('pendaftar/isidatadiri#ict','Mengisi Data Pribadi Pendaftar','Isi Data Pribadi'),
					array('pendaftar/daftarsertifikasi#ict','Mendaftar Ujian Sertifikasi ICT','Daftar Ujian Sertifikasi ICT'),
					array('pendaftar/jadwalsertifikasi#ict','Melihat Jadwal','Lihat Jadwal Sertifikasi ICT'),
					array('pendaftar/riwayatsertifikasi#ict','Melihat Riwayat Jadwal','Lihat Riwayat Sertifikasi ICT'),
				);
	?>
		<li id="li-ict" class="item">
				<a href="#ict" class="item"><span>Training & Sertifikasi</span></a>
			<div class="underline-menu"></div>
			<ol id="ol-ict" class="<?php echo $buka;?>" style="">
			<li><strong>ICT</strong></li>
			<?php foreach ($arr_li as $key => $value):	echo '<li class="submenu"><a href="'.base_url($value[0]).'" title="'.$value[1].'">'.$value[2].'</a></li>'; endforeach;	?>
							
			</ol>
		</li>
	
	<?php endif; ?>

<?php 
	/*
		buat portal sidebar => memisahkan pendaftar / admin
		if pendaftar -> load('sb_pendaftar'), elseif admin -> load('sb_admin')
	*/

?>
<?php
function cek_data_kurang($kode,$j,$no)
{
	/*
	1. pendidikan terakhir 
	2. pilihan prodi 
	3. pilihan jadwal

	*/
	$link="";
	$div1="<div class='bs-callout bs-callout-error'>";
	$info="";
	$div2="</div>";
	switch ($kode) {
		case '1':
			$link=base_url('pendaftaran/form_control/data_riwayat_pendidikan_sebelumnya/'.$no.'/'.$j);
			$info=$div1."DATA PENDIDIKAN TERAKHIR ANDA BELUM DIISI. SILAKAN ISI DAHULU <a href='#' style='color:#0f0;' id='".$link."' onclick='load_ulang(this.id)'><u>DISINI</u></a>".$div2;
			break;
		case '2':
			$link=base_url('pendaftaran/form_control/data_piljur/'.$no.'/'.$j);
			$info=$div1."DATA PILIHAN JURUSAN BELUM DIISI. SILAKAN ISI DAHULU <a href='#' style='color:#0f0;' id='".$link."' onclick='load_ulang(this.id)'><u>DISINI</u></a>".$div2;
			break;
		case '3':
			$link=base_url('pendaftaran/form_control/data_piljur/'.$no.'/'.$j);
			$info=$div1."DATA LOKASI UJIAN BELUM DIPILIH. SILAKAN ISI DAHULU <a href='#' style='color:#0f0;' id='".$link."' onclick='load_ulang(this.id)'><u>DISINI</u></a>".$div2;
			break;
		
		default:
			$info=0;
			break;
	}
	return $info;
}


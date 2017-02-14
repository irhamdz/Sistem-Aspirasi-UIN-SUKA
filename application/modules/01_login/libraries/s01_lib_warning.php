<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
	Author		: Wihikan Mawi Wijna
	Created		: 14:01 04 Juni 2013

	s01			: sia "kamar" 00, (s00, s01, s02, ..., s99)
	lib			: ct = controller, vw = view, mdl = model, lib = library
	warning		: unique name {sesuai fungsi utama controller/view/model/library ini}
*/
class S01_lib_warning {
	
	function set_error($id = 0){
		$CI =& get_instance();
		switch($id){
			#case 1			: $p = 'Maaf, Username atau Password Salah'; break;
			#case 1			: $p = 'Maaf, Username atau Password Salah'; break;
			#case 1			: $p = 'Maaf, Username atau Password Salah'; break;
			#case 1			: $p = 'Maaf, Username atau Password Salah'; break;
			case 'd0'		: $p = 'Maaf, validasi API tidak sesuai'; break;
			case 'd1'		: $p = 'Maaf, terjadi kesalahan pada server AD'; break;
			case 'd2'		: $p = 'Maaf, status username tidak aktif'; break;
			#case 'd3'		: $p = 'Maaf, username tidak ditemukan'; break;
			case 'd3'		: $p = 'Maaf, username atau password salah'; break;
			case 'd4'		: $p = 'Maaf, password salah'; break;
			case 'b1'		: $p = 'Maaf, anda belum melunasi tagihan SPP untuk semester ini'; break;
			case 'r1'		: $p = 'Maaf, saat ini jadwal pengisian KRS untuk Fakultas Ushuluddin dan Pemikiran Islam serta Fakultas Ilmu Sosial dan Humaniora'; break;
			case 'proses'	: $p = 'Sistem Kami dalam Perbaikan, Maaf Atas Ketidak nyamanan ini'; break;
			case 'batal'	: $p = 'Maaf, Anda telah melakukan pembatalan Pendaftaran sebelumnya'; break;
			case 'belum'	: $p = 'Maaf, Pendaftaran Jenis ini (903), Belum Ditawarkan'; break;
			case 'bb'		: $p = 'Maaf, Jalur pendaftaran yang Anda pilih belum dibuka'; break;
			case 'REVERSAL'	: $p = 'Maaf, Anda telah melakukan pembatalan Pendaftaran sebelumnya'; break;
			case 'USERORPASS'	: $p = 'Email or Password you entered is incorrect. Please try again.'; break;
			case 'NOT'	: $p = 'Email you entered is incorrect. Please try again.'; break;
			case 'OK'	: $p = 'Registration Success, please check your mailbox to obtain your password.'; break;
			case 'EMAIL_SAMA'	: $p = 'The email has already been use. Please provide another email for registration'; break;
			case 'EMAIL_INVALID'	: $p = 'Invalid Email'; break;
			default			: $p = ''; break; } 
		$CI->session->set_flashdata('warning-info',$p);
		$CI->session->set_flashdata('warning-type','error');
	}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Author		: Wihikan Mawi Wijna
	Created		: 14:21 02 Desember 2013

	s04			: sia "kamar" 04, (s00, s01, s02, ..., s99)
	ct			: ct = controller, vw = view, mdl = model, lib = library
	staff		: unique name {sesuai fungsi utama controller/view/model/library ini}
*/
class S00_ct_informasi extends CI_Controller {
	
	//09650055
	//849677
	
	public function __construct(){
		parent::__construct();
		$this->api 		= $this->s00_lib_api;
		$this->output9	= $this->s00_lib_output;
		$this->menu7	= $this->s00_lib_sh_menu;
		
		$this->menu7->set_var('url_link','informasi');
		$this->menu7->set_var('url_prefix','.html');
		
		#$this->session->set_userdata('app', 'staff');
		
		/* FROM menu7 */
		$this->arr_url_stt 	= $this->menu7->get_url_stt();
		$this->arr_url_var 	= $this->menu7->get_url_var();
		$this->arr_mnu_stt 	= $this->menu7->get_mnu_stt();
		$this->url_prefix 	= $this->menu7->get_url_prefix();
		$this->url_link		= $this->menu7->get_url_link();
		$this->arr_crumbs	= $this->menu7->get_url_crumbs();
		
		$this->url_error 	= 'error';
		
	}
	
	private function _t101_1ntoi($txt){
		switch(strtolower($txt)){
			case 'liputan': 	return 1; break;
			case 'pengumuman': 	return 2; break;
			case 'berita': 		return 3; break;
			case 'agenda': 		return 4; break;
			case 'kolom': 		return 5; break;
		}
	}
	
	private function _t101_1iton($txt){
		switch(strtolower($txt)){
			case 1: return 'liputan'; break;
			case 2: return 'pengumuman'; break;
			case 3: return 'berita'; break;
			case 4: return 'agenda'; break;
			case 5: return 'kolom'; break;
		}
	}
	
	public function a101_ajax01($txt = ''){
		#if(isset($_SERVER['HTTP_REFERER'])){
		#if(preg_match("/akademik\.uin-suka\.ac\.id/", $_SERVER['HTTP_REFERER'])){
		$adata 	= array();
		$bdata 	= array();
		$kode 	= t1_decode($txt);
		$kode1	= explode('#',$kode);
		if(count($kode1)<1){ $kode1 = array('x'); }
		
		switch($kode1[0]){
			case '1701':
				if(count($kode1)<2){ $kode1[] = 'y'; }
				switch($kode1[1]){
					case '1':
					
					$api1 = $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_search', 'POST', 
									array('api_kode'=>88001, 'api_subkode' => 8, 'api_search' => array(1,'')));
					#print_r($api1); die();
					$i1 = 0;
					foreach($api1 as $tb1){
						++$i1;
						$api2 = $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_search', 'POST', 
									array('api_kode'=>88001, 'api_subkode' => 8, 'api_search' => array(2,$tb1['XTHNM'])));
						
						$bdata = array();
						foreach($api2 as $tb2){
							$fdate2	= '01-'.$tb2['XBLNM'].'-1990 01:02:03';
							$nmbl2	= date_trans_foracle($fdate2,1,'0 030 000',' ');
							$judul2 = $nmbl2.' ('.$tb2['XBLJML'].')';
							
							$bdata[] 	= array("title" 	=> $judul2,
												"isFolder"	=> true, 
												"isLazy"	=> true,
												"key"		=> t1_encode($kode1[0].'#2#'.$tb2['XBLNM'].$tb1['XTHNM'])
												);
						}
						if($i1 == 1){ $exp1 = true; } else { $exp1 = false; }	
						
						$fdate1	= '01-01-'.$tb1['XTHNM'].' 01:02:03';
						$nmbl1	= date_trans_foracle($fdate1,1,'0 001 000',' ');
						$judul1 = $nmbl1.' ('.$tb1['XTHJML'].')';
						
						$adata[] = array(
									'title'		=> $judul1,
									'isFolder'	=> true, 
									'expanded'	=> $exp1,
									'children' 	=> $bdata
								);
						}
					
					break;
					case '2':
						$api1 = $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_search', 'POST', 
									array('api_kode'=>88001, 'api_subkode' => 8, 'api_search' => array(3,$kode1[2])));
						$i1 = 0;
						foreach($api1 as $tb1){
							$url1 = $this->menu7->build_url_var('v0b0','%LINK%', 'informasi');
							$url1 = str_replace('/-','/',$url1);
							$url1 = str_replace('%LINK%',$tb1['PG_SLUG'],$url1);
							$adata[] = array(
										'title'	=> anchor($url1,$tb1['PG_JUDUL'],'title="'.sia_rip_tags($tb1['PG_JUDUL']).'" target="_blank"'),
										
									);
							}
							
						/* $pengumuman=$this->db->query("SELECT id_pengumuman,judul,nama_file,url from pengumuman where year(tgl_posting)='".$tahun."' and month(tgl_posting)='".$bulan."'")->result();
						$i=0;
						foreach($pengumuman as $b){
							if($b->nama_file!=null){
								$url =base_url('media/pengumuman/'.$b->nama_file);
							}else{						
								$url =$b->url;
							}
							$data[] = array(
										'title'=> "<a target='_blank' href='".$url."' title='".$b->judul."'>".$b->judul."</a>",
										
									);
							} */
						
					break;
				}
			break;
			case '1702':
			case '1703':
			case '1704':
			case '1705':
				if(count($kode1)<2){ $kode1[] = 'y00X'; } $bun1 = substr($kode1[0],-1);
				switch($kode1[1]){
					case '1':
					
					$api1 = $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_search', 'POST', 
									array('api_kode'=>88002, 'api_subkode' => 8, 'api_search' => array(1,$bun1,'')));
					#print_r($api1); die();
					$i1 = 0;
					foreach($api1 as $tb1){
						++$i1;
						$api2 = $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_search', 'POST', 
									array('api_kode'=>88002, 'api_subkode' => 8, 'api_search' => array(2,$bun1,$tb1['XTHNM'])));
						
						$bdata = array();
						foreach($api2 as $tb2){
							$fdate2	= '01-'.$tb2['XBLNM'].'-1990 01:02:03';
							$nmbl2	= date_trans_foracle($fdate2,1,'0 030 000',' ');
							$judul2 = $nmbl2.' ('.$tb2['XBLJML'].')';
							
							$bdata[] 	= array("title" 	=> $judul2,
												"isFolder"	=> true, 
												"isLazy"	=> true,
												"key"		=> t1_encode($kode1[0].'#2#'.$tb2['XBLNM'].$tb1['XTHNM'])
												);
						}
						if($i1 == 1){ $exp1 = true; } else { $exp1 = false; }	
						
						$fdate1	= '01-01-'.$tb1['XTHNM'].' 01:02:03';
						$nmbl1	= date_trans_foracle($fdate1,1,'0 001 000',' ');
						$judul1 = $nmbl1.' ('.$tb1['XTHJML'].')';
						
						$adata[] = array(
									'title'		=> $judul1,
									'isFolder'	=> true, 
									'expanded'	=> $exp1,
									'children' 	=> $bdata
								);
						}
					
					break;
					case '2':
						#$bun1 = substr($kode1[0],-1);
						$api1 = $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_search', 'POST', 
									array('api_kode'=>88002, 'api_subkode' => 8, 'api_search' => array(3,$bun1,$kode1[2])));
						$i1 = 0;
						foreach($api1 as $tb1){
							if($bun1 != '2'){
							$url1 = $this->menu7->build_url_var('v0b'.(intval($bun1)-2),'%LINK%', 'informasi');
							$url1 = str_replace('/-','/',$url1);
							$url1 = str_replace('%LINK%',$tb1['PN_SLUG'],$url1);
							$urlx = anchor($url1,$tb1['PN_JUDUL'],'title="'.sia_rip_tags($tb1['PN_JUDUL']).'" target="_blank"');
							} else {
							$urlx = anchor($tb1['PN_URL'],$tb1['PN_JUDUL'],'title="'.sia_rip_tags($tb1['PN_JUDUL']).'" target="_blank"');
							}
							$adata[] = array(
										'title'	=> $urlx ,
										
									);
							}
						
					break;
				}
			break;
		}
		
		/* $bdata[]=array('title'=>'Bulan X',
						"isFolder"=> true, 
						"isLazy"=> true,
						"key"=> 'C13/D14');
						
		$adata[] = array(
						'title'=> 'hei',
						"isFolder"=> true, 
						'expanded'=> true,
						'children' => $bdata
					); */
		echo json_encode($adata,true);
		#} else { echo json_encode(array(),true); }
		#} else { echo json_encode(array(),true); }
	}
	
	public function n101_berita_rss($kat1 = '', $judul1 = ''){
		$data = array(); #echo $kat1.'_'.$judul1; die();
		$kat1_ = $this->_t101_1ntoi($kat1);
		$data['tk_kat1'] = $kat1_.'#'.$kat1;
		switch($kat1_){
			default: redirect('error'); break;
			case 1:
				$slug_ = str_replace($this->url_prefix,'',$judul1);
				$data['artikel']	= $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_search', 'POST', 
									array('api_kode'=>88001, 'api_subkode' => 7, 'api_search' => array($slug_)));
				$data['col_sfx'] = 'PG_';
				$data['url_d0'] = $this->menu7->build_url_var('v0b0','%LINK%', 'informasi');
			break;
			case 2:
				$data['artikel']	= $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_limit', 'POST', 
									array('api_kode'=>88002, 'api_subkode' => 2, 'api_mulai' => 1, 'api_jumlah' => 3));
				$data['col_sfx'] = 'PN_';
				$data['url_dx'] = '';
			break;
			case 3:
				$data['artikel']	= $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_limit', 'POST', 
									array('api_kode'=>88002, 'api_subkode' => 3, 'api_mulai' => 1, 'api_jumlah' => 3));
				$data['col_sfx'] = 'PN_';
				$data['url_dx'] = $this->menu7->build_url_var('v0b1','%LINK%', 'informasi');
			break;
			case 4:
				$data['artikel']	= $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_limit', 'POST', 
									array('api_kode'=>88002, 'api_subkode' => 4, 'api_mulai' => 1, 'api_jumlah' => 3));
				$data['col_sfx'] = 'PN_';
				$data['url_dx'] = $this->menu7->build_url_var('v0b2','%LINK%', 'informasi');
			break;
			case 5:
				$data['artikel']	= $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_limit', 'POST', 
									array('api_kode'=>88002, 'api_subkode' => 5, 'api_mulai' => 1, 'api_jumlah' => 3));
				$data['col_sfx'] = 'PN_';
				$data['url_dx'] = $this->menu7->build_url_var('v0b3','%LINK%', 'informasi');
			break;
		}
		
		if(!empty($data['artikel'])){
			$data['tk_kat2'] = $this->n101_berita_parse01($kat1_); 
			
			$data['url_cur'] = current_url();
			$data['url_d9'] = $this->menu7->build_url_var('v0b9','%LINK%', 'informasi');
			
			header("Content-type: text/xml");
			$this->load->view('00_share/def/a00_vw_pengumuman2013_r04', array('data' => $data));
		} else { redirect('error'); }
	}
	
	public function n101_berita_post($kat1 = '', $judul1 = ''){
		$data = array();
		$kat1_ = $this->_t101_1ntoi($kat1);
		$data['tk_kat1'] = $kat1_.'#'.$kat1;
		switch($kat1_){
			default: redirect('error'); break;
			case 1:
				$slug_ = str_replace($this->url_prefix,'',$judul1);
				$data['artikel']	= $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_search', 'POST', 
									array('api_kode'=>88001, 'api_subkode' => 7, 'api_search' => array($slug_)));
				$data['col_sfx'] = 'PG_';
				$s1k = 88001; $s2k = 4; $u1c = 'v0b0';
				$ar1 = array('maaa', 'm0c'.$kat1_);
			break;
			case 3:
			case 4:
			case 5:
				$slug_ = str_replace($this->url_prefix,'',$judul1);
				$data['artikel']	= $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_search', 'POST', 
									array('api_kode'=>88002, 'api_subkode' => 7, 'api_search' => array($slug_)));
				$data['col_sfx'] = 'PN_';
				$s1k = 88002; $s2k = 5; $u1c = 'v0b'.($kat1_-2);
				$ar1 = array('maaa', 'm0c'.$kat1_);
			break;
		}
		if(!empty($data['artikel'])){
			$slihat		= $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_procedure', 'POST', 
							array('api_kode'=>$s1k, 'api_subkode' => $s2k, 'api_datapost' => array($data['artikel'][0][$data['col_sfx'].'ID'])));
			
			$data['crumbs'] = $this->menu7->build_crumbs($ar1, true);
			
			$url1 = str_replace('-%LINK%', $data['artikel'][0][$data['col_sfx'].'SLUG'], $this->menu7->build_url_var($u1c,'%LINK%', 'informasi'));
			$data['crumbs'][] = array($data['artikel'][0][$data['col_sfx'].'JUDUL'] => $url1);
			foreach($data['crumbs'][0] as $k1 => $v1){ $data['crumbs'][0][$k1] = 'beranda'; }
			foreach($data['crumbs'][1] as $k1 => $v1){ $data['crumbs'][1][$k1] = str_replace('.html','1.html',$data['crumbs'][1][$k1]); }
						
			$data['tk_kat2'] = ucwords($this->_t101_1iton($kat1_)); 
			$this->_101_display('pengumuman2013_r02', $data);
		} else { redirect('error'); }
	}
	
	public function n101_berita_arsip($kat1 = '', $judul1 = ''){
		$data 	= array();
		$kat1_ 	= $this->_t101_1ntoi($kat1);
		$curp	= intval(str_replace($this->url_prefix,'',$judul1));
		$per1	= 10;
		$m1		= abs(($curp - 1) * $per1)+1;
		$ar1 	= array('maaa', 'm0c'.$kat1_);
		switch($kat1_){
			default: redirect('error'); break;
			case 1:
				$data['total']	= 	$this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_count', 'POST', 
									array('api_kode'=>88001, 'api_subkode' => 2));
				$data['pengumuman1']= 	$this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_limit', 'POST', 
									array('api_kode'=>88001, 'api_subkode' => 3, 'api_mulai' => $m1, 'api_jumlah' => $per1));
				$data['url_d1'] = $this->menu7->build_url_var('v0b0','%LINK%', 'informasi');
				$data['col_sfx'] = 'PG_';
				$s1k = 88001;
				
			break;
			case 2:
			case 3:
			case 4:
			case 5:
				$data['total']	= 	$this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_count', 'POST', 
									array('api_kode'=>88002, 'api_subkode' => 3, 'api_count' => array($kat1_)));
				$data['pengumuman1']= 	$this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_limit', 'POST', 
									array('api_kode'=>88002, 'api_subkode' => $kat1_+5, 'api_mulai' => $m1, 'api_jumlah' => $per1));
				$data['url_d1'] = $this->menu7->build_url_var('v0b'.($kat1_-2),'%LINK%', 'informasi');
				$data['col_sfx'] = 'PN_';
				$s1k = 88002;
				
				
			break;
		}
		$data['kat1'] = $kat1_;
		
		if(!empty($data['pengumuman1'])){
		$this->load->library('pagination');
		$config_pag = array(); 
		
		$config_pag['base_url'] 			= site_url(str_replace('/-%LINK%.html','',$this->menu7->build_url_var('v0b'.($kat1_+3),'%LINK%', 'informasi')));
		$config_pag['total_rows'] 			= intval($data['total']['TOTAL']);
		$config_pag['per_page'] 			= $per1;
		$config_pag['cur_page'] 			= $curp;
		$config_pag['uri_segment'] 			= 3;
		$config_pag['use_page_numbers']		= true;
		$config_pag['first_url']			= '1'.$this->url_prefix;
		$config_pag['suffix']				= $this->url_prefix;
		
		$config_pag['first_link']			= 'awal';
		$config_pag['next_link']			= '&gt;';
		$config_pag['prev_link']			= '&lt;';
		$config_pag['last_link']			= 'akhir';
		$config_pag['full_tag_open']		= '<ul>';
		$config_pag['full_tag_close']		= '</ul>';
		$config_pag['first_tag_open']		= '<li>';
		$config_pag['first_tag_close']		= '</li>';
		$config_pag['last_tag_open']		= '<li>';
		$config_pag['last_tag_close']		= '</li>';
		$config_pag['cur_tag_open']			= '<li class="pg_cur">';
		$config_pag['cur_tag_close']		= '</li>';
		$config_pag['next_tag_open']		= '<li>';
		$config_pag['next_tag_close']		= '</li>';
		$config_pag['prev_tag_open']		= '<li>';
		$config_pag['prev_tag_close']		= '</li>';
		$config_pag['num_tag_open']			= '<li>';
		$config_pag['num_tag_close']		= '</li>';
		
		#print_r($config_pag);
		
		$this->pagination->initialize($config_pag);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['crumbs'] = $this->menu7->build_crumbs($ar1, true);
		foreach($data['crumbs'][0] as $k1 => $v1){ $data['crumbs'][0][$k1] = 'beranda'; }
		foreach($data['crumbs'][1] as $k1 => $v1){ $data['crumbs'][1][$k1] = str_replace('.html','1.html',$data['crumbs'][1][$k1]); }
					
		$this->_101_display('pengumuman2013_r01_global', $data);
		} else {
			redirect('error');
		}
		#print_r($data);
		#print_r($data['total']); die();
	}
	
	public function n101_berita_parse01($kat1){
		switch($kat1){
			case 1: return 'Liputan'; break;
			case 2: return 'Pengumuman'; break;
			case 3: return 'Berita'; break;
			case 4: return 'Agenda'; break;
			case 5: return 'Kolom'; break;
			default: return ''; break;
		}
	}
	
	public function n101_inf_kalender(){
		$data = array();
		$data['doc1_url'] = base_url('downloads/1_uin-sunankalijaga_kalender_akademik.pdf');
		$data['doc2_url'] = base_url('downloads/2_uin-sunankalijaga_pedoman_akademik.pdf');
		$data['doc3_url'] = base_url('download/01_uin-sunankalijaga-pedoman-pmb-2014.pdf');
		//$data['doc4_url'] = base_url('download/01_uin-sunankalijaga-pedoman-pmb-2014.pdf');
		$this->_101_display('googledoc_kalender', $data);
	}
	
	public function n101_inf_bayar(){
		$data = array();
		$data['doc_url1'] = base_url('downloads/3_uin-sunankalijaga_panduan_pembayaran.pdf');
		$data['doc_url2'] = base_url('downloads/4_uin-sunankalijaga_tarif_pembayaran.pdf');
		$this->_101_display('googledoc_bayar', $data);
	}
	
	public function n101_inf_mkdosen(){
		$data = array();
		#if(isset($_POST)){ print_r($_POST); die(); }
		if(isset($_POST['v_ws0'])){
		
		//echo $_POST['v_ws2'];
		echo $this->n105_inf_mkdosen_select($_POST['v_ws0'], $_POST['v_ws1'], $_POST['v_ws2'], $_POST['v_ws3'], $_POST['v_ws4'], $_POST['v_ws5']);
				
		} elseif(isset($_POST['but_aksi0'])){
			$sess1 = $_POST['sel_w0'].'#'.$_POST['sel_w1'].'#2#2#'.$_POST['sel_w4'].'#2';
			$this->session->set_flashdata('awalmd9',$sess1);
			$this->_0422_redirect_stt('m0b5');
		} elseif(isset($_POST['but_aksi1'])){
			$sess1 = $_POST['sel_w0'].'#'.$_POST['sel_w1'].'#'.$_POST['sel_w2'].'#'.$_POST['sel_w3'].'#0#'.$_POST['sel_w5'];
			$this->session->set_flashdata('awalmd9',$sess1);
			$this->_0422_redirect_stt('m0b4');
		} else {
				
		$data['i_w0'] 	= '';
		$data['i_w1'] 	= '';
		$data['i_w2'] 	= '';
		$data['i_w3'] 	= '';
		$data['i_w4'] 	= '';
		$data['i_w5'] 	= '';
		$data['init_js']= 0;
		$data['url_s0'] = $this->menu7->build_url_stt('m0b2','informasi');
		
		$this->n105_inf_mkdosen_prodi($data);
		
		$this->_101_display('dosenprodi_formpilihbebas', $data);
		}
	}
	
	private function n105_inf_mkdosen_prodi(&$data1){
		$data['prodi']= $this->api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', array('api_kode'=>19000, 'api_subkode' => 3));
		if(!empty($data['prodi'])){
			$temp = array();
			for($i1 = 0; $i1 < count($data['prodi']); $i1++){
			if(substr(trim($data['prodi'][$i1]['NM_PRODI']),0,1) != 'X'){ 
			$temp[] = $data['prodi'][$i1];
			}} $data['prodi'] = $temp; unset($temp);
		}
		array_unshift($data['prodi'],array('KD_PRODI' => '', 'NM_PRODI' => ''));
		
		$data1['prodi'] = $data['prodi']; unset($data['prodi']);
		
		return $data1;
	}
	
	private function n105_inf_mkdosen_select($t00, $t01, $t02, $t03, $t04, $t05){
		$hasil 	= '<table class="table-snippet" width="100%"><tbody>';
				
		if($t00 == 0){
			//$hasil .= 'c';
			$but1 	= ' '.form_submit('but_aksi0', 'Lihat Kurikulum','class="btn-uin btn btn-inverse btn btn-small" style="margin-top:-10px;"');
			
			$data['kursemua'] = $this->api->get_api_json(URL_API_SIA.'sia_kurikulum/data_search', 'POST', 
			array('api_kode'=>38000, 'api_subkode' => 7, 'api_search' => array($t01)));
			$data['kursemua'] = array_reverse($data['kursemua']);
			
			$data['kurbaru'] = $this->api->get_api_json(URL_API_SIA.'sia_kurikulum/data_search', 'POST', 
			array('api_kode'=>38000, 'api_subkode' => 8, 'api_search' => array($t01)));
			
			//if(!empty($data['kurbaru'])){ $kur1 = $data['kurbaru'][0]['KD_KUR']; } else { $kur1 = ''; }
			$kur1 = $t04;
			$arr_kur = array(); foreach($data['kursemua'] as $kur){ $arr_kur[$kur['KD_KUR']] = $kur['NM_KUR']; }
			
			$hasil .= '
				<tr>
					<td width="30%"><strong>Kurikulum</strong></td>
				    <td align=left>:</td>
					<td>&nbsp'.form_dropdown('sel_w4', $arr_kur, $kur1).$but1.'</td>
				</tr>';
		} elseif ($t00 == 1){
			//$hasil .= 'b';
			$but1 	= ' '.form_submit('but_aksi1', 'Lihat Dosen','class="btn-uin btn btn-inverse btn btn-small" style="margin-top:-10px;"');
			#echo $t05;
			$arr_y0 = array(2 => 'Semua', 0 => 'Dosen Dalam Program Studi', 1 => 'Dosen Luar Program Studi');
			$arr_y1 = array(2 => 'Semua', 0 => 'Dosen Tetap PNS', 1 => 'Dosen Luar Biasa');
			$arr_y2 = array(2 => 'Semua', 0 => 'Aktif Mengajar', 1 => 'Tidak Aktif Mengajar');
		
			$hasil .= '
			<tr>
				<td width="30%"><strong>Asal Dosen</strong></td>
				<td align=left>:</td>
				<td>&nbsp'.form_dropdown('sel_w2', $arr_y0, $t02).'</td>
			</tr>';
			$hasil .= '
			<tr>
				<td width="30%"><strong>Jenis Dosen</strong></td>
				<td align=left>:</td>
				<td>&nbsp'.form_dropdown('sel_w3', $arr_y1, $t03).''.'</td>
			</tr>';
			$hasil .= '
			<tr>
				<td width="30%"><strong>Status Dosen</strong></td>
				<td align=left>:</td>
				<td>&nbsp'.form_dropdown('sel_w5', $arr_y2, $t05).$but1.'</td>
			</tr>';
		} else { $hasil .= ''; }
		
		$hasil .= '</tbody></table>';
		return $hasil;
	}
	
	private function n101_inf_mkdosen_dosendaftar(){
		
		$this->arr_crumbs = $this->menu7->build_crumbs(array('mmds'));
		
		$sess1 = $this->session->flashdata('awalmd9');
		if($sess1 == ''){
			$this->_0422_redirect_stt('m0b2');
		} else {
			$sess0 = explode('#',$sess1);
			$data = array();
			 
			$data['i_w0'] 	= $sess0[0];
			$data['i_w1'] 	= $sess0[1];
			$data['i_w2'] 	= $sess0[2];
			$data['i_w3'] 	= $sess0[3];
			$data['i_w4'] 	= $sess0[4];
			$data['i_w5'] 	= $sess0[5];
								
			$data['e_kode'] = $sess0[2];
			
			$data['url_s0'] = $this->menu7->build_url_stt('m0b2','informasi');			
			$data['url_d0'] = $this->_0422_path_stt('mmds');
			$data['url_d1'] = $this->_0422_path_var('v0ds',t1_encode($sess1).'-%LINK%');
			$data['url_h1'] = $this->_0422_path_var('vmdp','asal');
			$data['url_h2'] = $this->_0422_path_var('vmdp','ajar');
			
			$data['init_js']	= 1;
			
			$data['dosen'] = $this->api->get_api_json(URL_API_SIA.'sia_penawaran/data_search', 'POST', 
			array('api_kode'=>58002, 'api_subkode' => 9, 'api_search' => array($data['i_w1'], $data['i_w2'], $data['i_w5'])));
			
			$this->n105_inf_mkdosen_prodi($data);
			
			//MENYESUAIKAN DGN DATA LAMA
			$data['i_y1']	= $data['i_w3'];
			
			$data['i_sel0']	= $this->n105_inf_mkdosen_select($data['i_w0'], $data['i_w1'], $data['i_w2'], $data['i_w3'], $data['i_w4'], $data['i_w5']);
			
			#print_r($_POST); print_r($data); die();
			$this->_101_display('dosenmk_dosendaftar', $data);
			
		}
	}
	
	private function n101_inf_mkdosen_dosendetil($kode){
		$kode1 		= explode('-',$kode);
		$sess1 		= t1_decode($kode1[3]); $sess0 = explode('#',$sess1);
		$kd_dosen	= t1_decode($kode1[4]);
		
		$data = array();
							
		$data['dosen']		= $this->api->get_api_json(URL_API_SIA.'sia_dosen/data_search', 'POST', 
							array('api_kode'=>20000, 'api_subkode' => 3, 'api_search' => array($kd_dosen)));

		if(!empty($data['dosen'])){
			if($this->input->post('but_cetak') != ''){
				
			} else {
				$data['i_w0'] 	= $sess0[0];
				$data['i_w1'] 	= $sess0[1];
				$data['i_w2'] 	= $sess0[2];
				$data['i_w3'] 	= $sess0[3];
				$data['i_w4'] 	= $sess0[4];
				$data['i_w5'] 	= $sess0[5];
				
				$data['init_js']= 1;
				
				if($data['dosen'][0]['KD_PRODI'] == $data['i_w1']){ $data['i_y0'] = 0; } else { $data['i_y0'] = 1; }
				if($data['dosen'][0]['NIP'] != ''){ $nip1 = $data['dosen'][0]['NIP']; } else { $nip1 = $data['dosen'][0]['KD_DOSEN']; }
				if(sia_cek_dosenpns($nip1)){ $data['i_y1'] = 0; } else { $data['i_y1'] = 1; }
								
				$data['kelas']		= $this->api->get_api_json(URL_API_SIA.'sia_penawaran/data_search', 'POST', 
									array('api_kode'=>58000, 'api_subkode' => 36, 'api_search' => array($data['i_w1'], $kd_dosen)));
				
				$data['url_s0'] 	= $this->menu7->build_url_stt('m0b2','informasi');		
				$data['url_d0'] 	= $this->_0422_path_stt('mmds');
				$data['url_d1'] 	= $this->_0422_path_var('vmds','%LINK%');
				$data['url_h1'] 	= $this->_0422_path_var('vmdp','asal');
				$data['url_h2'] 	= $this->_0422_path_var('vmdp','ajar');
				$data['url_d2'] 	= $this->_0422_path_var('v0mk',$kode1[3].'-%LINK%');
				
				$this->n105_inf_mkdosen_prodi($data);
				
				$data['i_sel0']	= $this->n105_inf_mkdosen_select($data['i_w0'], $data['i_w1'], $data['i_w2'], $data['i_w3'], $data['i_w4'], $data['i_w5']);
				
				$data['smt_123'] = $this->api->get_api_json(URL_API_SIA.'sia_krs/data_view', 'POST', 
				array('api_kode'=>51000, 'api_subkode' => 2));
				
				$data['ta_123'] = $this->api->get_api_json(URL_API_SIA.'sia_krs/data_view', 'POST', 
				array('api_kode'=>50000, 'api_subkode' => 1));
				
				$this->_101_display('dosenmk_dosendetil', $data);
			} 
		} else { $this->_0422_redirect_stt('max9'); }
	}
	
	private function n101_inf_mkdosen_matkuldaftar(){
		
		$sess1 = $this->session->flashdata('awalmd9');
		if($sess1 == ''){
			$this->_0422_redirect_stt('m0b2');
		} else {
			$sess0 = explode('#',$sess1); 
			$data = array();
			 
			$data['i_w0'] 	= $sess0[0];
			$data['i_w1'] 	= $sess0[1];
			$data['i_w2'] 	= $sess0[2];
			$data['i_w3'] 	= $sess0[3];
			$data['i_w4'] 	= $sess0[4];
			$data['i_w5'] 	= $sess0[5];
								
			$data['init_js']= 1;
			$data['e_kode'] = $sess0[2];
			
			$data['url_s0'] = $this->menu7->build_url_stt('m0b2','informasi');	
								
			$data['kurpilih'] = $this->api->get_api_json(URL_API_SIA.'sia_kurikulum/data_search', 'POST', 
			array('api_kode'=>38000, 'api_subkode' => 3, 'api_search' => array($data['i_w4'])));
				
			$data['kursemua'] = $this->api->get_api_json(URL_API_SIA.'sia_kurikulum/data_search', 'POST', 
			array('api_kode'=>38000, 'api_subkode' => 7, 'api_search' => array($data['i_w1'])));
				
			$data['kurdaftar'] = $this->api->get_api_json(URL_API_SIA.'sia_kurikulum/data_search', 'POST', 
			array('api_kode'=>40000, 'api_subkode' => 15, 'api_search' => array($data['kurpilih'][0]['KD_KUR'])));
			
			#$data['prasya'] = $this->api->get_api_json(URL_API_SIA.'sia_kurikulum/data_search', 'POST', 
			#array('api_kode'=>40000, 'api_subkode' => 16, 'api_search' => array($data['kurpilih'][0]['KD_KUR'], '10651025')));
						
			$data['url_d1'] 		= $this->_0422_path_var('v0mk',t1_encode($sess1).'-%LINK%');
			$data['url_link']		= 'informasi';
			
			$this->n105_inf_mkdosen_prodi($data);
			
			$data['i_sel0']	= $this->n105_inf_mkdosen_select($data['i_w0'], $data['i_w1'], $data['i_w2'], $data['i_w3'], $data['i_w4'], $data['i_w5']);
			
			$this->_101_display('dosenmk_matkuldaftar', $data);
		}
		
	}
	
	private function n101_inf_mkdosen_matkuldetil($kode){
		
		$kode1 		= explode('-',$kode);
		$sess1 		= t1_decode($kode1[3]); $sess0 = explode('#',$sess1);
		$kode2		= t1_decode($kode1[4]); $kode21 = explode('#',$kode2);
		$kd_kur		= $kode21[0];
		$kd_mk		= $kode21[1];
		
		$data = array();
		
		$data['i_w0'] 	= $sess0[0];
		$data['i_w1'] 	= $sess0[1];
		$data['i_w2'] 	= $sess0[2];
		$data['i_w3'] 	= $sess0[3];
		$data['i_w4'] 	= $sess0[4];
		$data['i_w5'] 	= $sess0[5];
								
		$data['init_js']= 1;
			
		$data['url_s0'] = $this->menu7->build_url_stt('m0b2','informasi');	
		
		$kd_prodi			= $data['i_w1'];
			
		$data['ekd_kelas']	= $kode1[4];
		$data['matkul']		= $this->api->get_api_json(URL_API_SIA.'sia_kurikulum/data_search', 'POST', 
							array('api_kode'=>40000, 'api_subkode' => 17, 'api_search' => array($kd_prodi, $kd_kur, $kd_mk)));
		
		$data['url_link']	= 'informasi';
			
		$this->n105_inf_mkdosen_prodi($data);
		
		$data['i_sel0']	= $this->n105_inf_mkdosen_select($data['i_w0'], $data['i_w1'], $data['i_w2'], $data['i_w3'], $data['i_w4'], $data['1_w5']);
		
		if(!empty($data['matkul'])){
							
			$data['prasya']	= $this->api->get_api_json(URL_API_SIA.'sia_kurikulum/data_search', 'POST', 
							array('api_kode'=>41000, 'api_subkode' => 4, 'api_search' => array($kd_prodi, $kd_kur, $kd_mk, '10651025')));
				
			$data['kelas']	= $this->api->get_api_json(URL_API_SIA.'sia_penawaran/data_search', 'POST', 
							array('api_kode'=>59000, 'api_subkode' => 6, 'api_search' => array($kd_prodi, $kd_kur, $kd_mk)));
				
			$data['setara']	= $this->api->get_api_json(URL_API_SIA.'sia_kurikulum/data_search', 'POST', 
							array('api_kode'=>42000, 'api_subkode' => 6, 'api_search' => array($kd_prodi, $kd_kur, $kd_mk)));
			
			$data['url_d1'] = $this->_0422_path_var('v0mk',$kode1[3].'-%LINK%');
			$data['url_d2'] = $this->_0422_path_var('v0ds',$kode1[3].'-%LINK%');
			
			$this->_101_display('dosenmk_matkuldetil', $data);
		} else { $this->_0422_redirect_stt('max9'); }
	}
	
	function index(){ 
		$data = array();
		$data = $this->_0422_at_every($data);
		$data['adm04_app'] = '';
		
		$data['pengumuman1']= $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_search', 'POST', 
		array('api_kode'=>88001, 'api_subkode' => 5, 'api_search' => array('ADM')));
		
		$this->output9->output_display('04_staff/def/s04_vw_awal', array('data' => $data)); }
	
	public function v101_router($jenis, $kat = '', $txt = ''){
		$jenis = intval($jenis);
		switch($jenis){
			case 1: $this->n101_berita_post($kat, $txt); break;
			case 2: $this->n101_berita_arsip($kat, $txt); break; break;
			case 3: $this->n101_berita_rss($kat, $txt); break;
			default: redirect('error'); break;
		}
	}
	
	public function v105_router($cat = ''){
		/*
		akademik.uin-suka.ac.id/sesuatu.html				$var_exist = false
		akademik.uin-suka.ac.id/detil-kelas-xxxxxx.html		$var_exist = true
		*/
		#echo $cat; die();
		//01. check for prefix and URL format
		$cat = 'awal-'.trim($cat);
		if(substr($cat, (-1 * strlen($this->url_prefix))) != $this->url_prefix) { $cat = 'error'; } 
		else { $cat = substr($cat,0,(strlen($cat) - strlen($this->url_prefix))); }

		$var_exist = false;
		
		//02. check for variable URL:
		foreach($this->arr_url_var as $key1 => $val1){
			$val11 = explode('#',$val1);
			if(substr($key1,0,2) == 'v0'){ if(substr($cat,0,strlen($val11[0])) == $val11[0]) { 
				call_user_func_array(array($this, $val11[1]), array($cat));
				$var_exist = true; break; 
			}}
		}
				
		$stt_exist = false;
		
		//03. check for static URL:
		if(!$var_exist){
			foreach($this->arr_url_stt as $key2 => $val2){
				$val21 = explode('#',$val2);
				
				if(substr($key2,0,2) == 'm0'){ if($cat == $val21[0]){ 
					if(isset($val21[2])){ $param_tt = array($val21[2],$cat); } else { $param_tt = array($cat); }
					call_user_func_array(array($this, $val21[1]), $param_tt);
					$stt_exist = true; break; 
				}}
			}
			
			//04. if page isn't exist:
			if(!$stt_exist){
				$this->_0400_error($this->_0422_error_msg(array('404')));
			}
		}
	}
	
	//----------------------------------------------------------------
	//	01. DATA PROCESS, NOT INVOLVING INSERT, UPDATE, DELETE (0422)
	//----------------------------------------------------------------
	
	function _0422_redirect_stt($id=''){
		$url1 = $this->arr_url_stt[$id]; $url1 = explode('#',$url1);
		#echo $this->url_link.'/'.$url1[0].$this->url_prefix;
		redirect($this->url_link.'/'.$url1[0].$this->url_prefix);
	}
	
	function _0422_redirect_var($id='', $var1 = ''){
		if($var1 != ''){ $var1 = '-'.$var1; }
		$url1 = $this->arr_url_var[$id]; $url1 = explode('#',$url1);
		redirect($this->url_link.'/'.$url1[0].$var1.$this->url_prefix);
	}
	
	function _0422_path_stt($id=''){
		$url1 = $this->arr_url_stt[$id]; $url1 = explode('#',$url1);
		return $this->url_link.'/'.$url1[0].$this->url_prefix;
	}
	
	function _0422_path_var($id='', $var1 = ''){
		if($var1 != ''){ $var1 = '-'.$var1; }
		$url1 = $this->arr_url_var[$id]; $url1 = explode('#',$url1);
		return $this->url_link.'/'.$url1[0].$var1.$this->url_prefix;
	}
	
	private function _0400_sessionid($kode){
		/* $kode1 = explode('-',$kode);
		$data['mhs'] = $this->api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
			array('api_kode'=>26000, 'api_subkode' => 10, 'api_search' => array($kode1[2])));
		
		$data['dpa'] = $this->api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
			array('api_kode'=>28000, 'api_subkode' => 7, 'api_search' => array($kode1[2])));
				
		if(!empty($data['mhs'])){
			$arr_session = array(	'mhs_nama'			=> $data['mhs'][0]['NAMA'],
									'mhs_angkatan'		=> $data['mhs'][0]['ANGKATAN'],
									'mhs_kd_prodi'		=> $data['mhs'][0]['KD_PRODI'],
									'mhs_nm_prodi'		=> $data['mhs'][0]['NM_PRODI'],
									'mhs_kd_jurusan'	=> $data['mhs'][0]['KD_JURUSAN'],
									'mhs_nm_jurusan'	=> $data['mhs'][0]['NM_JURUSAN'],
									'mhs_kd_fak'		=> $data['mhs'][0]['KD_FAK'],
									'mhs_nm_fak'		=> $data['mhs'][0]['NM_FAK'],
									'mhs_foto'			=> $data['mhs'][0]['FOTO1'],
									'mhs_status'		=> $data['mhs'][0]['NM_STATUS'],
									'mhs_jenjang'		=> $data['mhs'][0]['NM_JENIS'],
									'mhs_kelamin'		=> $data['mhs'][0]['NM_J_KELAMIN'],
									'mhs_dpa_nama'		=> $data['dpa'][0]['NM_DOSEN'],
									'mhs_dpa_nip'		=> $data['dpa'][0]['NIP'],
									'id_user'			=> $kode1[2],
		);
		
			$this->session->set_userdata($arr_session);
		}
		
		redirect($this->url_link); */
	}
	
	function _0422_at_every($data1 = array()){
		$data1['back_url'] 	= current_url();
		$data1['cek_smt'] 	= $this->cek_smt;
		$data1['cek_ta'] 	= $this->cek_ta;
		$data1['smt_123']	= $this->smt_123; 
		$data1['ta_123']	= $this->ta_123; 
		$data1['url_link']	= $this->url_link;
		$data1['url_prefix']= $this->url_prefix;
		
		$data1['mstt']		= $this->arr_mnu_stt;
		$data1['ustt']		= $this->arr_url_stt;
		$data1['uvar']		= $this->arr_url_var;
		$data1['crumbs']	= $this->arr_crumbs;
		
		$data1['log_portal']= 	$this->api->get_api_json(URL_API_SIA.'sia_sistem/data_search', 
								'POST', array('api_kode'=>101001, 'api_subkode' => 1, 
								'api_search' => array($this->session->userdata('id_user'))));
		
		if(!isset($data1['adm04_app'])){ $data1['adm04_app'] = ''; }
		return $data1;
	}
	
	private function _0422_decode_kode($kode = '', $toarray = false){
		//ex: krs-spamb-xxx.asp
		$k1 = explode('-',trim($kode)); 
		$k2 = explode('.', $k1[2]); 
		if($toarray) {  return explode('#', t1_decode($k2[0])); } else { return t1_decode($k2[0]); }
	}
	
	private function _0422_send_api_admin($kode, $subkode, $req_type, $api_search){
		$this->load->helper(array('sia_hlp_pdf','sia_hlp_form'));
		$parameter = array('mhs_kode' => $kode, 'subkode' => $subkode, 'request_type' => $req_type);
		for($i = 0; $i < count($api_search); $i++){ $parameter['var'.($i+1)] = $api_search[$i]; } $parameter['api_search'] = $api_search;
		$v_nim		= $this->session->userdata('id_user');		
		if(0<1):
		header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="cetak'.uniqid($nim).'.pdf"');
		header('Content-Transfer-Encoding: binary');
		header('Accept-Ranges: bytes');
		endif;
		
		#header('Content-Length: ' . filesize($file));
		
		#echo $this->api->get_api(URL_API_ADMIN.'print_mhs','POST',$parameter);
		echo $this->api->get_api('00_admin/s00_ct_printer_new/print_mhs','POST',$parameter);
	}
	
	private function _0422_match_tasmt(){
		$tasmt_sess = $this->session->userdata('kd_ta').'#'.$this->session->userdata('kd_smt');
		$tasmt_now 	= $this->cek_ta[0]['KD_TA'].'#'.$this->cek_smt[0]['KD_SMT'];
		if($tasmt_sess != $tasmt_now) { redirect('logout'); }
	}
	
	private function _0422_error_msg($arr = array()){
		/*
		//Array ( [code] => 20042 [message] => ORA-20042: MAAF, ANDA BELUM PERNAH MENGAMBIL MATA KULIAH INI SEBELUMNYA ORA-06512: at "SIA.P_INPUT_DETAIL_KRS_PENDEK", line 154 [offset] => 5 [sqltext] => CALL P_INPUT_DETAIL_KRS_PENDEK(:var1, :var2, :var3, :var4) )
		*/
		$arrh = array();
		switch($arr[0]){
			case 'no-krs-kuliah': 
				$arrh = array(453, 'MAAF, SAAT INI KEGIATAN PERKULIAHAN UNTUK PRODI ANDA SEDANG BERLANGSUNG. <br>JADI, ANDA TIDAK SEDANG BERADA DI MASA INPUT KRS'); break;
			case 'no-krs-stop': 
				$arrh = array(454, 'MAAF, PROSES INPUT KRS UNTUK PRODI ANDA DIHENTIKAN UNTUK BEBERAPA SAAT'); break;
				#$arrh = array(454, 'MAAF, PROSES INPUT KRS UNTUK PRODI ANDA AKAN DIMULAI HARI SABTU, 24 AGUSTUS 2013 <br>PADA PUKUL 12.00 WIB'); break;
			case 'no-krs-status': 
				$arrh = array(455, 'MAAF, STATUS ANDA '.strtoupper($arr[1]).' TIDAK DIPERKENANKAN UNTUK INPUT KRS SEMESTER'); break;
			case 'no-sp-status': 
				$arrh = array(450, 'MAAF, STATUS ANDA '.strtoupper($arr[1]).' TIDAK DIPERKENANKAN UNTUK INPUT KRS SEMESTER PENDEK'); break;
			case 'no-sp-bayar': 
				$arrh = array(451, 'MAAF, ANDA BELUM MELUNASI BIAYA SEMESTER PENDEK'); break;
			case 'ikd': 
				$arrh = array(452, 'MAAF, SILAKAN MELENGKAPI INDEKS KINERJA DOSEN (IKD) TERLEBIH DAHULU'); break;
			case 'no-krssmt1': 
				$arrh = array(456, 'MAAF, UNTUK KRS SEMESTER SATU ADALAH PAKET DARI TIAP FAKULTAS'); break;
			case 'no-krs': 
				$arrh = array(457, 'MAAF, PROSES INPUT KRS SEDANG DIHENTIKAN<br> KARENA SEDANG ADA PROSES PEMAKETAN KRS SEMESTER 1 UNTUK MAHASISWA BARU'); break;
			case 'kosong-krs': 
				$arrh = array(458, 'MAAF, ANDA BELUM PERNAH MEMILIKI DATA ISIAN KRS'); break;
			case 'no-dpa': 
				$arrh = array(458, 'MAAF, ANDA BELUM MEMILIKI DOSEN PENASIHAT AKADEMIK SEHINGGA TIDAK BISA MENGAKSES HALAMAN INI.<br>HARAP ANDA MENGHUBUNGI PETUGAS AKADEMIK.'); break;
			case '404': 
				$arrh = array(404, 'MAAF, HALAMAN YANG ANDA MAKSUD TIDAK DITEMUKAN'); break;
			
			default: $arrh = array(100, 'MAAF, TERJADI KESALAHAN. HARAP LOGOUT KEMUDIAN LOGIN KEMBALI'); break;
		} 
		return array('code' => $arrh[0], 'message' => 'ORA-00'.$arrh[0].': '.$arrh[1].' ORA-00'.$arrh[0],'offset' => 0,  'sqltext' => ''); 
	}
	
	//----------------------------------------------------------------
	//	02. SHOW OUTPUT (0400)
	//----------------------------------------------------------------
	
	private function _101_display($filename = 'error', $data = array()){
		#$data = $this->_0422_at_every($data);
		$this->output9->output_display('00_share/def/a00_vw_'.$filename, array('data' => $data)); }
		
	private function _0400_error($error = array()){
		
		#$error = $this->_0422_at_every($error);
		#$this->output9->output_display('04_staff/def/s04_vw_error', array('data' => $error)); 
		$this->output9->output_display('s00_vw_error', array('data' => array())); 
	}
	
	private function _0400_error_404(){
		$this->_0400_error($this->_0422_error_msg(array('404')));
	}
	
	private function _0400_berita_daftar($jenis1 = 1){
		$data = array();
		$data['adm04_app'] = 'informasi';
		
		switch($jenis1){
			case 1:	//liputan
			$data['artikel']	= $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_limit', 'POST', 
								array('api_kode'=>88001, 'api_subkode' => 2, 'api_mulai' => 1, 'api_jumlah' => 10));  
			$data['url_tr']		= 'Liputan';
			break;
			
			case 2:	//pengumuman
			$data['artikel']	= $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_limit', 'POST', 
								array('api_kode'=>88002, 'api_subkode' => 2, 'api_mulai' => 1, 'api_jumlah' => 10));  
			$data['url_tr']		= 'Pengumuman';
			break;
			
		}
		#print_r($data); die();
		
		if($this->input->post('b_baru') != ''){
			$url1 = 'admberita-baru-'.t1_encode(strrev('baru#'.$jenis1.'#X'));
			$this->_0400_berita_ubahhapus($url1);
		} else { 
			
			$data['url_d1'] = $this->_0422_path_var('vab1','%LINK%');
			$data['url_d2'] = $this->_0422_path_var('vab2','%LINK%');
			#$data['url_d3'] = $this->_0422_path_var('vw6','%LINK%');
			$data['kd_jn'] = $jenis1;
			
			$this->arr_crumbs = $this->menu7->build_crumbs(array('mab0','mab'.$jenis1),true);
						
			$this->_0400_display('0001_berita_daftar',$data); 
		}
	}
	
	private function _0424_prep_berita_entriid($data){
		switch($data['kd_jn']){
			case 1:
				if($data['kd_id'] != 'X'){
				return $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_search', 'POST', 
						array('api_kode'=>88001, 'api_subkode' => 6, 'api_search' => array($data['kd_id'])));  
				} else {
				return array(array('PG_ID' => 'X', 'PG_JUDUL' => 'Judul', 'PG_ISI' => base64_encode('<p>Isi</p>'), 'PG_KAT1' => 'MHS', 'STATUS_FOTO' => 0, 'PG_TGLEXP_F' => date('d/m/Y H:i:s', mktime(0,0,0,date('m')+1,date('d'),date('Y')))));
				}
			break;
			
			case 2:
				if($data['kd_id'] != 'X'){
				return $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_search', 'POST', 
						array('api_kode'=>88002, 'api_subkode' => 6, 'api_search' => array($data['kd_id'])));  
				} else {
				return array(array('PN_ID' => 'X', 'PN_JUDUL' => 'Judul', 'PN_URL' => 'http://', 'PN_ISI' => base64_encode('<p>Isi</p>'), 'PN_KAT1' => 'P'.$data['kd_jn'], 'STATUS_FOTO' => 0, 'PN_TGLASL_F' => date('d/m/Y H:i:s', mktime(0,0,0,date('m')+1,date('d'),date('Y')))));
				}
			break;
			
			default: return array();
		}
		
		
	}
	
	private function _0400_berita_ubahhapus($kode = ''){
		$this->load->helper('form');
		
		$data = array();
		$data['adm04_app'] = 'informasi';
		
		$kode1		= $this->_0422_decode_kode($kode, true);
		if(count($kode1) != 3){ $this->_0422_redirect_stt('max9'); }
		
		$kd_jn		= intval(strrev($kode1[1])); if($kd_jn == 0){ $kd_jn = 1; } 
		if(intval($kd_jn) > 5){ $this->_0422_redirect_stt('max9'); }
		$kd_id		= strrev($kode1[0]);
		$kd_ak		= strrev($kode1[2]);
					
		$this->arr_crumbs = $this->menu7->build_crumbs(array('mab0','mab'.$kd_jn),true);
		
		$data['kd_ak']	= $kd_ak;	
		$data['kd_jn']	= $kd_jn;
		$data['kd_id']	= $kd_id;
		$data['tt_jn']	= $this->arr_mnu_stt['mab'.$kd_jn]; #echo $data['tt_jn'];
		$data['url_tg']	= $this->url_link.'/'.$kode.$this->url_prefix;
		
		$data['artikel']= $this->_0424_prep_berita_entriid($data);
		
		if(!empty($data['artikel'])){
			switch($kd_jn){
				case 1:
					$this->_0495_proc_berita_liputan($data);
				break;
				case 2:
					$this->_0495_proc_berita_liputan($data);
				break;
			}
			
		} else { $this->_0422_redirect_stt('max9'); }
		#print_r($data);
		
		#$data['ekd_kelas']	= $kode;
	
	}
	
	private function _0495_proc_berita_liputan($data){
			switch($data['kd_ak']){
				case 'hpus':
					$aksi	= $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_procedure', 'POST', 
								array('api_kode'=>88001, 'api_subkode' => 3, 'api_datapost' => array($data['kd_id'])));  
					$this->session->set_flashdata('fl_aksi',$aksi['result'].'#'.$aksi2['result']);
					$this->_0422_redirect_stt('mab'.$data['kd_jn']);
				break;
				
				case 'baru':
				case 'ubah':
										
					if(isset($_POST['b_simpan'])){
						
						switch($data['kd_jn']){
						case 1:
						//["7A87554", "X", "x1", "<p>q</p>", "MHS#", "24/11/2013 21:08:00", "198606252012111KKK"] 
						$uploadfoto = false;
						$kat1 = 'MHS#'; if(isset($_POST['v_k1'])){ $kat1 = implode('#',$_POST['v_k1']); }
						
						$api_datapost = array(
							substr(str_shuffle(strtoupper(uniqid('K'))),0,7),
							$_POST['v_id'],
							$_POST['v_jd'],
							'',
							$_POST['v_isi'],
							$kat1,
							$_POST['v_te1'],
							$this->session->userdata('id_user'),
							url_title($_POST['v_jd'],'_',TRUE),
						);
						
						$aksi	= $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_procedure', 'POST', 
								array('api_kode'=>88001, 'api_subkode' => 1, 'api_datapost' => $api_datapost));  
						
						if($aksi['result']){
							if($_POST['v_hfoto'] == 'ubah'){
								if(isset($_POST['v_ftcek'])){
									if($_FILES['v_foto']['tmp_name'] != ''){
										$uploadfoto = true;
									}
								}
							} elseif ($_POST['v_hfoto'] == 'baru'){
								if($_FILES['v_foto']['tmp_name'] != ''){
									$uploadfoto = true;
								}
							}
						
							if($uploadfoto){
								$aksi2	= $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_procedure', 'POST', 
										array('api_kode'=>88001, 'api_subkode' => 2, 'api_datapost' => array($_POST['v_id'], base64_encode(file_get_contents($_FILES['v_foto']['tmp_name']))))); 
							}
						}
						$this->session->set_flashdata('fl_aksi',$aksi['result'].'#'.$aksi2['result']);
						break;
						
						case 2:
						$api_datapost = array(
							substr(str_shuffle(strtoupper(uniqid('K'))),0,7),
							$_POST['v_id'],
							$_POST['v_jd'],
							$_POST['v_url'],
							'',
							$data['kd_jn'],
							str_replace('-','/',fulltoday_foracle()),
							$this->session->userdata('id_user'),
							url_title($_POST['v_jd'],'_',TRUE),
						);
						
						$aksi	= $this->api->get_api_json(URL_API_SIA.'sia_pengumuman/data_procedure', 'POST', 
								array('api_kode'=>88002, 'api_subkode' => 4, 'api_datapost' => $api_datapost));  
						$this->session->set_flashdata('fl_aksi',$aksi['result']);
						break;
						}
						
						$this->_0422_redirect_stt('mab'.$data['kd_jn']);	
										
					} elseif (isset($_POST['b_preview'])) {
					
					} elseif (isset($_POST['b_batal'])) {
						$this->_0422_redirect_stt('mab'.$data['kd_jn']);				
					} else {
						$this->_0400_display('0001_berita_edit',$data); 
					}
				break;
				default: $this->_0422_redirect_stt('max9'); break;
			}
	}
}

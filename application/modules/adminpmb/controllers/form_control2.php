<?php

/**
* 
*/
class Form_control extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('webserv');
		$this->load->library("lib_wilayah_fungsi", '', 'wilayah');
		$this->api 		= $this->s00_lib_api;
	}

	function index()
	{
		
	}


	 function ajax_wilayah(){
        if($this->input->post('aksi') == 'prop'){
            $kd_prop = $this->input->post('kd_prop');
            
            $arrkab = $this->api->get_api_json('http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_search', 'POST',
            array('api_kode'=>12000, 'api_subkode' => 4 ,'api_search' => array($kd_prop)));
            
            if(!empty($arrkab)){
                $select_kab = '';
                foreach($arrkab as $idx => $ab){
                    if(substr($ab['NM_KAB'],0,12) == 'KAB. LAINNYA'){
                        $KD_KAB_LAIN=$ab['KD_KAB'];
                        continue;
                    }
                    $select_kab .= '<option value="'.$ab['KD_KAB'].'">'.$ab['NM_KAB'].'</option>';
                }
                $select_kab=$select_kab.'<option value="'.$KD_KAB_LAIN.'">KABUPATEN LAINNYA</option>';
            }else{ $select_kab  = '<option value="">-</option>'; }
            
            echo json_encode(array('kab' => $select_kab));
        }elseif($this->input->post('aksi') == 'kab'){
            $kd_kab = $this->input->post('kd_kab');
            
            $arrkec = $this->api->get_api_json('http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_search', 'POST',
            array('api_kode'=>13000, 'api_subkode' => 4 ,'api_search' => array($kd_kab)));
            
            $select_kec = '';
            foreach($arrkec as $idx => $ab){
                $select_kec .= '<option value="'.$ab['KD_KEC'].'">'.strtoupper($ab['NM_KEC']).'</option>';
            }
            $select_kec.='<option value="999999">KEC. LAINNYA</option>';
            echo json_encode(array('kec' => $select_kec));
        }else{
            redirect('data-pendaftar');
        }
    }
	function input_form()
	{
		$data['data_form_aktif'] = $this->webserv->admisi('data_form/form',array());
		$data['content']="form/input_form";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	

	function after_grup_form_set($kode_jalur)
	{
		$data['grup_form']=$this->webserv->admisi('data_form/admin_grup_form',array());
		$data['form_item']=$this->webserv->admisi('data_form/form',array());
		$kode['kode_jalur']=$kode_jalur;
		$kirim_data=array('CARI_DATA_GRUP'=>$kode);
		$data['data_grup'] = $this->webserv->admisi('data_form/ambil_detail_grup_form',$kirim_data);
		$data['pilih_form']=$this->webserv->admisi('data_form/ambil_grup_form',$kirim_data);
		
		if($data)
		{
			
			$this->load->view('v_table/view_grup_form',$data);
		}
	}

	function delete_grup_form()
	{

		$nomor['kode_grup_form']=$this->input->post('kode_grup_form');
		$nomor['kode_jalur']=$this->input->post('kode_jalur');
		
		$data=array('DELETE_GRUP'=>$nomor);
		
		$hasil=$this->webserv->admisi('data_form/delete_grup_form',$data);
		if($hasil)
		{
			$this->after_grup_form_set($nomor['kode_jalur']);
		}
		else
		{
			echo "gagal";
		}
		
	}

	function hapus_item_form()
	{

		$data['kode_form']=$this->input->post('kode_form');
		$data['kode_grup_form']=$this->input->post('kode_grup_form');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$form=array('HAPUS_FORM'=>$data);
		$hasil=$this->webserv->admisi('data_form/hapus_jalur_form',$form);
		
		if($hasil)
		{
			$this->after_grup_form_set($data['kode_jalur']);
		}
		else
		{
			echo "gagal";
		}
	}

	function insert_grup_jalur()
	{
		$data['kode_grup_form']=$this->input->post('kode_grup_form');
		$data['kode_form']=$this->input->post('kode_form');
		$data['kode_jalur']=$this->input->post('kode_jalur');

		$insert_data=array('INSERT_DATA'=>$data);
		$hasil=$this->webserv->admisi('data_form/insert_grup_jalur_form',$insert_data);
		if($hasil)
		{
			$this->after_grup_form_set($data['kode_jalur']);
		}
		else
		{
			echo "gagal";
		}
	}

	function delete_grup_jalur()
	{
		$data['kode_grup_form']=$this->input->post('kode_grup_form');
		$data['kode_form']=$this->input->post('kode_form');
		$data['kode_jalur']=$this->input->post('kode_jalur');

		$insert_data=array('DELETE_SAJA'=>$data);
		$hasil=$this->webserv->admisi('data_form/delete_grup_jalur_form',$insert_data);
		
	}


	function tampil_data_form()
	{
		$data['kode_grup_form']=$this->input->post('kode_grup');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		
		$id=array('kode_grup_form'=>$data['kode_grup_form']);
		$daftar_form=array('CARI_DATA_GRUP'=>$id);
		$ambil=array('CARI_DATA_GRUP'=>$data);
		$data['form']=$this->webserv->admisi('data_form/detail_grup_form',$daftar_form);
		$data['pilih_form']=$this->webserv->admisi('data_form/ambil_grup_form',$ambil);
		$data['pilih_grup']=$this->input->post('id');
		$this->load->view('form/form_grup',$data);
	}

	function lihat_form()
	{
		$data['data_form_aktif'] = $this->webserv->admisi('data_form/form',array());
		$data['content']="form/lihat_form";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function simpan_setting_grup_form()
    {
  		$id_grup=$this->input->post('kode_grup');
    	$kode_form=$this->input->post('nama_form');
 		
    	$insert_data=array(
    		'DATA_GRUP'=>$id_grup,
    		'DATA_FORM'=>$kode_form);

		$data=array('INSERT_DATA'=>$insert_data);
    	$hasil=$this->webserv->admisi('data_form/insert_setting_grup_form',$data);
    	
			if($hasil)
				{
					$this->load->view('form/table_grup_form');
				}
		
    }

	function simpan_data_form()
	{
		$kode_form=$this->input->post('kode_form');
		$nama_form=$this->input->post('nama_form');
		$status_form=$this->input->post('status_form');
		
		$insert_data=array(
			'kode_form'=>$kode_form,
			'nama_form'=>$nama_form,
			'status_form'=>$status_form
			);

			$data=array('INSERT_DATA'=>$insert_data);
			
			$hasil=$this->webserv->admisi('data_form/insert_data_form',$data);
			
			if($hasil)
				{
					$this->session->set_flashdata('message', 'Data berhasil disimpan.');
					redirect('adminpmb/form_control/input_form');
				}
			
	}

	function data_diri()
	{
		$data['data_negara'] = $this->webserv->admisi('data_form/negara',array());
		$data['data_provinsi'] = $this->webserv->admisi('data_form/provinsi',array());
		$data['data_kabupaten'] = $this->webserv->admisi('data_form/kabupaten',array());
		$data['data_agama'] = $this->webserv->admisi('data_form/agama',array());
		$this->load->view("form/data_diri",$data);
	}

	function data_keluarga()
	{
		$this->load->view("form/data_keluarga");
	}

	function data_ibu()
	{
		$data['data_negara'] = $this->webserv->admisi('data_form/negara',array());
		$data['data_provinsi'] = $this->webserv->admisi('data_form/provinsi',array());
		$data['data_kabupaten'] = $this->webserv->admisi('data_form/kabupaten',array());
		$data['data_agama'] = $this->webserv->admisi('data_form/agama',array());
		$this->load->view("form/data_ibu",$data);
	}
	function data_bapak()
	{
		$this->load->view("form/data_bapak");
	}
	function data_kesehatan()
	{
		$this->load->view("form/data_kesehatan");
	}
	function data_prestasi()
	{
		$this->load->view("form/data_prestasi");
	}
	function data_riwayat_pendidikan_formal()
	{
		$this->load->view("form/data_riwayat_pendidikan_formal");
	}
	function data_minat_dan_ketrampilan()
	{
		$this->load->view("form/data_minat_dan_ketrampilan");
	}
	function data_wali()
	{
		$this->load->view("form/data_wali");
	}
	function data_kegiatan()
	{
		$this->load->view("form/data_kegiatan");
	}
	function data_rumah_tinggal_keluarga()
	{
		$this->load->view("form/data_rumah_tinggal_keluarga");
	}
	function data_organisasi()
	{
		$this->load->view("form/data_organisasi");
	}
	function data_riwayat_nilai_pendidikan_formal()
	{
		$this->load->view("form/data_riwayat_nilai_pendidikan_formal");
	}
	function data_kontak_darurat()
	{
		$this->load->view("form/data_kontak_darurat");
	}
	function data_rencana_hidup()
	{
		$this->load->view("form/data_rencana_hidup");
	}
	function data_riwayat_pendidikan_sebelumnya()
	{
		$this->load->view("form/data_riwayat_pendidikan_sebelumnya");
	}
}
<?php

/**
* 
*/
class Fpdf_c extends CI_Controller
{
	
	private $nama_sekolah;
	private $nama_pend;
	private $nilai;
	private $kode_jadwal;
	private $isi1,$isi2,$isi3;
	private $kode_penawaran;
	private $kode_jalur;

	private $catatan=array();
	private $data_uin=array();
	private $data_diri=array();
	private $data_piljur=array();
	private $data_ruang=array();
	private $data_lokasi=array();
	private $data_jadwal=array();
	private $pendidikan=array();
	private $kesehatan=array();
	private $difable=array();
	private $pendidikans1=array();
	private $detail_jadwal=array();
	private $kelas;
	private $func;
	private $tahun="0";
	private $uin=array();
	private $diri=array();
	private $jur=array();
	private $ruang_uji=array();
	private $lokasi=array();
	private $jadwal=array();
	private $pend=array();
	private $kes=array();
	private $dif=array();
	private $pends1=array();
	private $dt_jadwal=array();
	private $prodi1="0";
	private $prodi2="0";
	private $prodi3="0";
	private $catat=array();

	function __construct()
	{
		parent::__construct();
		$this->load->library('fpdf');


	}

	function index()
	{
		
		
	}

	function khusus($jalur)
	{
		$bintang="";
		$jalur=str_replace(" ", "", $jalur);
		switch ($jalur) {
			case '11':
				$bintang="";
				break;
			case '12':
				$bintang="";
				break;
			case '13':
				$bintang="";
				break;
			case '21':
				$bintang="";
				break;
			case '22':
				$bintang=" * ";
				break;
			case '31':
				$bintang="";
				break;
			case '32':
				$bintang=" * ";
				break;
			
		}
		return $bintang;
	}

	function tanggal_hari($tanggal){
	$tgl=explode("-",$tanggal);
	$info=date('w', mktime(0,0,0,$tgl[1],$tgl[0],$tgl[2]));
	switch($tgl[1]){
			case '01': $bulan= "Januari"; break;
			case '02': $bulan= "Februari"; break;
			case '03': $bulan= "Maret"; break;
			case '04': $bulan= "April"; break;
			case '05': $bulan= "Mei"; break;
			case '06': $bulan= "Juni"; break;
			case '07': $bulan= "Juli"; break;
			case '08': $bulan= "Agustus"; break;
			case '09': $bulan= "September"; break;
			case '10': $bulan= "Oktober"; break;
			case '11': $bulan= "Nopember"; break;
			case '12': $bulan= "Desember"; break;
		};
		switch($info){
			case '0': $hari= "Minggu"; break;
			case '1': $hari= "Senin"; break;
			case '2': $hari= "Selasa"; break;
			case '3': $hari= "Rabu"; break;
			case '4': $hari= "Kamis"; break;
			case '5': $hari= "Jumat"; break;
			case '6': $hari= "Sabtu"; break;
		};
	$tampil_tanggal=$hari.", ".$tgl[0]." ".$bulan." ".$tgl[2];
	return $tampil_tanggal;
}

function tanggal($tanggal){
	$tgl=explode("-",$tanggal);
	switch($tgl[1]){
			case '01': $bulan= "Januari"; break;
			case '02': $bulan= "Februari"; break;
			case '03': $bulan= "Maret"; break;
			case '04': $bulan= "April"; break;
			case '05': $bulan= "Mei"; break;
			case '06': $bulan= "Juni"; break;
			case '07': $bulan= "Juli"; break;
			case '08': $bulan= "Agustus"; break;
			case '09': $bulan= "September"; break;
			case '10': $bulan= "Oktober"; break;
			case '11': $bulan= "Nopember"; break;
			case '12': $bulan= "Desember"; break;
		};
	$tampil_tanggal=$tgl[0]." ".$bulan." ".$tgl[2];
	return $tampil_tanggal;
}

	function ambil_data($id)
	{
		
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('VERIF_DATA_DIRI'=>$nomor);
		$this->data_diri=$this->webserv->admisi('data_form/verifikasi_data_diri',$nomor_pendaftar);
		$this->data_piljur=$this->webserv->admisi('data_form/verifikasi_pilihan_jurusan',$nomor_pendaftar);
		$this->data_ruang=$this->webserv->admisi('data_form/cari_ruang_peserta',$nomor_pendaftar);
		$this->data_lokasi=$this->webserv->admisi('data_form/ruang_ujian',$nomor_pendaftar);
		$this->data_jadwal=$this->webserv->admisi('data_form/jadwal_pilih',$nomor_pendaftar);
		$this->pendidikan=$this->webserv->admisi('data_form/verifikasi_data_riwayat_pendidikan_s2',$nomor_pendaftar);
		$this->kesehatan=$this->webserv->admisi('data_form/verifikasi_data_kesehatan',$nomor_pendaftar);
		$this->difable=$this->webserv->admisi('data_form/verifikasi_kemampuan_berbeda',$nomor_pendaftar);
		$pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$this->pendidikans1=$this->webserv->admisi('data_form/pendidikan_terakhir',$pendaftar);
		$this->data_uin=$this->webserv->admisi('data_form/data_uin2',array());
		
		if(!is_null($this->data_uin))
		{
			foreach ($this->data_uin as $du) {
				$this->uin=(array) $du;
			}

		}

		if(!is_null($this->pendidikans1))
		{
			foreach ($this->pendidikans1 as $s1) {
			$this->pends1=(array)$s1;
			}
		}
		else
		{
			$this->pends1=array('nama_sekolah'=>'','jurusan_sekolah'=>'','nilai_sttb'=>'');
		}
		

		
		if(!is_null($this->difable))
		{
			foreach ($this->difable as $beda) {
				$this->dif=(array)$beda;
			}
		}
		else
		{
			$this->dif=array('kondisi_kesehatan'=>'Normal');
		}
		
		if(!is_null($this->kesehatan))
		{
			foreach ($this->kesehatan as $sehat) 
			{
				$this->kes=(array)$sehat;
			}
		}
		else
		{
			$this->kes=array('riwayat_penyakit'=>'Tidak Ada');
		}

		foreach ($this->data_diri as $dadir)
		{
			$this->diri=(array)$dadir;
		}
		foreach ($this->data_ruang as $ruang)
		{
			$this->ruang_uji=(array)$ruang;
		}
		foreach ($this->data_piljur as $jurusan)
		{
			$this->kelas=$jurusan->nama_kelas;
			switch ($jurusan->pilihan) {
				case '1':
					$this->prodi1=$jurusan->nama_prodi.' ('.$jurusan->nama_jenjang.')';
					break;
				case '2':
					$this->prodi2=$jurusan->nama_prodi.' ('.$jurusan->nama_jenjang.')';
					break;
				case '3':
					$this->prodi3=$jurusan->nama_prodi.' ('.$jurusan->nama_jenjang.')';
					break;
			}
		}
		foreach ($this->data_lokasi as $lokasi)
		{
			$this->lokasi=(array)$lokasi;
		}
		foreach ($this->data_jadwal as $jadwal)
		{
			$this->jadwal=(array)$jadwal;
			$this->kode_jadwal=$jadwal->kode_jadwal;
			$this->kode_penawaran=$jadwal->kode_penawaran;
		}

		if(!is_null($this->pendidikan))
		{

			foreach ($this->pendidikan as $pendidikan)
			{
			$this->pend=(array)$pendidikan;
			}
		}
		else
		{
			$this->pend=array('nama_pendidikan'=>'','nama_pt'=>'','ipk'=>'');
		}

		foreach ($this->data_piljur as $jenjang) {
			$this->jur=(array)$jenjang;
			$jalur=$jenjang->nama_jenjang;
			$this->kode_jalur=$jenjang->kode_jalur;
		}


		switch ($jalur) {
			case 'S1':
						$this->nama_pend='Sekolah';
						$this->nama_sekolah='Jurusan';
						$this->nilai='Nilai STTB';
						$this->isi1=$this->pends1['nama_sekolah'];
						$this->isi2=$this->pends1['nama_jurusan_sekolah'];
						$this->isi3=$this->pends1['nilai_sttb'];
						$this->tahun=$this->pends1['tahun_lulus'];
				break;
			case 'S2':
						$this->nama_pend='Lulusan';
						$this->nama_sekolah='Nama PT';
						$this->nilai='IPK';
						$this->isi1=$this->pend['nama_pendidikan'];
						$this->isi2=$this->pend['nama_pt'];
						$this->isi3=$this->pend['ipk'];
						$this->tahun=$this->pend['tahun_ijazah'];
				break;
			case 'S3':
						$this->nama_pend='Lulusan';
						$this->nama_sekolah='Nama PT';
						$this->nilai='IPK';
						$this->isi1=$this->pend['nama_pendidikan'];
						$this->isi2=$this->pend['nama_pt'];
						$this->isi3=$this->pend['ipk'];
						$this->tahun=$this->pend['tahun_ijazah'];
				break;
		}
		
		$data_jadwal['kode_jadwal']=$this->kode_jadwal;
		$kirim_jadwal=array('DETAIL_JADWAL'=>$data_jadwal);

		$this->detail_jadwal=$this->webserv->admisi('pendaftaran/detail_jadwal',$kirim_jadwal);
		
		$dapen['kode_penawaran']=$this->kode_penawaran;
		$data_catatan=array('CATATAN'=>$dapen);
		$this->catatan=$this->webserv->admisi('data_form/catatan',$data_catatan);

		$link=$this->kartu();

	}
	


	function kartu()
	{

		$pdf=new FPDF('P', 'mm', 'A4');
		$pdf->AliasNbPages();
		$pdf->AddPage();

		//HEADER
		$pdf->SetFont('Times','B',11);
		$pdf->Image(pg_unescape_bytea($this->uin['logo']),10,10,18,18,'JPEG');
		$pdf->Cell(20);
		$pdf->MultiCell(100,5,$this->uin['kementrian']);
		$pdf->Cell(20);
		$pdf->MultiCell(190,4,$this->uin['nama_unit']);
		$pdf->SetFont('Times','',10);
		$pdf->Cell(20);
		$pdf->MultiCell(100,5,$this->uin['tema'].' Tahun Akademik '.$this->uin['tahun_akademik']);
		$pdf->Cell(20);
		$pdf->SetFont('Times','I',9);
		$pdf->MultiCell(190,5,$this->uin['alamat'].' Telp. '.$this->uin['telp'].' email: '.$this->uin['email']);
		$pdf->Line(10, 30, 200, 30);

		//CONTENT
		$pdf->Rect(10, 33, 100, 85, 'D');
		$pdf->Ln();
		$pdf->SetFont('Times','B',9);
		
		$pdf->Cell(35);
		$pdf->Cell(80,5,'KARTU PESERTA',0,'C');
		$pdf->MultiCell(60,5,$this->jur['jalur_masuk'].' '.$this->jadwal['gelombang'].' '.$this->kelas,0,'C');


		$pdf->Cell(5);
		$pdf->Cell(20,5,'Data Peserta',0,'L');
		$pdf->Line(10, 45, 110, 45);

		//nomor PMB
		$pdf->Ln();
		$pdf->SetFont('Times','',9);
		$pdf->Ln();
		$pdf->Cell(5);
		$pdf->Cell(20,4,'Nomor PMB',0,'L');
		$pdf->Cell(3,4,':',0,'L');
		$pdf->SetFont('Times','B',9);
		$pdf->Cell(60,4,$this->ruang_uji['nomor_peserta'],0,'L');
		
		//pilihan
		$pdf->Cell(15);
		$pdf->Cell(30,5,'Pilihan I',0,'L');

		
		//nama
		$pdf->Ln();
		$pdf->SetFont('Times','',9);
		$pdf->Cell(5);
		$pdf->Cell(20,4,'Nama',0,'L');
		$pdf->Cell(3,4,':',0,'L');
		
		if(!empty($this->diri['gelar_belakang_na']))
		{
			$gbna=', '.$this->diri['gelar_belakang_na'];
		}
		else
		{
			$gbna='';
		};

		if(!empty($this->diri['gelar_belakang']))
		{
			$gba= ', '.$this->diri['gelar_belakang'];
		}
		else
		{
			$gba='';
		};

		if(!empty($this->diri['gelar_depan_na']))
		{
			$gdna=$this->diri['gelar_depan_na'].' ';
		}
		else
		{
			$gdna='';
		};

		if(!empty($this->diri['gelar_depan']))
		{
			$gda=$this->diri['gelar_depan'].' ';
		}
		else
		{
			$gda='';
		};
		


		$pdf->MultiCell(40,3,$gdna.$gda.$this->diri['nama_lengkap'].$gba.$gbna,0,'L');

		$pdf->SetFont('Times','',9);
		$pdf->Cell(103);
		$pdf->MultiCell(80,3,$this->prodi1,0,'L');
		//FOTO
		$pdf->Image(pg_unescape_bytea($this->diri['foto']),80,50,25,27,'JPEG');

		//LULUSAN
		$pdf->Ln();
		$pdf->SetFont('Times','',9);
		$pdf->Cell(5);
		$pdf->Cell(20,5,$this->nama_pend,0,'L');
		$pdf->Cell(3,5,':',0,'L');
		$pdf->Cell(20,5,$this->isi1,0,'L');


		if($this->prodi2!='0')
		{
			
			$pdf->SetFont('Times','B',9);
			$pdf->Cell(55);
			$pdf->Cell(20,5,'Pilihan II',0,'L');
			$pdf->Ln();
			$pdf->SetFont('Times','',9);
			$pdf->Cell(103);
			$pdf->MultiCell(80,3,$this->prodi2,0,'L');
		}
		//NAMA PT
		$pdf->Ln();
		$pdf->SetFont('Times','',9);
		$pdf->Cell(5);
		$pdf->Cell(20,5,$this->nama_sekolah,0,'L');
		$pdf->Cell(3,5,':',0,'L');
		$pdf->MultiCell(28,3,$this->isi2,0,'L');

		if($this->prodi3!='0')
		{
				$pdf->SetFont('Times','B',9);
				$pdf->Cell(103);
				$pdf->Cell(20,4,'Pilihan III',0,'L');
		}
	
		
		//TAHUN
		$pdf->Ln();
		$pdf->SetFont('Times','',9);
		$pdf->Cell(5);
		$pdf->Cell(20,4,'Tahun',0,'L');
		$pdf->Cell(3,4,':',0,'L');
		$pdf->Cell(10,4,$this->tahun,0,'L');

		if($this->prodi3!='0')
		{
			$pdf->Cell(65);
			$pdf->MultiCell(80,3,$this->prodi3,0,'L');
		}

		//IPK
		$pdf->Ln();
		$pdf->SetFont('Times','',9);
		$pdf->Cell(5);
		$pdf->Cell(20,5,$this->nilai,0,'L');
		$pdf->Cell(3,5,':',0,'L');
		$pdf->Cell(10,5,$this->isi3,0,'L');

		//LOKASI UJIAN
		$pdf->Line(10, 100, 110, 100);
		$pdf->Ln();
		$pdf->Ln();
		
		if(is_null($this->detail_jadwal))
		{
			$pdf->Ln();
		}
		$pdf->SetFont('Times','',9);
		$pdf->Ln();
		$pdf->Cell(5);
		$pdf->Cell(20,5,'Lokasi Ujian',0,'L');
		$pdf->Cell(3,5,':',0,'L');
		$pdf->Cell(10,5,'Ruang '.$this->lokasi['nama_ruang'],0,'L');

		$pdf->Line(112, 100, 200, 100);

		$pdf->Ln();
		$pdf->SetFont('Times','',9);
		$pdf->Cell(5);
		$pdf->MultiCell(80,3,$this->lokasi['nama_gedung'].' '.$this->jadwal['lokasi_ujian'],0,'L');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$s=0;
				if(!is_null($this->detail_jadwal))
				{
					
					foreach ($this->detail_jadwal as $detj) 
					{
						$s+=1;
						$this->dt_jadwal=(array)$detj;
						$pdf->Cell(30,5,$this->khusus($this->kode_jalur).$s.'. '.$this->tanggal_hari(date('d-m-Y',strtotime($this->dt_jadwal['tanggal']))).' '.$this->dt_jadwal['jam_mulai'].' - '.$this->dt_jadwal['jam_selesai'].'  '.$this->dt_jadwal['nama_tes'],0,'L');
						$pdf->Ln();
					}
						
				}

		$pdf->Rect(112, 33, 88, 85, 'D');

		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Times','',10);
		$pdf->Cell(15);
		$pdf->Cell(30,5,'Petugas Verifikasi',0,'L');


		$pdf->Cell(90);
		$pdf->Cell(30,5,$this->uin['kota'].', '.$this->tanggal(date('d-m-Y')),0,'L');


		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(5);
		$pdf->Cell(30,5,'( ________________________ )',0,'L');

		$pdf->Cell(95);
		$pdf->MultiCell(55,5,'( '.$gdna.$gda.$this->diri['nama_lengkap'].$gba.$gbna.' )',0,'C');


		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Times','',10);
		$pdf->Cell(5);
		if(!is_null($this->catatan))
		{
		if(count($this->catatan)>0)
		{
					$pdf->Cell(30,5,'CATATAN :',0,'L');
					$pdf->SetFont('Times','I',10);
					$pdf->Ln();
		}

		
			foreach ($this->catatan as $datacat) {
				$this->catat=(array)$datacat->note;
				if(count($this->catat)>0)
				{
					$pdf->Ln();
					$pdf->Cell(5);
					$pdf->MultiCell(150,5,'* '.$this->catat[0],0,'L');		
				}
				
				
			}
		}
	
		##DATA DIRI

		$pdf->AddPage();

		
		$pdf->SetFont('Times','B',11);
		$pdf->Image(pg_unescape_bytea($this->uin['logo']),10,10,18,18,'JPEG');
		$pdf->Cell(20);
		$pdf->MultiCell(100,5,$this->uin['kementrian']);
		$pdf->Cell(20);
		$pdf->MultiCell(190,4,$this->uin['nama_unit']);
		$pdf->SetFont('Times','',10);
		$pdf->Cell(20);
		$pdf->MultiCell(100,5,$this->uin['tema'].' Tahun Akademik '.$this->uin['tahun_akademik']);
		$pdf->Cell(20);
		$pdf->SetFont('Times','I',9);
		$pdf->MultiCell(190,5,$this->uin['alamat'].' Telp. '.$this->uin['telp'].' email: '.$this->uin['email']);
		$pdf->Line(10, 30, 200, 30);
		
		

		$pdf->Ln();
		$pdf->SetFont('Times','',12);
		$pdf->Cell(185,5,'DATA DIRI PESERTA',0,0,'C');
		$pdf->Image(pg_unescape_bytea($this->diri['foto']),90,42,25,25,'JPEG');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Times','',12);
		$pdf->Cell(10);
		$pdf->Cell(40,6,'Nama',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		if(!empty($this->diri['gelar_belakang_na']))
		{
			$gbna=', '.$this->diri['gelar_belakang_na'];
		}
		else
		{
			$gbna='';
		};

		if(!empty($this->diri['gelar_belakang']))
		{
			$gba= ', '.$this->diri['gelar_belakang'];
		}
		else
		{
			$gba='';
		};

		if(!empty($this->diri['gelar_depan_na']))
		{
			$gdna=$this->diri['gelar_depan_na'].'. ';
		}
		else
		{
			$gdna='';
		};

		if(!empty($this->diri['gelar_depan']))
		{
			$gda=$this->diri['gelar_depan'].'. ';
		}
		else
		{
			$gda='';
		};
		


		$pdf->MultiCell(80,6,$gdna.$gda.$this->diri['nama_lengkap'].$gba.$gbna,0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,'Alamat',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->diri['alamat_lengkap'],0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,'Tempat Lahir',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->diri['tempat_lahir'],0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,'Tanggal Lahir',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->tanggal_hari(date('d-m-Y',strtotime($this->diri['tgl_lahir']))),0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,'Agama',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->diri['nama_agama'],0,'L');
/*
		$pdf->Cell(10);
		$pdf->Cell(40,6,'Tinggi Badan',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->diri['tinggi_badan'],0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,'Berat Badan',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->diri['berat_badan'],0,'L');
*/
		$pdf->Cell(10);
		$pdf->Cell(40,6,'Golongan Darah',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->diri['gol_darah'],0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,'Jenis Kelamin',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->diri['jenis_kelamin'],0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,'Telp',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->diri['telp'],0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,'Hp',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->diri['nohp'],0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,'Kode Pos',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->diri['kode_pos'],0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,'Email',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(60,6,$this->diri['email'],0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,'No KTP/PASSPORT',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->diri['no_ktp'],0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,'Warga Negara',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->diri['nama_negara'],0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,'Nama Ibu',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->diri['nama_lengkap_ibu'],0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,'Nama Ayah',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->diri['nama_lengkap_ayah'],0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,'Riwayat Penyakit',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->kes['riwayat_penyakit'],0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,'Kemampuan Berbeda',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->dif['kondisi_kesehatan'],0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,$this->nama_pend,0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->isi1,0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,$this->nama_sekolah,0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(70,6,$this->isi2,0,'L');

		$pdf->Cell(10);
		$pdf->Cell(40,6,$this->nilai,0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->MultiCell(40,6,$this->isi3,0,'L');
		

		$pdf->Output();
	}
	

	
}

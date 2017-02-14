<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package		PRAREGISTRASI
 * @creator     Adi Wirawan
 * @created     21/05/2014
*/
class praregistrasi extends CI_Controller {
	function __construct(){
        parent::__construct();    
        error_reporting(0);   
        $this->output99	= $this->s00_lib_output;   
		$this->load->library('lib_reg_fungsi');
		$this->lib_reg_fungsi->cek_awal_depan();		
    }
    function index(){
        $masa_isi=json_decode($this->lib_reg_fungsi->get_masa_isi(),true);
        $tgl_akses=json_decode($this->lib_reg_fungsi->get_masa_isi_value(),true);
        $tgl_akses_mulai=$tgl_akses['TGL_MULAIX'];
        $tgl_akses_akhir=$tgl_akses['TGL_AKHIRX'];
        if($masa_isi['allow_isi']=='1'){
            $sign_masa_isi='<span class="badge badge-success"><i class="icon-white icon-ok"></i></span>';
            $sign_masa_isi_label="Masa Pengisian";
            $status1=true;
        }else{
            $sign_masa_isi='<span class="badge badge-important"><i class="icon-white icon-remove"></i></span>';
            $sign_masa_isi_label="Bukan Masa Pengisian";
            $status1=false;
        } 
        //////////////////////
        $NISN=$this->lib_reg_fungsi->session_nisn();
        $NO_TEST=$this->lib_reg_fungsi->session_no_test();
        ///////////////////////
        ///////////////////////
        ///////////////////////
        $data_mahasiswa = json_decode($this->lib_reg_fungsi->get_data_siswa($NISN),true);
        //////////////
        if($data_mahasiswa['VERIFIED']!='1'){
           $sign_boleh_isi='<span class="badge badge-success"><i class="icon-white icon-ok"></i></span>';
           $sign_boleh_isi_label='Belum Diverifikasi';
           $status2=true;
        }else{
            $sign_boleh_isi='<span class="badge badge-important"><i class="icon-white icon-remove"></i></span>';
            $sign_boleh_isi_label='Sudah Diverifikasi';
            $status2=false;
        }
        //////////////////////////////////
        $NISN=$this->lib_reg_fungsi->session_nisn();
        $cek=$this->lib_reg_fungsi->cek_kelengkapan($this->lib_reg_fungsi->get_data_siswa($NO_TEST));
		$cek2=json_decode($this->lib_reg_fungsi->get_data_siswa($NO_TEST),true);
		echo "<!-- ";
		$url="http://service2.uin-suka.ac.id/servsibayar/index.php/data/d_tagihan_cmb/tagihan_cmb_view/format/json";
		$array = array(
				'no_pmb'=>$NO_TEST
			);
		$tagihan=json_decode($this->lib_reg_fungsi->api_bayar($url,$array,get),true);
		////////////////
		print_r($array);
		$TOTAL_BIAYA=$this->lib_reg_fungsi->rupiah($tagihan['TOTAL_BIAYA']);
		$NM_JALUR=$tagihan['NM_JALUR'];
		$TGL_STARTED=$tagihan['TGL_STARTED'];
		$TGL_EXPIRED=$tagihan['TGL_EXPIRED'];
		//echo "total $total_biaya";
		//print_r($cek2);
		echo "-->";
        if($status1==false or $status2==false){
            if(empty($cek)){
                $status_cek="<div class='bs-callout bs-callout-success'>
                Terima kasih data yang anda masukkan sudah lengkap. Untuk selanjutnya silakan melihat pengumuman tarif & tata cara pembayaran 
                biaya pendidikan di laman dan tanggal yang sudah ditentukan dalam pengumuman.
                </div>";
            }else{
				$data_ok=false;//syarat menampilkan persyaratan 
				if($cek2['NISN']){
				$status_cek="<div class='bs-callout bs-callout-success'>
                Proses pengisian Data Profil sudah selesai. Mohon menunggu pengumuman di laman admisi.uin-suka.ac.id.
                </div>";
				$data_ok=true;
				}else{
                $status_cek="<div class='bs-callout bs-callout-warning'>
                Proses pengisian Data Profil dihentikan. Mohon menunggu pengumuman di laman admisi.uin-suka.ac.id.
                </div>";
				}
				if(count($tagihan) && $TOTAL_BIAYA){
					echo "<!-- ";
					$status_cek=$status_cek."<div class='bs-callout bs-callout-success'>Total Biaya yang bisa anda bayarkan untuk biaya registrasi ke BANK adalah <b>Rp. $TOTAL_BIAYA</b>. Silakan melakukan pembayaran antara tanggal <b>$TGL_STARTED</b> s/d <b>$TGL_EXPIRED</b></div>";
					echo "-->";
				}
            }
        }
        /////////////////////////////////
        $btn_stsm   = '<span class="badge badge-success"><i class="icon-white icon-ok"></i></span>';
        if($status1==true && $status2==true){
            $stsKetBs = "<p>Syarat untuk bisa melakukan pengisian Data Profil sudah terpenuhi. Untuk selanjutnya, silakan melanjutkan dengan melakukan klik pada tombol <b>isi Data Profil</b> di bawah ini</p>";
                $btnKetBs = "isi Data Profil";
                $stsBsAlur= "success";
                $tombol="<a style='color:#FFFFFF;margin-top:5px;' type='button' class='btn btn-uin btn-small btn-inverse' href='".site_url("praregistrasi/data_keluarga")."'>".$btnKetBs."</a>";
                $stsAlurSyarat='done';
                $stsAlurPengisian='done';
        }else{
            $stsBsAlur="warning";
            $stsKetBs="<p>Mohon maaf Anda belum dapat melakukan pengisian Data Profil karena ada syarat yang belum terpenuhi:</p>";
             $stsAlurSyarat='done';
            $stsAlurPengisian='todo';
        }
		
        $out_ctn    = $status_cek."<div class='bs-callout bs-callout-".$stsBsAlur."'>              
                                        ".$stsKetBs."                                       
                                        ".$tombol."
                                    </div>";
		if($data_ok==true){
			 $out_ctn    = $status_cek;
		}else{
			 $out_ctn    = $status_cek."<div class='bs-callout bs-callout-".$stsBsAlur."'>              
                                        ".$stsKetBs."                                       
                                        ".$tombol."
                                    </div>";
		}
        $out_ctn_tbl    = '
                    <div id="border-atas">
                        <h2>Syarat Pengisian Data Profil</h2>
                        <table class="table table-bordered table-hover">
                            <tr>                
                                <th width="30px"><center>No</center></th>
                                <th><center>Syarat</center></th>
                                <th width="180px"><center>Isi</center></th>
                                <!--<th width="100px"><center>Hubungi</center></th>-->
                                <th width="50px"><center>Status</center></th>
                            </tr>
                            
                            <tr>                
                                <td class="tdteng">1.</td>
                                <td>Status Calon = Diterima</td>
                                <td class="">Diterima</td>
                                <!-- <td class="">Dewan Yudisium</td> -->
                                <td ><center>'.$btn_stsm.'</center></td>
                            </tr>   
                            <tr>                
                                <td class="tdteng">2.</td>
                                <td>Masa Pengisian<br/>'.$tgl_akses_mulai.' s/d '.$tgl_akses_akhir.'</td>
                                <td class="">'.$sign_masa_isi_label.'</td>
                                <!-- <td class="">PTIPD</td> -->
                                <td ><center>'.$sign_masa_isi.'</center></td>
                            </tr>    
                            <tr>                
                                <td class="tdteng">3.</td>
                                <td>Status Verifikasi = Belum Diverifikasi</td>
                                <td class="">'.$sign_boleh_isi_label.'</td>
                                <!-- <td class="">PTIPD</td> -->
                                <td ><center>'.$sign_boleh_isi.'</center></td>
                            </tr>                        
                            
                        </table>
                        
                    </div>
                    <table class="table table-nama" style="border: none; margin:1% 0 3% 0;">
                    <tbody>
                        <tr><td colspan="3"><b>Keterangan</b></td></tr>                 
                        <tr><td width="50px"><span style="cursor:pointer;" class="badge badge-success"><i class="icon-white icon-ok"></i></span></td><td class="tdlebar">:</td><td> Syarat pengisian Data Profil <b>SUDAH</b> terpenuhi</td></tr>
                        <tr><td><span style="cursor:pointer;" class="badge badge-important"><i class="icon-white icon-remove"></i></span></td><td class="tdlebar">:</td><td><p> Syarat pengisian Data Profil <b>BELUM</b> terpenuhi</p></td></tr>
                    </tbody>                        
                    </table>
                ';
        $outAlur = '<h2>Alur Pengisian Data Profil</h2>
                                <ol class="progtrckr" data-progtrckr-steps="2">
                                    <li class="progtrckr-'.$stsAlurSyarat.' number1">Cek syarat</li><!--
                                    --><li class="progtrckr-'.$stsAlurPengisian.' number2">Pengisian Data Profil</li>
                                </ol>
                ';
        ///DISPEN
        $dispen=json_decode($this->lib_reg_fungsi->get_dispen($NO_TEST),true);
        $DISPEN=$dispen['DISPEN_BOLEH_AKSES'];
        if($DISPEN=='TRUE'){
             $outAlur_dispen = '<h2>Alur Pengisian Data Profil</h2>
                                <ol class="progtrckr" data-progtrckr-steps="2">
                                    <li class="progtrckr-'.$stsAlurSyarat.' number1">Cek syarat</li><!--
                                    --><li class="progtrckr-done number2">Pengisian Data Profil Dispen</li>
                                </ol>
                ';
            ///////////
             $stsKetBs = "<p>Anda dalam masa pengisian Data Profil, silahkan segera selesaikan pengisian data anda. Setelah data terisi mohon secara aktif melakukan pengecekan di laman <a href='http://admisi.uin-suka.ac.id'>http://admisi.uin-suka.ac.id</a> untuk mendapatkan update berita terbaru.</p>";
                $btnKetBs = "isi Data Profil";
                $stsBsAlur= "success";
                $tombol="<a style='color:#FFFFFF;margin-top:5px;' type='button' class='btn btn-uin btn-small btn-inverse' href='".site_url("praregistrasi/data_keluarga")."'>".$btnKetBs."</a>";
            ///////////
            $out_ctn    ="<div class='bs-callout bs-callout-".$stsBsAlur."'>              
                                        ".$stsKetBs."                                       
                                        ".$tombol."
                                    </div>";
            $data['isi']=$outAlur_dispen.$out_ctn;
        }else{
            $data['isi']= $outAlur.$out_ctn.$out_ctn_tbl;
        }
        //$this->output99->output_display('praregistrasi/v_praregistrasi', $data);   
        //$this->output99->output_display('02_cmahasiswa/s02_vw_error', $data); 
        $data['content']='praregistrasi/v_praregistrasi';
        $this->load->view('s00_vw_all', $data);
    }
           
    
}
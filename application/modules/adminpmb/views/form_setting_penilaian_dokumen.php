<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
	<style>
	.day{
		font-size:14px;
	}
	</style>
   <link href="http://static.uin-suka.ac.id/plugins/datepicker/css/datepicker.css" rel="stylesheet">

    <script src="http://static.uin-suka.ac.id/plugins/datepicker/js/bootstrap-datepicker.js"></script>
	
<div>
<?php
		$tpa=array();
		$bing=array();
		$arab=array();
		$indo=array();
		$akreditasi=array();
		$ipk=array();
		$karya=array();
		$kp=array();
		$prop=array();
		$motivasi=array();
		if(!is_null($normal_dokumen))
		{
			$num=0;
			foreach ($normal_dokumen as $normal) {
				switch ($normal->jenis_sertifikat) {
					case 'TPA':
						array_push($tpa, $normal);
						break;
					case 'BING':
						array_push($bing, $normal);
						break;
					case 'ARAB':
						array_push($arab, $normal);
						break;
					case 'INDO':
						array_push($indo, $normal);
						break;
					case 'AKREDITASI':
						array_push($akreditasi, $normal);
						break;
					case 'KARYA_TULIS':
						array_push($karya, $normal);
						break;
					case 'KEPEMIMPINAN':
						array_push($kp, $normal);
						break;
					case 'DISERTASI':
						array_push($prop, $normal);
						break;
					case 'IPK':
						array_push($ipk, $normal);
						break;
					case 'MOTIVASI':
						array_push($motivasi, $normal);
						break;
				}
			}
		}
		?>
<h3 style="margin-bottom:10px;">Setting Penilaian Dokumen</h3>
<br>
<br>
<?php
		
		if(count($tpa)>0)
		{
			foreach ($tpa as $title_tpa);
			echo "<strong>".strtoupper($title_tpa->nama_sertifikat)."</strong>";
			?>
	<form method="POST" id="TPA">
	<table class="table table-bordered table-hover">
		<thead>
			
				<td align="center">
					No
				</td>
				<td align="center">
					Nama Dokumen
				</td>
				<td align="center">
					Bobot Nilai & Normalisasi
				</td>
			
			
		</thead>
		<?php
			$num1=0;
				echo "<tbody>";
				echo "<tr>";
				echo "<td>";
				echo $num1+=1;
				echo "</td>";
				echo "<td>";
				echo "BOBOT";
				echo "</td>";
				echo "<td>";
				echo "<input type='text' name='bobot' class='form-control input-md' value='".$title_tpa->bobot."'>";
				echo "</td>";
				echo "</tr>";
			foreach ($tpa as $data_tpa) {
			
				
				echo "<tr>";
				echo "<td>";
				echo $num1+=1;
				echo "</td>";
				echo "<td>";
				echo $data_tpa->id_sertifikat;
				echo "</td>";
				echo "<td>";
				echo "<input type='text' name='isi[]' class='form-control input-md' value='".$data_tpa->normalisasi."'>";
				echo "<input type='hidden' name='kolom[]' value='".$data_tpa->jenis_sertifikat."'>";
				echo "<input type='hidden' name='kolom2[]' value='".$data_tpa->id_sertifikat."'>";
				echo "</td>";
				
				echo "</tr>";
				
			}
			echo "</tbody>";
		}
		?>
		</table>
		</form>
		<button class='btn btn-inverse btn-uin btn-small' type='button' value="TPA" onclick="simpan_data(this.value)"> Simpan</button>
		<br>
		<br>
		<br>
		<?php
		if(count($bing)>0)
		{
			$num2=0;
			foreach ($bing as $title_bing);
			echo "<strong>".strtoupper($title_bing->nama_sertifikat)."</strong>";
			?>
		<form method="POST" id="BING">
		<table class="table table-bordered table-hover">
		<thead>
			
				<td align="center">
					No
				</td>
				<td align="center">
					Nama Dokumen
				</td>
				<td align="center">
					Bobot Nilai & Normalisasi
				</td>
			
		</thead>
		<?php
			
				echo "<tbody>";
				echo "<tr>";
				echo "<td>";
				echo $num2+=1;
				echo "</td>";
				echo "<td>";
				echo "BOBOT";
				echo "</td>";
				echo "<td>";
				echo "<input type='text' name='bobot' class='form-control input-md' value='".$title_bing->bobot."'>";
				echo "</td>";
				echo "</tr>";
			foreach ($bing as $data_bing) {
			
				
				echo "<tr>";
				echo "<td>";
				echo $num2+=1;
				echo "</td>";
				echo "<td>";
				echo $data_bing->id_sertifikat;
				echo "</td>";
				echo "<td>";
				echo "<input type='text' name='isi[]' class='form-control input-md' value='".$data_bing->normalisasi."'>";
				echo "<input type='hidden' name='kolom[]' value='".$data_bing->jenis_sertifikat."'>";
				echo "<input type='hidden' name='kolom2[]' value='".$data_bing->id_sertifikat."'>";
				echo "</td>";
				echo "</tr>";
				
			}
			echo "</tbody>";
		}
		?>
		</table>
		</form>
		<button class='btn btn-inverse btn-uin btn-small' type='button' value="BING" onclick="simpan_data(this.value)"> Simpan</button>
		
		<br>
		<br>
		<br>
		<?php
		if(count($arab)>0)
		{
			$num3=0;
			foreach ($arab as $title_arab);
			echo "<strong>".strtoupper($title_arab->nama_sertifikat)."</strong>";
			?>
			<form method="POST" id="ARAB">
		<table class="table table-bordered table-hover">
		<thead>
			
				<td align="center">
					No
				</td>
				<td align="center">
					Nama Dokumen
				</td>
				<td align="center">
					Bobot Nilai & Normalisasi
				</td>
			
		</thead>
		<?php
				echo "<tbody>";
				echo "<tr>";
				echo "<td>";
				echo $num3+=1;
				echo "</td>";
				echo "<td>";
				echo "BOBOT";
				echo "</td>";
				echo "<td>";
				echo "<input type='text' name='bobot' class='form-control input-md' value='".$title_arab->bobot."'>";
				echo "</td>";
				echo "</tr>";
			foreach ($arab as $data_arab) {
			
				
				echo "<tr>";
				echo "<td>";
				echo $num3+=1;
				echo "</td>";
				echo "<td>";
				echo $data_arab->id_sertifikat;
				echo "</td>";
				echo "<td>";
				echo "<input type='text' name='isi[]' class='form-control input-md' value='".$data_arab->normalisasi."'>";
				echo "<input type='hidden' name='kolom[]' value='".$data_arab->jenis_sertifikat."'>";
				echo "<input type='hidden' name='kolom2[]' value='".$data_arab->id_sertifikat."'>";
				echo "</td>";
				echo "</tr>";
				
			}
			echo "</tbody>";
		}
		?>
		</table>
		</form>
		<button class='btn btn-inverse btn-uin btn-small' type='button' value="ARAB" onclick="simpan_data(this.value)"> Simpan</button>
		<br>
		<br>
		<br>
		<?php
		if(count($indo)>0)
		{
			$num4=0;
				foreach ($indo as $title_indo);
				echo "<strong>".strtoupper($title_indo->nama_sertifikat)."</strong>";
			?>
		<form method="POST" id="INDO">
		<table class="table table-bordered table-hover">
		<thead>
			
				<td align="center">
					No
				</td>
				<td align="center">
					Nama Dokumen
				</td>
				<td align="center">
					Bobot Nilai & Normalisasi
				</td>
				
		</thead>
		<?php
				echo "<tbody>";
				echo "<tr>";
				echo "<td>";
				echo $num4+=1;
				echo "</td>";
				echo "<td>";
				echo "BOBOT";
				echo "</td>";
				echo "<td>";
				echo "<input type='text' name='bobot' class='form-control input-md' value='".$title_indo->bobot."'>";
				echo "</td>";
				echo "</tr>";
			foreach ($indo as $data_indo) {
			
				
				echo "<tr>";
				echo "<td>";
				echo $num4+=1;
				echo "</td>";
				echo "<td>";
				echo $data_indo->id_sertifikat;
				echo "</td>";
				echo "<td>";
				echo "<input type='text' name='isi[]' class='form-control input-md' value='".$data_indo->normalisasi."'>";
				echo "<input type='hidden' name='kolom[]' value='".$data_indo->jenis_sertifikat."'>";
				echo "<input type='hidden' name='kolom2[]' value='".$data_indo->id_sertifikat."'>";
				echo "</td>";
				
				echo "</tr>";
				
			}
			echo "</tbody>";
		}
		?>

		</table>
		</form>
		<button class='btn btn-inverse btn-uin btn-small' value="INDO" type='button' onclick="simpan_data(this.value)" > Simpan</button>
		<br>
		<br>
		<br>
		<?php
		if(count($karya)>0)
		{
			$num5=0;
			foreach ($karya as $title_karya);
				echo "<strong>".strtoupper($title_karya->nama_sertifikat)."</strong>";
			?>
		<form method="POST" id="KARYA">
		<table class="table table-bordered table-hover">
		<thead>
			
				<td align="center">
					No
				</td>
				<td align="center">
					Nama Dokumen
				</td>
				<td align="center">
					Bobot Nilai
				</td>
			
		</thead>
		<?php
				echo "<tbody>";
				echo "<tr>";
				echo "<td>";
				echo $num5+=1;
				echo "</td>";
				echo "<td>";
				echo "BOBOT";
				echo "</td>";
				echo "<td>";
				echo "<input type='text' name='bobot' class='form-control input-md' value='".$title_karya->bobot."'>";
				echo "</td>";
				echo "</tr>";
			foreach ($karya as $data_karya) {
			
				
				echo "<tr>";
				echo "<td>";
				echo $num5+=1;
				echo "</td>";
				echo "<td>";
				echo "Normalisasi";
				echo "</td>";
				echo "<td align='center'>";
				echo "<input type='hidden' name='kolom[]' value='".$data_karya->jenis_sertifikat."'>";
				echo "<input type='hidden' name='kolom2[]' value='".$data_karya->id_sertifikat."'>";
				echo "<input type='text' name='isi[]' class='form-control input-md' value='".$data_karya->normalisasi."'>";
				
				echo "</td>";
				
				echo "</tr>";
				
			}
			echo "</tbody>";
		}
		?>
		</table>
		</form>
		<button class='btn btn-inverse btn-uin btn-small' type='button' value="KARYA" onclick="simpan_data(this.value)"> Simpan</button>
		<br>
		<br>
		<br>
		<?php
		if(count($prop)>0)
			{
				$num6=0;
				foreach ($prop as $title_prop);
				echo "<strong>".strtoupper($title_prop->nama_sertifikat)."</strong>";
			?>
			<form method="POST" id="PROP">
		<table class="table table-bordered table-hover">
		<thead>
			
				<td align="center">
					No
				</td>
				<td align="center">
					Nama Dokumen
				</td>
				<td align="center">
					Bobot Nilai
				</td>
				
		</thead>

<?php		
				echo "<tbody>";
				echo "<tr>";
				echo "<td>";
				echo $num6+=1;
				echo "</td>";
				echo "<td>";
				echo "BOBOT";
				echo "</td>";
				echo "<td>";
				echo "<input type='text' name='bobot' class='form-control input-md' value='".$title_prop->bobot."'>";

				echo "</td>";
				echo "</tr>";
			foreach ($prop as $data_prop) {
			
				
				echo "<tr>";
				echo "<td>";
				echo $num6+=1;
				echo "</td>";
				echo "<td>";
				echo "Normalisasi";
				echo "</td>";
				echo "<td align='center'>";
				echo "<input type='hidden' name='kolom[]' value='".$data_prop->jenis_sertifikat."'>";
				echo "<input type='hidden' name='kolom2[]' value='".$data_prop->id_sertifikat."'>";
				echo "<input type='text' name='isi[]' class='form-control input-md' value='".$data_prop->normalisasi."'>";
				
				echo "</td>";
				
				echo "</tr>";
				
			}
			echo "</tbody>";
		}
		?>

		</table>
		</form>
		<button class='btn btn-inverse btn-uin btn-small' value="PROP" type='button' onclick="simpan_data(this.value)" > Simpan</button>
		<br>
		<br>
		<br>

		<?php
		if(count($ipk)>0)
		{
			$numipk=0;
			foreach ($ipk as $title_ipk);
				echo "<strong>".strtoupper($title_ipk->nama_sertifikat)."</strong>";
			?>
		<form method="POST" id="IPK">
		<table class="table table-bordered table-hover">
		<thead>
			
				<td align="center">
					No
				</td>
				<td align="center">
					Nama Dokumen
				</td>
				<td align="center">
					Bobot Nilai
				</td>
			
		</thead>
		<?php
				echo "<tbody>";
				echo "<tr>";
				echo "<td>";
				echo $numipk+=1;
				echo "</td>";
				echo "<td>";
				echo "BOBOT";
				echo "</td>";
				echo "<td>";
				echo "<input type='text' name='bobot' class='form-control input-md' value='".$title_ipk->bobot."'>";
				echo "</td>";
				echo "</tr>";
			foreach ($ipk as $data_ipk) {
			
				
				echo "<tr>";
				echo "<td>";
				echo $numipk+=1;
				echo "</td>";
				echo "<td>";
				echo "Normalisasi";
				echo "</td>";
				echo "<td align='center'>";
				echo "<input type='hidden' name='kolom2[]' value='".$data_ipk->id_sertifikat."'>";
				echo "<input type='text' name='isi[]' class='form-control input-md' value='".$data_ipk->normalisasi."'>";
				
				echo "<input type='hidden' name='kolom[]' value='".$data_ipk->jenis_sertifikat."'>";
				echo "</td>";
				
				echo "</tr>";
				
			}
			echo "</tbody>";
		}
		?>

		</table>
		</form>
		<button class='btn btn-inverse btn-uin btn-small' type='button' value="IPK" onclick="simpan_data(this.value)"> Simpan</button>
		<br>
		<br>
		<br>

<?php
		if(count($motivasi)>0)
		{
			$nummot=0;
			foreach ($motivasi as $title_motif);
				echo "<strong>".strtoupper($title_motif->nama_sertifikat)."</strong>";
			?>
		<form method="POST" id="MOTIVASI">
		<table class="table table-bordered table-hover">
		<thead>
			
				<td align="center">
					No
				</td>
				<td align="center">
					Nama Dokumen
				</td>
				<td align="center">
					Bobot Nilai
				</td>
			
		</thead>
		<?php
				echo "<tbody>";
				echo "<tr>";
				echo "<td>";
				echo $nummot+=1;
				echo "</td>";
				echo "<td>";
				echo "BOBOT";
				echo "</td>";
				echo "<td>";
				echo "<input type='text' name='bobot' class='form-control input-md' value='".$title_motif->bobot."'>";
				echo "</td>";
				echo "</tr>";
			foreach ($motivasi as $data_mot) {
			
				
				echo "<tr>";
				echo "<td>";
				echo $nummot+=1;
				echo "</td>";
				echo "<td>";
				echo "Normalisasi";
				echo "</td>";
				echo "<td align='center'>";
				echo "<input type='hidden' name='kolom2[]' value='".$data_mot->id_sertifikat."'>";
				echo "<input type='text' name='isi[]' class='form-control input-md' value='".$data_mot->normalisasi."'>";
				
				echo "<input type='hidden' name='kolom[]' value='".$data_mot->jenis_sertifikat."'>";
				echo "</td>";
				
				echo "</tr>";
				
			}
			echo "</tbody>";
		}
		?>

		</table>
		</form>
		<button class='btn btn-inverse btn-uin btn-small' type='button' value="MOTIVASI" onclick="simpan_data(this.value)"> Simpan</button>
		<br>
		<br>
		<br>


		<?php
		if(count($kp)>0)
		{
			$num7=0;
			foreach ($kp as $title_kp);
				echo "<strong>".strtoupper($title_kp->nama_sertifikat)."</strong>";
			?>
		<form method="POST" id="KP">
		<table class="table table-bordered table-hover">
		<thead>
			
				<td align="center">
					No
				</td>
				<td align="center">
					Nama Dokumen
				</td>
				<td align="center">
					Bobot Nilai
				</td>
			
		</thead>
		<?php
				echo "<tbody>";
				echo "<tr>";
				echo "<td>";
				echo $num7+=1;
				echo "</td>";
				echo "<td>";
				echo "BOBOT";
				echo "</td>";
				echo "<td>";
				echo "<input type='text' name='bobot' class='form-control input-md' value='".$title_kp->bobot."'>";
				echo "</td>";
				echo "</tr>";
			foreach ($kp as $data_kp) {
			
				
				echo "<tr>";
				echo "<td>";
				echo $num7+=1;
				echo "</td>";
				echo "<td>";
				echo "Normalisasi";
				echo "</td>";
				echo "<td align='center'>";
				echo "<input type='hidden' name='kolom2[]' value='".$data_kp->id_sertifikat."'>";
				echo "<input type='text' name='isi[]' class='form-control input-md' value='".$data_kp->normalisasi."'>";
				
				echo "<input type='hidden' name='kolom[]' value='".$data_kp->jenis_sertifikat."'>";
				echo "</td>";
				
				echo "</tr>";
				
			}
			echo "</tbody>";
		}
		?>

		</table>
		</form>
		<button class='btn btn-inverse btn-uin btn-small' type='button' value="KP" onclick="simpan_data(this.value)"> Simpan</button>
		<br>
		<br>
		<br>
		<?php
		if(count($akreditasi)>0)
		{
			$num8=0;
			foreach ($akreditasi as $title_akre);
				echo "<strong>".strtoupper($title_akre->nama_sertifikat)."</strong>";
				
			?>
		<form method="POST" id="AKRE">
		<table class="table table-bordered table-hover">
		<thead>
			
				<td align="center">
					No
				</td>
				<td align="center">
					Nama Dokumen
				</td>
				<td align="center">
					Bobot Nilai
				</td>
			
		</thead>
		<?php
				echo "<tbody>";
				echo "<tr>";
				echo "<td>";
				echo $num8+=1;
				echo "</td>";	
				echo "<td>";
				echo "BOBOT";
				echo "</td>";
				echo "<td>";
				echo "<input type='text' name='bobot' class='form-control input-md' value='".$title_akre->bobot."'>";
				echo "</td>";
				echo "</tr>";
			foreach ($akreditasi as $data_akre) {
			
				
				echo "<tr>";
				echo "<td>";
				echo $num8+=1;
				echo "</td>";
				echo "<td>";
				echo $data_akre->id_sertifikat;
				echo "</td>";
				echo "<td align='center'>";
				echo "<input type='text' name='isi[]' class='form-control input-md' value='".$data_akre->normalisasi."'>";
				echo "<input type='hidden' name='kolom[]' value='".$data_akre->jenis_sertifikat."'>";
				echo "<input type='hidden' name='kolom2[]' value='".$data_akre->id_sertifikat."'>";
				echo "</td>";
			
				echo "</tr>";
				
			}
			echo "</tbody>";
		}
	?>
		
		</table>
			</form>
			<button class='btn btn-inverse btn-uin btn-small' type='button' value="AKRE" onclick='simpan_data(this.value)' > Simpan</button>
	
	
</div>
<div id="table-doc">
</div>
<script type="text/javascript">
function simpan_data (form_apa) {
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/simpan_setting_nilai_dokumen'); ?>",
		type: "POST",
		data: $('#'+form_apa).serialize(),
		success: function(hasil)
		{
			alert(hasil);
		}
	});
	
}
</script>
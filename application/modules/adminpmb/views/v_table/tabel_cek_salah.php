
<div class='bs-callout bs-callout-info'>Warna Merah Pada Tabel Menunjukkan Kesalahan Pengisian Data</div>
<h3>DATA DIRI</h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				NAMA LENGKAP
			</td>
			<td>
				FOTO
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		if(!is_null($data_diri))
		{
			foreach ($data_diri as $d);
			echo "<tr>";
			echo "<td>";
			echo $d->nama_lengkap;
			echo "</td>";
			echo "<td>";
			echo "<img src='".pg_unescape_bytea($d->foto)."' width='40px'>";
			echo "<div class='reg-info'>JIKA TERDAPAT EROR NOT JPEG, FORMAT FOTO SALAH</div>";
			echo "</td>";
			echo "</tr>";
		}
		else
		{
			echo "<tr>";
			echo "<td colspan='2' style='background-color:red;'>";
			echo "BELUM ISI DATA DIRI";
			echo "</td>";
			echo "</tr>";	
		}
		?>
	</tbody>
</table>

<h3>JALUR</h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				NAMA JALUR
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		if(!is_null($jalur))
		{
			foreach ($jalur as $j);
			echo "<tr>";
			echo "<td>";
			echo $j->jalur_masuk." Gelombang ".$j->gelombang." Tahun ".$j->tahun;
			echo "</td>";
			echo "</tr>";
		}
		else
		{
			echo "<tr>";
			echo "<td style='background-color:red;'>";
			echo "JALUR TIDAK AKTIF";
			echo "</td>";
			echo "</tr>";	
		}
		?>
	</tbody>
</table>

<h3>DATA PENDIDIKAN KHUSUS JALUR S1</h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				PENDIDIKAN TERAKHIR
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		if(!is_null($data_pendidikan))
		{
			foreach ($data_pendidikan as $dp);
			echo "<tr>";
			
			if($dp->jml>0)
			{
			echo "<td>";
			echo "DATA PENDIDIKAN TERISI";
			echo "</td>";
			}
			else
			{
				echo "<td style='background-color:red;'>";
				echo "DATA PENDIDIKAN BELUM TERISI";
				echo "</td>";
			}
			
			echo "</tr>";
		}
		else
		{
			echo "<tr>";
			echo "<td style='background-color:red;'>";
			echo "DATA PENDIDIKAN TIDAK TERISI";
			echo "</td>";
			echo "</tr>";	
		}
		?>
	</tbody>
</table>
<h3>JADWAL</h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				ISI JADWAL
			</td>
			<td>
				STATUS
			</td>
		</tr>
	</thead>
		<tbody>
		<?php
		if(!is_null($jadwal))
		{
			foreach ($jadwal as $jd);
			echo "<tr>";
			echo "<td>";
			echo "SUDAH MEMILIH JADWAL";
			echo "</td>";
			if($jd->status=='0')
			{
				echo "<td style='background-color:red;'>";
				echo "JADWAL TIDAK AKTIF";
				echo "</td>";
			}
			else
			{
				echo "<td>";
				echo "JADWAL AKTIF";
				echo "</td>";
			}
			
			echo "</tr>";
		}
		else
		{
			echo "<tr>";
			echo "<td colspan='2' style='background-color:red;'>";
			echo "BELIM MEIMILIH JADWAL";
			echo "</td>";
			echo "</tr>";	
		}
		?>
	</tbody>
</table>
<h3>PILIHAN JURUSAN</h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				DATA JURUSAN
			</td>
		</tr>
	</thead>
		<tbody>
		<?php
		if(!is_null($pilprod))
		{
			foreach ($pilprod as $pp);
			echo "<tr>";
			
			if($pp->jml>0)
			{
			echo "<td>";
			echo "SUDAH MEMILIH JURUSAN";
			echo "</td>";
			}
			else
			{
				echo "<td style='background-color:red;'>";
				echo "BELUM MEMILIH JURUSAN ";
				echo "</td>";
			}
			
			echo "</tr>";
		}
		else
		{
			echo "<tr>";
			echo "<td style='background-color:red;'>";
			echo "PILIHAN JURUSAN TIDAK TERISI";
			echo "</td>";
			echo "</tr>";	
		}
		?>
	</tbody>
</table>
<h3>KESEHATAN</h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				DISABILITAS
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		if(!is_null($kesehatan))
		{
			foreach ($kesehatan as $kes);
			echo "<tr>";
			
			if($kes->normal>0)
			{
				echo "<td style='background-color:red;'>";
				echo "PENYANDANG DIFABLE";
				echo "</td>";
			}
			else
			{
				echo "<td>";
				echo "NORMAL";
				echo "</td>";
			}
			
			echo "</tr>";
		}
		else
		{
			echo "<tr>";
			echo "<td>";
			echo "NORMAL";
			echo "</td>";
			echo "</tr>";	
		}
		?>
	</tbody>
</table>
<h3>NOMOR PESERTA</h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				NOMOR
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		
		if(!is_null($nomor))
		{
			foreach ($nomor as $n);
			echo "<tr>";
				echo "<td>";
				echo "NOMOR TERSEDIA";
				echo "</td>";
			echo "</tr>";
			
		}
		else
		{
			echo "<tr>";
			echo "<td style='background-color:red;'>";
			echo "NOMOR TIDAK TERSEDIA";
			echo "</td>";
			echo "</tr>";	
		}
		?>
	</tbody>
</table>
<br>
<button class="btn btn-uin btn-inverse" type="button" onclick="allow_login()">ULANG ISI DATA</button>
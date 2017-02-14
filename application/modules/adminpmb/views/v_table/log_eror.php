<style>
  .search-table{table-layout: fixed;}

.search-table-outter { overflow-x: scroll;margin-bottom: 20px;}
th, td {}
  #tab {
  width:1450px;margin-bottom: 20px;
}
</style>
<h3>REKAP PINDAH RUANG/NOMOR</h3>
<div class="search-table-outter wrapper">
<table class="table table-bordered search-table inner" id="tab">
		<thead>
			<th>
				NOMOR PENDAFTAR
			</th>
			<th>
				NAMA
			</th>
			<th>
				JALUR
			</th>
			<th>
				JADWAL
			</th>
			<th>
				NOMOR TERBARU
			</th>
			<th>
				NOMOR LAMA
			</th>
			<th>
				KETERANGAN
			</th>
		</thead>
		<tbody>
			<?php
			if(!is_null($mhs))
			{
				
				foreach ($mhs as $m) {
					echo "<tr>";
					echo "<td>";
						echo $m->nomor_pendaftar;
					echo "</td>";
					echo "<td>";
						echo $m->nama_lengkap;
					echo "</td>";
					echo "<td>";
						echo $m->jalur_masuk." Gelombang ".$m->gelombang." Tahun ".$m->tahun;
					echo "</td>";
					echo "<td>";
						echo tanggal_indonesia($m->tanggal);
					echo "</td>";
					echo "<td>";
						echo $m->nomor_peserta;
					echo "</td>";
					echo "<td>";	
						echo $m->nomor_peserta_old;
					echo "</td>";
					echo "<td>";
						echo $m->keterangan;
					echo "</td>";
					echo "</tr>";
				}
			}

			?>
		</tbody>
	</table>
	</div>
  <a name="fokus"></a>
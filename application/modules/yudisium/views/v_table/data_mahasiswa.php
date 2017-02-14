<div id="msg"></div>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				NOMOR PMB
			</td>
			<td>
				NAMA
			</td>
			<td>
				PROGRAM STUDI
			</td>
			<td>
				DITERIMA
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		if(!is_null($mhs))
		{
			foreach ($mhs as $m) {
				echo "<tr>";
				echo "<td>";
				echo $m->nomor_peserta;
				echo "</td>";
				echo "<td>";
				echo $m->nama_lengkap;
				echo "</td>";
				echo "<td>";
				if(!is_null($prodi))
				{
					foreach ($prodi as $p) {
						if($m->nomor_pendaftar==$p->nomor_pendaftar)
						{
							echo "Pilihan ".$p->pilihan." : ".$p->nama_prodi;
							echo "  <input type='radio' value='".$p->id_prodi."' pilihan='".$p->pilihan."' kelas='".$p->id_kelas."' id='prodi".$p->id_prodi."' name='prodi' onchange='pilih_prodi(this)'>"."<hr>";
						}
					}
				}
				echo "</td>";
				echo "<td>";
				echo "<button class='btn btn-small' type='button' value='".$m->nomor_pendaftar."' onclick='simpan_yudisium(this)'>SIMPAN</option>";
				echo "</td>";
				echo "</tr>";
			}
		}

		?>
	</tbody>
</table>
<script type="text/javascript">
var prodi;
var kelas;
var pilihan;

	function simpan_yudisium(sy) {
		var nomor=sy.value;
		$.ajax({
			url: "<?php echo base_url('yudisium/yudisium_c/simpan_yudisium') ?>",
			type: "POST",
			data: "nomor_pendaftar="+nomor+"&id_prodi="+prodi+"&kelas="+kelas+"&pilihan="+pilihan,
			success: function(sc)
			{
				$('#msg').html(sc);
			}
		});
	}

function pilih_prodi(pp)
{
	if($('#'+pp.id).prop('value'))
	{
		prodi=$('#'+pp.id).val();
		kelas=$('#'+pp.id).attr('kelas');
		pilihan=$('#'+pp.id).attr('pilihan');
	}
	else
	{
		prodi=null;
		kelas=null;
		pilihan=null;
	}
}
</script>
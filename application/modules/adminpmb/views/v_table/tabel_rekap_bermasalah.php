
<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				NO
			</td>
			<td>
				NOMOR PESERTA
			</td>
			<td>
				NAMA
			</td>
			<td>
				JADWAL
			</td>
			<td>
				JALUR
			</td>
			<td>
				HP
			</td>
			<td>
				AKSI
			</td>
		</tr>
	</thead>
	<tbody>
		<?php

		if(!is_null($data_mhs))
		{
			$num=0;
			foreach ($data_mhs as $dm) {
				echo "<tr>";
				echo "<td>";
				echo $num+=1;
				echo "</td>";
				echo "<td>";
				echo $dm->nomor_peserta;
				echo "</td>";
				echo "<td>";
				echo $dm->nama_lengkap;
				echo "</td>";
				echo "<td>";
				echo date_format(date_create($dm->tanggal),'d-m-Y');
				echo "</td>";
				echo "<td>";
				echo $dm->jalur_masuk;
				echo "</td>";
				echo "<td>";
				echo $dm->nohp;
				echo "</td>";
				echo "<td>";
				?>
				<button class="btn btn-small" id="<?php echo $num; ?>" jalur="<?php echo $dm->kode_jalur; ?>" gelombang="<?php echo $dm->gelombang; ?>" tahun="<?php echo $dm->tahun; ?>" value="<?php echo $dm->nomor_pendaftar; ?>" type="button" onclick="buat_form(this)">PINDAH RUANG</button>
				<?php
				echo "</td>";
				echo "</tr>";
				?>	
				<tr id="form_jadwal<?php echo $num; ?>" style="display:none;">
					<td colspan="2">
						<select class="form-control" id="jadwal<?php echo $num; ?>" no="<?php echo $num; ?>" onchange="cari_ruang(this)" jalur="<?php echo $dm->kode_jalur; ?>" gelombang="<?php echo $dm->gelombang; ?>" tahun="<?php echo $dm->tahun; ?>">
						<option value="">--</option>
						</select>
					</td>
					<td colspan="2">
						<select class="form-control" id="ruang<?php echo $num; ?>" no="<?php echo $num; ?>" onchange="cari_nomor(this)" jalur="<?php echo $dm->kode_jalur; ?>" gelombang="<?php echo $dm->gelombang; ?>" tahun="<?php echo $dm->tahun; ?>">
						<option value="">--</option>
						</select>
					</td>
					<td colspan="2">
						<select class="form-control" id="nomor<?php echo $num; ?>">
						<option value="">--</option>
						</select>
					</td>
					<td>
						<button class="btn btn-inverse btn-uin" id="<?php echo $dm->nomor_pendaftar; ?>" value="<?php echo $num; ?>" type="button" onclick="ganti_nomor_peserta(this)">SIMPAN</button>
					</td>
				</tr>
				<?php
			}
		}

		?>
	</tbody>
</table>
<script type="text/javascript">
	function buat_form (th) {
		
		var no=th.id;
		var nomor=th.value;
		var jalur=$('#'+th.id).attr('jalur');
		var gel=$('#'+th.id).attr('gelombang');
		var tahun=$('#'+th.id).attr('tahun');
		var kode_penawaran=jalur+gel+tahun;
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/cari_detail_jadwal2') ?>",
			type: "POST",
			data: "kode_penawaran="+kode_penawaran,
			success: function(jd)
			{
				$('#jadwal'+no).html(jd);
			}
		});
		$('#form_jadwal'+no).slideDown('slow');

	}

	function cari_ruang(kdj)
	{
		var no=$('#'+kdj.id).attr('no');
		var jalur=$('#'+kdj.id).attr('jalur');
		var gel=$('#'+kdj.id).attr('gelombang');
		var tahun=$('#'+kdj.id).attr('tahun');
		var kode_penawaran=jalur+gel+tahun;
		$.ajax({
      	url: "<?php echo base_url('adminpmb/input_data_c/cari_ruang_edit'); ?>",
      	type: "POST",
      	data: "kode_jadwal="+kdj.value+"&kode_penawaran="+kode_penawaran,
      	success: function(hasru){
        	$('#ruang'+no).html(hasru);
      	}
    	});
	}

function cari_nomor(cano)
  {
 	var ruang=cano.value;
  	var no=$('#'+cano.id).attr('no');
	var jalur=$('#'+cano.id).attr('jalur');
	var jadwal=$('#jadwal'+no).val();

    $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/ganti_nomor_peserta'); ?>",
      type: "POST",
      data: "kode_jadwal="+jadwal+"&id_ruang="+ruang+"&kode_jalur="+jalur+"&num="+no,
      success: function(hasno){
      
        $('#nomor'+no).html(hasno);
      
      }
    });

  }

function ganti_nomor_peserta(idsmpn)
  {
    var nomor_pendaftar=idsmpn.id;
    var no=idsmpn.value;
    var nomor_peserta=$('#nomor'+no).val();
    var jadwal=$('#jadwal'+no).val();
    var ruang=$('#ruang'+no).val();

    $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/update_nomor_peserta'); ?>",
      type: "POST",
      data: "id_ruang="+ruang+"&nomor_pendaftar="+nomor_pendaftar+"&nomor_peserta="+nomor_peserta+"&kode_jadwal="+jadwal,
      success: function(upnoper){
        
      	window.open("<?php echo base_url('adminpmb/input_data_c/pindah_ruang') ?>",'_self');
      }

    });

  }

</script>
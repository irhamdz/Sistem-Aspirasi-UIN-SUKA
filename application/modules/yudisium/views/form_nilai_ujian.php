<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
  
<link rel="stylesheet" href="http://uin-suka.ac.id//asset/colorbox/colorbox.css" />
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    --><script src="http://uin-suka.ac.id//asset/colorbox/jquery.colorbox.js"></script>
	
<div>

<h3 style="margin-bottom:10px;">FORM YUDISIUM</h3>

<form id="nilai-form" method="POST" enctype="multipart/form-data">

	<table class="table table-hover">
	
		<tr id="ktg_jalur">
			<td>
				<h>Jalur PMB</h>
			</td>
			<td>
				<select name='kode_jalur' class="form-control input-md" id="pena" style="width:300px;" onchange="cari_gelombang(this.value)">
				<option value="">Pilih Jalur PMB</option>
				<?php
				foreach ($jalur_masuk as $valjalur) {
					echo "<option value='".$valjalur->kode_jalur."'>".$valjalur->jalur_masuk."</option>";
				}

				?>
				</select>
			</td>
			<input type="hidden" id="ptr" name="pilihan">
		</tr>
		<tr>
			<td>
				Gelombang
			</td>
			<td>
				<select class="form-control input-md" id='gelombang' name="gelombang" style="width:300px;">
					<option value=""> -- </option>
				</select>
			</td>
		</tr>
		<td>
			Tahun
		</td>
			<td>
				<select name='tahun' style="width:300px;" id="tahun" class="form-control input-sm" onchange="cari_kelas(this.value)">
				<option value=''> Pilih Tahun </option>
				<?php 
					$year=getdate();
					$tahun=$year['year'];
					$i=10;
					while ($i>0) {
					$result=$tahun--;
					echo "<option value='".$result."'>".$result."</option>";
					$i--;
					}
				?>						
								</select>
			</td>
		</tr>
		<tr id="tr-jadwal" style="display:none;">
			<td>
				Jadwal
			</td>
			<td>
				<select name='kode_jadwal' id="kode_jadwal" style='width:300px;' class='form-control input-md'>
				<option value=''>--</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				Kelas
			</td>
			<td>
				<select id="kelas" name="kelas" class="form-control input-sm" style="width:300px;" onchange='cari_prodi(this.value)'> 
				<option value=""> -- </option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				Program Studi
			</td>
			<td>
				<select id="prodi" name="prodi" class="form-control input-sm" style="width:300px;" onchange='id_prodi=this.value'> 
				<option value=""> -- </option>

				</select>
			</td>
		</tr>
		<tr>
		<td></td>
			<td>
				<button class="btn btn-inverse btn-uin btn-small" type="button" value="1" onclick="ambil_rekap_nilai(this.value)"> CARI</button>
			</td>
		</tr>
		</form>
		</table>
	
</div>
<button class="btn btn-inverse btn-uin btn-small" id="btn_next" style="display:none;" type="button" value="0" onclick="ambil_rekap_nilai(this.value)"> Next</button>
<div id="data-nilai">
	
</div>
<script type="text/javascript">

function cek_jalur(jalur,gel,tahun)
{
	var kode_jalur=jalur+gel;
	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/cari_jadwal') ?>",
		type: "POST",
		data: "kode_jalur="+kode_jalur+"&tahun="+tahun,
		success: function(jd)
		{
			$('#kode_jadwal').html(jd);
		}
	});
}

var id_prodi;
function ambil_rekap_nilai(j)
{
	var jml=$('#jml_tawar').val();
	var jalur=$('#pena').val();
	var fungsi="";
	if(jalur != '14' || jalur != '15')
	{
		fungsi="cari_nilai_pmb";
	};
	if(jalur == '14')
	{
		fungsi="cari_nilai_snmptn";
	};
	if(jalur== '15')
	{
		fungsi="cari_nilai_spanptkin";
	};
//alert($('#nilai-form').serialize());
	$("#data-nilai").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
		
		$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/"+fungsi+"') ?>",
		type: "POST",
		data: $('#nilai-form').serialize(),
		success: function(hore)
		{
			$('#data-nilai').html(hore);
			

		}
		});
}

function cari_kelas(th)
{	
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();
	var kode_penawaran=kode_jalur+gelombang+tahun;

	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/cari_kelas') ?>",
		type: "POST",
		data: "kode_penawaran="+kode_penawaran,
		success: function(h)
		{
			$('#kelas').html(h);

		}
	});

	if(kode_jalur=='14')
	{
		prodi_snmptn();
		putaran_snmptn();
	}
	if(kode_jalur=='15')
	{
		prodi_spanptkin();
		putaran_spanptkin();
	}
	if(kode_jalur=='11')
	{
		cek_jalur(kode_jalur,gelombang,tahun);
	}


}

function cari_prodi(pr)
{
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();
	var kode_penawaran=kode_jalur+gelombang+tahun;
	var nip="<?php echo $this->session->userdata('username') ?>";

	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/prodi_kelas') ?>",
		type: "POST",
		data: "kode_jalur="+kode_jalur+"&gelombang="+gelombang+"&kelas="+pr+"&tahun="+tahun+"&nip="+nip,
		success: function(hx)
		{
			$('#prodi').html(hx);
			
		}
	});

	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/cari_putaran2') ?>",
		type: "POST",
		data: "kode_penawaran="+kode_penawaran+"&id_kelas="+pr,
		success: function(ptr)
		{
			if(ptr.length > 0)
			{
				$('#ptr').attr('value',ptr);
			}
			else
			{
				$('#ptr').attr('value','0');
			}
			
		

		}
	});

}
function cari_gelombang(jal)
{
	$('#tahun').get(0).selectedIndex = 0;
	
	
	if(jal != '14' || jal != '15')
	{
		
		$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/cari_gelombang') ?>",
		type: "POST",
		data: "kode_jalur="+jal,
		success: function (seljal)
		{
			$('#gelombang').html(seljal);
		}
		});
		

	};
	if(jal=='11')
	{
		$('#tr-jadwal').slideDown('slow');
	}
	else
	{
		$('#tr-jadwal').slideUp('slow');
	}


	
}

function prodi_spanptkin()
{

	var kode_jalur=$('#pena').val();
	var tahun=$('#tahun').val();
	var nip="<?php echo $this->session->userdata('username') ?>";

	$.ajax({
			url: "<?php echo base_url('yudisium/yudisium_c/prodi_spanptkin') ?>",
			type: "POST",
			data: "nip="+nip+"&jalur="+kode_jalur+"&tahun="+tahun,
			success: function(snm)
			{
				$('#prodi').html(snm);
			}
		});
}

function putaran_spanptkin()
{
	$.ajax({
			url: "<?php echo base_url('yudisium/yudisium_c/putaran_spanptkin') ?>",
			type: "POST",
			success: function(ptr)
			{
				$('#ptr').attr('value',ptr);

			}
		});
}

function prodi_snmptn()
{
	var kode_jalur=$('#pena').val();
	var tahun=$('#tahun').val();
	var nip="<?php echo $this->session->userdata('username') ?>";

	$.ajax({
			url: "<?php echo base_url('yudisium/yudisium_c/prodi_snmptn') ?>",
			type: "POST",
			data: "nip="+nip+"&jalur="+kode_jalur+"&tahun="+tahun,
			success: function(snm)
			{
				$('#prodi').html(snm);

			}
		});
}

function putaran_snmptn()
{
	$.ajax({
			url: "<?php echo base_url('yudisium/yudisium_c/putaran_snmptn') ?>",
			type: "POST",
			success: function(ptr)
			{
				$('#ptr').attr('value',ptr);

			}
		});
}
</script>

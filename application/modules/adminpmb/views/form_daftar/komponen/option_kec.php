<option value="">Pilih Kecamatan</option>
<?php
					if(!is_null($detail_wilayah))
					{
						foreach ($detail_wilayah as $kec) {
							echo "<option value='".$kec->kode_kecamatan."'>".$kec->nama_wilayah."</option>";
						}
					}

?>
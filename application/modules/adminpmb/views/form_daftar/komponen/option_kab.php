<option value="">Pilih Kabupaten</option>
<?php
					if(!is_null($detail_kabupaten))
					{
						foreach ($detail_kabupaten as $kab) {
							echo "<option value='".$kab->ket_kabupaten."'>".$kab->nama_kabupaten."</option>";
						}
					}

?>
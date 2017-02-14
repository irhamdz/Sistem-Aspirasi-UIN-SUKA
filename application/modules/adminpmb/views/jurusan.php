
<?php
$penawaran=array();
$jenjang=array();
if(!is_null($pen_prodi))
{
	foreach ($pen_prodi as $penprod) {
		array_push($penawaran, $penprod->id_prodi);
		array_push($jenjang, $penprod->id_jenjang);
	}
}
		if(!is_null($data_prodi))
		{
			foreach ($data_prodi as $prodi) {
				echo "<tr>";
				echo "<td>";
				echo "<input type='checkbox' id='".$prodi->id_prodi."' onclick='tawar_prodi(this)' "; 
				for($i=0; $i<count($penawaran); $i++)
				{
					if($prodi->id_prodi==$penawaran[$i])
					{
						echo " checked ";
					}
					if($prodi->id_jenjang != $jenjang[$i])
					{
						echo " disabled ";
					}
				}

				echo " value='".$prodi->kode_minat."'>";
				echo "   <u>".$prodi->nama_minat."  </u>-- ".$prodi->nama_jenjang;
				echo "</td>";
				echo "<td>-- ";
				echo $prodi->nama_prodi;
				echo "</td>";
				echo "</tr><br>";
			}
		}

		?>

<?php
$sehat=array();
$dapro=array();
if(!is_null($data_sarat))
{
	foreach ($data_sarat as $dasar) {
		array_push($sehat, $dasar->id_kesehatan);
		array_push($dapro, $dasar->id_prodi);
	}

}
	if(!is_null($data_prodi))
		{

			foreach ($data_prodi as $prodi) {
				echo "<tr>";
				echo "<td>";
				echo $prodi->nama_prodi; 
				echo "</td>";
				echo "<td>";
				echo "<table class='table'>";
				echo "<tr>";
				if(!is_null($kesehatan))
				{
					foreach ($kesehatan as $minkes) 
						{
						echo "<td>".$minkes->kondisi_kesehatan." <input type='checkbox' ";
						if(!is_null($data_sarat))
						{
							for($x=0; $x<count($data_sarat); $x++)
							{
								if($sehat[$x]==$minkes->id_kesehatan && $dapro[$x]==$prodi->id_prodi)
								{
									echo "checked";
								}
							}
						}
						
						echo " id='".$prodi->id_prodi.$minkes->id_kesehatan."' isi='".$prodi->id_prodi."' value='".$minkes->id_kesehatan."' onchange='simpan_sarat_kes(this)'></td>";
				
					}
				}
				echo "</tr>";
				echo "</table>";
				echo "</div>";
				echo "</td>";
				echo "</tr>";
			}
		}

		?>

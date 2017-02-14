
<h3 style="margin-bottom:10px;">Data UNIT</h3>
<br class="ganjel">
	<table class="table table-bordered table-hover">
  <?php

   
  $num=0;
  if(!is_null($unit))
  {
    foreach ($unit as $un) {
      echo "<tr>";
       echo "<td>";
       echo "NAMA UNIT ";
      echo "</td>";
       echo "<td>";
       echo $un->nama_unit;
      echo "</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td>";
       echo "LOGO ";
      echo "</td>";
       echo "<td>";
       echo "<img src='".pg_unescape_bytea($un->logo)."' style='width:40px' class='sia-profile-image'>";
      echo "</td>";
      echo "</tr>";
        echo "<tr>";
        echo "<td>";
       echo "NAMA KEMENTRIAN ";
      echo "</td>";
       echo "<td>";
       echo $un->kementrian;
      echo "</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td>";
       echo "JENIS ";
      echo "</td>";
       echo "<td>";
       echo $un->tema;
      echo "</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td>";
       echo "ALAMAT ";
      echo "</td>";
       echo "<td>";
       echo $un->alamat;
      echo "</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td>";
       echo "TAHUN AKADEMIK ";
      echo "</td>";
       echo "<td>";
       echo $un->tahun_akademik;
      echo "</td>";
      echo "</tr>";
    }

  }

  ?>
  <tbody>
  
  </table>

<script type="text/javascript">
  </script>

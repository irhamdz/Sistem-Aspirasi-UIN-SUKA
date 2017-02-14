<style type="text/css">
  .search-table{table-layout: fixed;}

.search-table-outter { overflow-x: scroll;margin-bottom: 20px;}
th, td {}
  .table {
  width:1200px;margin-bottom: 20px;
}
</style>
<div class="search-table-outter wrapper">
<table class="table table-bordered table-hover search-table inner">
  <thead>
    <tr>
      <th style="text-align:center;width:30px">NO</th>
      <th>PESANTREN</th>
      <th>NSPP</th>
      <th>NO. SANTRI</th>
      <th>JURUSAN</th>
      <th>NO. SERTIFIKAT</th>
      <th>TAHUN</th>
      <th style="text-align:center;width:50px">NILAI</th>
      <th style="text-align:center;width:100px">IJAZAH</th>
      <th style="text-align:center;width:100px">#</th>
    </tr>
  </thead>
  
  <tbody>
  <?php 
  $num=0; 
  
  if(!is_null($data_pesantren))
  {
  	foreach ($data_pesantren as $p) 
  		{ 
  	  echo "<tr>";
      echo "<td>";  echo $num+=1;                echo "</td>";
      echo "<td>";  echo $p->nama_pesantren;         echo "</td>";  
      echo "<td>";  echo $p->nspp;         echo "</td>";
      echo "<td>";  echo $p->nomor_santri;         echo "</td>";
      echo "<td>";  echo $p->jurusan;         echo "</td>";
      echo "<td>";  echo $p->nomor_sertifikat;         echo "</td>";
      echo "<td>";  echo $p->tahun_masuk." s.d ".$p->tahun_lulus;         echo "</td>";
      echo "<td>";  echo $p->nilai_sertifikat;         echo "</td>";
      echo "<td>";  echo "<a download href='".pg_unescape_bytea($p->ijazah)."'> Download</a>";      echo "</td>";
      echo "<td align='center'>"; 
      echo "<a onclick='hapus_pes(this.id)' id='".$p->id_riwayat."' href='#'><i class='icon-trash'></i> Hapus</a>";
      echo "</td>";
      }
  }
  ?>

</table>
</div>
  <a name="fokus"></a>
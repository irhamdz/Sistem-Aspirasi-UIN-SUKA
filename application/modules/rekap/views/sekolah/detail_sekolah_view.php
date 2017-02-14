<h3><?php echo $d->nama_sekolah?></h3>
<br>
<table class="table table-striped">
  <tbody>
    <tr><td width="30%"><b>NPSN</b></td><td><?php echo $d->npsn ?></td></tr>
    <tr><td><b>Jenis Sekolah</b></td><td><?php echo $d->jenis_sekolah ?></td></tr>
    <tr><td><b>Kabupaten/Kota</b></td><td><?php echo $d->kode_kabupaten.' - '.$d->nama_kabupaten ?></td></tr>
    <tr><td><b>Provinsi</b></td><td><?php echo $d->kode_provinsi.' - '.$d->nama_provinsi ?></td></tr>
    <tr><td><b>Akreditasi</b></td><td><?php echo $d->akreditasi_sekolah ?></td></tr>
    <tr><td><b>Nilai Akreditasi</b></td><td><?php echo $d->nilai_akreditasi ?></td></tr>
    <tr><td><b>Kepemilikan</b></td><td><?php echo $d->kepemilikan ?></td></tr>
  
  </tbody>
</table>

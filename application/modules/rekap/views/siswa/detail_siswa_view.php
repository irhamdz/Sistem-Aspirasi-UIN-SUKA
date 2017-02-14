<h3><?php echo $d->nama_siswa;?></h3>
<br>
<center>
<img width="100px" src="<?php echo base_url('media/snmptn/'.$d->tahun.'/'.$d->nomor_pendaftaran.'/'.$d->foto_siswa)?>"/>
</center>
<br>
<table class="table table-striped">
  <tbody>
    <tr><td width="30%"><b>Nomor Pendaftaran</b></td><td><?php echo $d->nomor_pendaftaran ?></td></tr>
    <tr><td><b>ID Jurusan</b></td><td><?php echo $d->id_jurusan ?></td></tr>
    <tr><td><b>NPSN Sekolah</b></td><td><?php echo $d->npsn_sekolah ?></td></tr>
    <tr><td><b>Jenis Kelamin</b></td><td><?php echo $d->kode_jenis_kelamin ?></td></tr>
    <tr><td><b>Tanggal_lahir</b></td><td><?php echo tanggal_indonesia($d->tanggal_lahir) ?></td></tr>
    <tr><td><b>NIS</b></td><td><?php echo $d->nis ?></td></tr>
    <tr><td><b>NISN</b></td><td><?php echo $d->nisn ?></td></tr>
    <tr><td><b>NIK</b></td><td><?php echo $d->nik ?></td></tr>
    <tr><td><b>No UN</b></td><td><?php echo $d->nomor_un ?></td></tr>
    <tr><td><b>Tahun UN</b></td><td><?php echo $d->tahun_un ?></td></tr>
    <tr><td><b>Bidik Misi</b></td><td><?php echo $d->tahun_un ?></td></tr>
    <tr><td><b>KAP Bidik Misi</b></td><td><?php echo $d->kap_bidik_misi ?></td></tr>
    <tr><td><b>Nilai Dibawah KKM</b></td><td><?php echo $d->nilai_dibawah_kkm ?></td></tr>
    <tr><td><b>Tidak Naik Kelas</b></td><td><?php echo $d->tidak_naik_kelas ?></td></tr>  
  </tbody>
</table>

<?php
	$arr_ad = array( 0 => 'Semua', 1 => 'Dosen Dalam Program Studi', 2 => 'Dosen Luar Program Studi');
	$arr_jd = array( 0 => 'Semua', 1 => 'Dosen Tetap PNS', 2 => 'Dosen Luar Biasa');
	$arr_sd = array( 0 => 'Semua', 1 => 'Aktif Mengajar', 2 => 'Tidak Aktif Mengajar');			
?>	
	<div class="article-title">Dosen & Matakuliah</div>
	<br>
	<div class="clear10"></div>
	<ul class="nav nav-tabs" style="margin:0">
	  <li class="active"><a href="#"><b>Dosen</b></a></li>
	  <li><a href="#">Matakuliah</a></li>
	</ul>
	<br>
	
	<h4>Cari</h4>
	<form class="form-inline" method="post" action="">
	  <div class="form-group" style="margin-right:12px;">
	   <input type="text" class="form-control col-md-3" id="cari" name="cari" placeholder="Search">
	  </div>	  
	  <button type="submit" class="btn btn-inverse">Cari</button>
	</form>
	
	<br>
	<h4>Indeks</h4>
	<?php
		$index = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','All');
		foreach($index as $in){
			echo"<a href='".site_url('page/dosen/index/'.$in)."'>".$in."</a>  |  ";
		}	
	$ad;
	?>
	<br><br>
	<h4>Telusur</h4>
	<form method="post" action="">
		<div class="form-group">
		<div class="row">
			<div  class="col-sm-3 col-md-2" >
				<label for="prodi">Prodi</label>
			</div>
			<div class="col-sm-6 col-md-4">
				<select class="form-control input-sm" id="prodi" name="prodi" >
				<option value="" >Pilih Prodi</option>
				<?php foreach($prodi as $i){
						if(isset($ap) and $i->KODE_PRODI==$ap){
							echo"<option value='".$i->KODE_PRODI."' selected>".$i->NAMA_PRODI."</option>";
						}else{
							echo"<option value='".$i->KODE_PRODI."' >".$i->NAMA_PRODI."</option>";
						}
				} ?>
				</select>
			</div>	
			</div>
		</div>	
		<div class="form-group">
		<div class="row">
			<div  class="col-sm-3 col-md-2" >
				<label for="asal_dosen">Asal Dosen</label>
			</div>
			<div class="col-sm-6 col-md-4">
				<select id="asal_dosen" class="form-control input-sm" name="asal_dosen">
				<option value="" >Pilih Asal Dosen</option>
				<?php foreach($arr_ad as $a=>$lad){
						 if(isset($ad) and $a==$ad){
							echo"<option value='".$a."' selected >".$lad."</option>";
						 }else{
							echo"<option value='".$a."' >".$lad."</option>";
						}
				} ?>
				</select>
			</div>
			</div>	
		</div>	
		<div class="form-group">
		<div class="row">
			<div  class="col-sm-3 col-md-2" >
				<label for="jenis_dosen">Jenis Dosen</label>
			</div>
			<div class="col-sm-6 col-md-4">
				<select id="jenis_dosen" class="form-control input-sm" name="jenis_dosen">
				<option value="" >Pilih Jenis Dosen</option>
				<?php foreach($arr_jd as $j=>$ljd){
						 if(isset($jd) and $j==$jd){
							echo"<option value='".$j."' selected >".$ljd."</option>";
						 }else{
							echo"<option value='".$j."' >".$ljd."</option>";
						}
				} ?>
				</select>
			</div>
			</div>	
		</div>	
		<div class="form-group">
		<div class="row">
			<div  class="col-sm-3 col-md-2" >
				<label for="status_dosen">Status Dosen</label>
			</div>
			<div class="col-sm-6 col-md-4">
				<select id="status_dosen" class="form-control input-sm" name="status_dosen">
				<option value="" >Pilih Status Dosen</option>
				<?php foreach($arr_sd as $s=>$lsd){
						 if(isset($sd) and $s==$sd){
							echo"<option value='".$s."' selected >".$lsd."</option>";
						 }else{
							echo"<option value='".$s."' >".$lsd."</option>";
						}
				} ?>
				</select>
			</div>
			</div>	
		</div>	
		<div class="form-group">
		<div class="row">
			<div  class="col-sm-3 col-md-2" >
			<label for="exampleInputEmail1"></label>
			</div>
			<div class="col-sm-6 col-md-4 text-right">
				<input type="hidden" name="telusur" value="1" />
				<button type="submit" class="btn-uin btn btn-inverse btn btn-small">Tampilkan</button>
			</div>	
		</div>	
		</div>
	</form>
	<br>	
	
	<?php if(isset($dosen)):  if( $dosen !=null):?>
	<?php $i=0;?>
	<div class="page-header">
	<div class="article-title">Hasil Pencarian :</div>
	</div>
	<?php 	foreach ($dosen as $j){ ?>
		<div class="dosen-nama"><a href="<?php echo site_url('page/detil_dosen/'.$j->KD_DOSEN)?>" ><?php echo $j->NM_DOSEN_F ?></a></div>
		<div class="dosen-desc">
			<?php if(isset($j->NIDN)) echo"NIDN. ".$j->NIDN."<br>"; ?>
			<?php 
				if(isset($j->JENIS_DOSEN)){
					if($j->JENIS_DOSEN <= 2 and $j->NIDN!=null){
						echo "Dosen Tetap PNS<br>"; 
					}else{
						echo "Dosen Luar Biasa<br>"; 
					}
				}	
			?>
			<?php if(isset($j->NM_PRODI)) echo $j->NM_PRODI."<br>"; ?>
			<?php if(isset($j->NM_FAK_J)) echo $j->NM_FAK_J."<br>"; ?>
		</div>
	<?php } ?>
	<?php else: ?>
		<p>Data tidak ditemukan. </p>
	<?php endif ?>
	<?php endif ?>
<style>
.dosen-nama{
	font-weight:bold;
}
.dosen-desc{
	margin-bottom:20px;
}	
	
</style>
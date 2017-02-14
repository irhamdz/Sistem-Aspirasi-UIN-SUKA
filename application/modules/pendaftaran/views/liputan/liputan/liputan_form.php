<h2 style="margin-bottom:30px;">Liputan</h2>
 <form id="finput" name="finput" method="post" class=" form-horizontal" action="" enctype="multipart/form-data">
<div id="">
	<table name="tinput" id="tinput" class="table table-hover">
	<tbody><tr>
		<td class="col-md-2">Judul</td>
		<td>
		<input id="judul" name="judul" class="form-control input-md" type="text" value="<?php if(isset($d->JUDUL)) echo $d->JUDUL?>" />
		</td>
	  </tr>
	  <tr>
		<td class="">Foto</td>
		<td>
			<?php if(isset($d->FOTO)) echo $d->FOTO?>
			<input id="file" name="foto"  type="file" />
		</td>
	  </tr>
	  <tr>
		<td class="">Deskripsi Foto</td>
		<td><input id="deskripsi_foto" name="deskripsi_foto" class="form-control input-md" type="text" value="<?php if(isset($d->DESKRIPSI_FOTO)) echo $d->DESKRIPSI_FOTO?>"/></td>
	  </tr>
	  <tr>
		<td colspan="2">
			<span> Isi</span>
			<textarea name="isi" id="text1" ><?php if(isset($d->ISI_LIPUTAN)) echo $d->ISI_LIPUTAN?></textarea>
			<?php echo display_ckeditor($ckeditor); ?>
		</td>
	  </tr>
	  <tr>
		<td class="">Sumber</td>
		<td><input id="sumber" name="sumber" class="form-control input-md" type="text" value="<?php if(isset($d->SUMBER)) echo $d->SUMBER?>"/></td>
	  </tr>
	  <tr>
		<td class=""></td>
		<td>
			<button type="submit" class="btn btn-inverse btn-uin btn-small">Simpan</button>
			<a href="<?php echo site_url('admin/liputan')?>" class="btn btn-inverse btn-uin btn-small">Batal</button>
		</td>
	  </tr>
  
  </tbody></table>
  
				
  </div>
  </form>
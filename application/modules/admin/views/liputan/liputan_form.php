<h2 style="margin-bottom:30px;">Liputan</h2>
 <form id="finput" name="finput" method="post" class=" form-horizontal" action="" enctype="multipart/form-data">
<div id="">
	<table name="tinput" id="tinput" class="table table-hover">
	<tbody><tr>
		<td class="col-md-2">Judul</td>
		<td>
		<input id="judul" name="judul" class="form-control input-md" type="text" value="<?php if(isset($d->judul)) echo $d->judul?>" />
		</td>
	  </tr>
	  <tr>
		<td class="">Foto</td>
		<td>
			<?php if(isset($d->foto)) echo $d->foto?>
			<input id="file" name="foto"  type="file" />
		</td>
	  </tr>
	  <tr>
		<td class="">Deskripsi Foto</td>
		<td><input id="deskripsi_foto" name="deskripsi_foto" class="form-control input-md" type="text" value="<?php if(isset($d->deskripsi_foto)) echo $d->deskripsi_foto?>"/></td>
	  </tr>
	  <tr>
		<td colspan="2">
			<span> Isi</span>
			<textarea name="isi" id="text1" ><?php if(isset($d->isi_liputan)) echo $d->isi_liputan?></textarea>
			<?php echo display_ckeditor($ckeditor); ?>
		</td>
	  </tr>
	  <tr>
		<td class="">Sumber</td>
		<td><input id="sumber" name="sumber" class="form-control input-md" type="text" value="<?php if(isset($d->sumber)) echo $d->sumber?>"/></td>
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
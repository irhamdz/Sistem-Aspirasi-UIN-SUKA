<h2 style="margin-bottom:30px;">Pengumuman</h2>
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
		<td class="">File</td>
		<td>
			<?php if(isset($d->NAMA_FILE)) echo $d->NAMA_FILE?>
			<input id="file" name="file"  type="file" />
		</td>
	  </tr>
	  <tr>
		<td class="">URL</td>
		<td><input id="url" name="url" class="form-control input-md" type="text" value="<?php if(isset($d->URL)) echo $d->URL?>"/></td>
	  </tr>
	  <tr>
		<td class="">Sumber</td>
		<td><input id="sumber" name="sumber" class="form-control input-md" type="text" value="<?php if(isset($d->SUMBER)) echo $d->SUMBER?>"/></td>
	  </tr>
	  <tr>
		<td class=""></td>
		<td>
			<button type="submit" class="btn btn-inverse btn-uin btn-small">Simpan</button>
			<a href="<?php echo site_url('admin/pengumuman')?>" class="btn btn-inverse btn-uin btn-small">Batal</button>
		</td>
	  </tr>
  
  </tbody></table>
  </div>
  </form>
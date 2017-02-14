<h2 style="margin-bottom:30px;">Dokumen</h2>
<?php# print_r($d);?>
 <form id="finput" name="finput" method="post" class=" form-horizontal" action="" enctype="multipart/form-data">
<div id="">
	<table name="tinput" id="tinput" class="table table-hover">
	<tbody>
	  <tr>
		<td class="col-md-2">Dokumen</td>
		<td>
			<select name="nama_dokumen" class="form-control input-md">
			<?php foreach($doc as $dc):?>
				<option value="<?php echo $dc->id_dokumen?>"><?php echo $dc->nama_dokumen?></option>	
			<?php endforeach ?>
			</select>
		</td>
	  </tr>
	  <tr>
		<td class="col-md-2">Nama Histori Dokumen</td>
		<td>
		<input id="nama_histori" name="nama_histori" class="form-control input-md" type="text" value="<?php if(isset($d->nama_histori)) echo $d->nama_histori?>" />
		</td>
	  </tr>
	  <tr>
		<td class="">File</td>
		<td>
			<?php if(isset($d->nama_file)) echo $d->nama_file?>
			<input id="file" name="file"  type="file" />
		</td>
	  </tr>
	  <tr>
		<td class="">File Sumber</td>
		<td>
			<?php if(isset($d->nama_file_sumber)) echo $d->nama_file_sumber?>
			<input id="file_sumber" name="file_sumber"  type="file" />
		</td>
	  </tr>
	  <tr>
		<td class=""></td>
		<td>
			<button type="submit" class="btn btn-inverse btn-uin btn-small">Simpan</button>
			<a href="<?php echo site_url('admin/dokumen')?>" class="btn btn-inverse btn-uin btn-small">Batal</button>
		</td>
	  </tr>
  
  </tbody></table>
  </div>
  </form>
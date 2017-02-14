
<div id="admin-content">

	<h2 >Berita</h2>
	<form method="post" action="" enctype="multipart/form-data">
		<div style="font-weight:bold; margin:10px 0;">
			<div class="control-group">
				<div class="controls">
					<label class="control-label" for="judul">Judul</label>
					<input style="width:98%;" name="judul" id="judul" type="text">
				</div>
				<div class="controls">
					<label class="control-label" for="photo">File</label>
					<input name="photo" id="photo" type="file">
				</div>
				<div class="controls">
					<label class="control-label" for="deskripsi">Deskripsi Foto</label>
					<input style="width:98%;" name="deskripsi" id="deskripsi" type="text">
				</div>
				<div class="controls">
					<label class="control-label" for="judul">Sumber</label>
					<input name="sumber" id="sumber" type="text">
				</div>
				<div class="controls">
					<label class="control-label" for="nim">Konten Berita</label>
					<textarea name="isi" id="text1" ></textarea>
					<?php echo display_ckeditor($ckeditor); ?>
				</div>
				<div class="control-group" style="text-align:right">
					<button type="submit" class="btn btn-primary" style="font-size:14px">Simpan</button>
				</div>
			</div>
		</div>
	</form>		


</div>
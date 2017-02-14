
<div id="admin-content">

	<h2>Unit</h2>
	<form method="post" action="" enctype="multipart/form-data">
		<div style="font-weight:bold; margin:10px 0;">
			<div class="control-group">
				<div class="controls">
					<label class="control-label" for="title">Nama Unit</label>
					<input style="width:98%;" name="judul" id="title" value="" type="text">
				</div>
				<div class="controls">
					<label class="control-label" for="nim">Konten</label>
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
  
<div id="admin-content">
<?php foreach($page as $p){}?>
<h1>Edit Foto Slide</h1>
	<form  name="photo" action="" method="post" enctype="multipart/form-data">
		<div style="font-weight:bold; margin:10px 0;">
			<div class="control-group">
				<div class="controls">
					<label class="control-label" for="title">Judul</label>
					<input name="judul" value="<?php echo $p->judul ?>" size="90" type="text"/>
				</div>
				<div class="controls">
					<label class="control-label" for="title">Foto</label>
					<input type="file" name="image" size="30" />
				</div>
				<div class="controls">
					<label class="control-label">Deskripsi</label>
					<input name="deskripsi" value="<?php echo $p->deskripsi ?>"size="90" type="text"/>	
				</div>
				<div class="controls">
					<label class="control-label">Url</label>
					<input name="url" value="<?php echo $p->url ?>" size="90" type="text"/>	
				</div>
				<div class="controls">
					<label class="control-label">Active Status </label>
					<?php if( $p->active == 'Y' ){ ?>
					<input type='radio' name="active" id="Y" value="Y"size="90" checked /> <label style="display:inline" for='Y'> Y</label>
					<input type='radio' name="active" id="N"value="N"size="90"/> <label style="display:inline" for='N'> N</label>
					<?php }else{ ?>
					<input type='radio' name="active" id="Y" value="Y"size="90"/> <label style="display:inline" for='Y'> Y</label>
					<input type='radio' name="active" id="N"value="N"size="90"checked /> <label style="display:inline" for='N'> N</label>
					<?php } ?>
				</div>
				<br/>
				<div class="control-group" >
					<input type="submit" name="upload" class="btn btn-primary" value="Simpan" />
				</div>
			</div>
		</div>
	</form>	
</div>	
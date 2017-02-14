
   <script src="<?php echo base_url();?>public/javascript/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>public/javascript/jquery.imgareaselect.min.js" type="text/javascript"></script>
    
    <?php if($large_photo_exists && $thumb_photo_exists == NULL){?>
    <script src="<?php echo base_url();?>public/javascript/jquery.imgpreview.js" type="text/javascript"></script>
    <script type="text/javascript">
    // <![CDATA[
        var thumb_width    = <?php echo $thumb_width ;?> ;
        var thumb_height   = <?php echo $thumb_height ;?> ;
        var image_width    = <?php echo $img['image_width'] ;?> ;
        var image_height   = <?php echo $img['image_height'] ;?> ;
    // ]]>
    </script>
    <?php } ?>


<?php if($error) :?>
    <ul><li><strong>Error!</strong></li><li><?php echo $error ;?></li></ul>
<?php endif ;?>

<?php if($large_photo_exists && $thumb_photo_exists) { ?>
	<?php echo $large_photo_exists."&nbsp;".$thumb_photo_exists; ?>
	<p><a href="<?php echo $_SERVER["PHP_SELF"];?>">Upload another</a></p>

<?php }else if($large_photo_exists && $thumb_photo_exists == NULL){ ?>

<h2>Create Thumbnail</h2>
<div align="center">
        <img src="<?php echo base_url() . $upload_path.$img['file_name'];?>" style="float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" />
        <div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
                <img src="<?php echo base_url() . $upload_path.$img['file_name'];?>" style="position: relative;" alt="Thumbnail Preview" />
        </div>
        <br style="clear:both;"/>
		
		
		
		
        <form name="thumbnail" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
		<input type="hidden" name="judul" value="<?php echo $caps['judul']; ?>" size="90"/>
		<input type="hidden" name="deskripsi" value="<?php echo $caps['deskripsi'] ?>" size="90"/>
		<input type="hidden" name="url" value="<?php echo $caps['url'] ?>"size="90"/>
		<input type="hidden" name="active" value="<?php echo $caps['active'] ?>"size="90"/>
            
			<input type="hidden" name="x1" value="" id="x1" />
                <input type="hidden" name="y1" value="" id="y1" />
                <input type="hidden" name="x2" value="" id="x2" />
                <input type="hidden" name="y2" value="" id="y2" />
                <input type="hidden" name="file_name" value="<?php echo $img['file_name'] ;?>" />
                <input type="submit" name="upload_thumbnail" value="Simpan" id="save_thumb" />
        </form>
</div>
<hr />
<?php 	}else{ ?>


<h1>Tambah Foto Slide</h1>
<br/>
<form  name="photo" action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
		 <td><b>Title</b></td>
            <td><input name="judul" value="" size="90"/></td>
        </tr>
		<tr>    
		  <td><b>Photo</b></td>    
		  <td><input type="file" name="image" size="30" /> </td> 
		</tr>
        <tr>
		 <td><b>Description</b></td>
            <td><input name="deskripsi" value="<?php echo $deskripsi ?>" size="90"/></td>
        </tr>
        <tr>
		 <td><b>Url</b></td>
            <td><input name="url" value=""size="90"/></td>
        </tr>
      <tr>
		 <td><b>Active Status </b></td>
            <td><input type='radio' name="active" id="Y" value="Y"size="90"/> <label for='Y'> Y</label>
				<input type='radio' name="active" id="N"value="N"size="90"/> <label for='N'> N</label>
			</td>
        </tr>
       
	   <tr>
            
            <td><input type="submit" name="upload" value="Simpan" /></td>
        </tr>
    </table>



<?php 	} ?>

<?php
foreach($page as $p){}
?>
<h1>Gallery Form</h1>
<form action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
		 <td><b>Judul</b></td>
            <td><input name="judul" value="<?php echo $p->nama_gallery ?>" size="80"/></td>
        </tr>
		<tr>    
		  <td><b>Photo</b></td>    
		  <td><input name="photo" type="file"></td> 
		</tr>
       
	   <tr>
            
            <td><input type="submit" value="Simpan" /></td>
        </tr>
    </table>

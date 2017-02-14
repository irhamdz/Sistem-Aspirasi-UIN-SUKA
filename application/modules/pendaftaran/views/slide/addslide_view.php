<h1>Add Slide</h1>
<form action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
		 <td><b>Title</b></td>
            <td><input name="judul" value="" size="90"/></td>
        </tr>
		<tr>    
		  <td><b>Photo</b></td>    
		  <td><input name="photo" type="file"></td> 
		</tr>
        <tr>
		 <td><b>Description</b></td>
            <td><input name="deskripsi" value="" size="90"/></td>
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
            
            <td><input type="submit" value="Simpan" /></td>
        </tr>
    </table>

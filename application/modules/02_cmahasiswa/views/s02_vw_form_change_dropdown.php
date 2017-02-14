<?php #print_r($kabupaten); ?>
<form action="" method="POST">
<table class="table table-bordered">
        <tr>
                <th>Nama Sekolah</th>
                <td><select class="wil" id="prop" name='propinsi'>
					<option value=''>-Pilih Propinsi-</option>
					<?php 
						foreach($propinsi as $value){ 
								echo "<option value=".$value->KODE_PROPINSI.">".$value->NAMA_PROPINSI."</option>";
						}?></select>
						<br />
						<select class="wil" id="kab" name='kabupaten' style="display: none;">
							<option value="">-Pilih Kabupaten-</option>
						</select>
						<br />
						<select class="wil" id="sek" name='sekolah' style="display: none;">
							<option value="">-Pilih Sekolah-</option>
							</select><br />
						<input type="text" id="sekolah" name="sekolah_lain" value="" style="display: none;">
						<input type="submit" name="simpan" value="SIMPAN" />
						</td>
        </tr>
</table>
</form>
<script type="text/javascript">
$(function () {
       
        $(document).ajaxStart(function () {
        $("#tbl-rekap").append("<span style='background-color: white; position: relative; z-index:1; text-align:center;'><center><img src='http://pustaka.uin-suka.ac.id/asset/img/loading.gif'></img><br>Harap menunggu...</center></span>");
    });
 
        $(".wil").change(function() {
                id = $(this).attr('id');
                val = $(this).val();
                if(id == 'kab'){
                        propinsi = $("#prop").val();
                        $.ajax({
                        type: 'post',
                        dataType: 'html',
                        data: {op: id, prop: propinsi, kab: val},
                        })
						.done(function(x) {
                                $("#sek").html(x);
                        });
								
				}else{
                        $.ajax({
                        type: 'post',
                        dataType: 'json',
                        data: {op: id, val: val},
                        })
                        .done(function(x) {
                                $("#kab").html(x);
                        });
                }              
        });
		
		$('#prop').on('change',function(){
			var prop=$('#prop option:selected').val();
			if(prop){
				$('#kab').show();
				$('#kab').focus();
				
			}else {
				$('#kab').hide();

			}
			$('#sek').hide();
			$('#sekolah').hide();
		});
		
		$('#kab').on('change',function(){
			var prop=$('#prop option:selected').val();
			var kab=$('#kab option:selected').val();
			if(kab){
				$('#sek').show();
				$('#sek').focus();
			}else{
				$('#sek').hide();
			}
		});
		
		$('#sek').on('change',function(){
			var sek=$('#sek option:selected').val();
			var skl = sek.substr(4, 4);
			if(skl == 9999){
				$('#sekolah').show();
				$('#sekolah').focus();
			}else{
				$('#sekolah').hide();
			}
		});
});
</script>
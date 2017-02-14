<div class="system-content-sia">
<?php
echo "<div id='notif-upsbp'></div>";
echo form_open_multipart(''.$this->session->userdata('status').'/data-actionform" id="frm-input'); 
?>
		<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
			<tbody>
				<tr>
					<td colspan='2'><strong>PERSONAL DETAIL</strong><br /></td>
				</tr>
				<tr>
					<td>Full Name</td>
					<td><div class="col-xs-5"><?php echo $pendaftar[0]->PMB_NAMA_LENGKAP_PENDAFTAR; ?></div></td>
				</tr>
				<tr>
					<td class="reg-label">Country of birth</td>
					<td class="reg-input">
						<div class="col-xs-7"><?php #echo $pendaftar[0]->COUNTRY_OF_BIRTH; ?>
							
							<?php 
								foreach($negara as $value){
									if($value->KD_NEGARA == $pendaftar[0]->COUNTRY_OF_BIRTH){ ?>
							<?php echo $value->NM_NEGARA;?>
							<?php 	}
							}		
							?>
							</div>
					</td>
				</tr>
				<tr>
					<td>Place Of Birth</td>
					<td><div class="col-xs-5"><?php echo $pendaftar[0]->PMB_TEMPAT_LAHIR_PENDAFTAR; ?></div></td>
				</tr>
				<tr>
					<td>Date Of Birth</td>
					<td><div class="col-xs-5">
					<?php echo $pendaftar[0]->PMB_TGL_LAHIR_PENDAFTAR; ?></div></td>
				</tr>
				<tr>
					<td class="reg-label">Nationality</td>
					<td class="reg-input">
						<div class="col-xs-5">
							<?php 
								foreach($negara as $value){
									if($value->KD_NEGARA == $pendaftar[0]->NEGARA_ASAL){ ?>
							<?php echo $value->NM_NEGARA;?>
							<?php 	}
							}		
							?></div>
					</td>
				</tr>
				<tr>
					<td>Sex</td>
					<td><div class="col-xs-5">
							<?php
							$jk=$pendaftar[0]->PMB_JENIS_KELAMIN_PENDAFTAR;
							switch($jk){
							case 1 : 
							echo "Female"; break;
							default :
							echo "Male"; break;
					} ?> </div>
					</td>
				</tr>
				<tr>
					<td>Address</td>
					<td><div class="col-xs-7"><?php echo $pendaftar[0]->PMB_ALAMAT_LENGKAP_PENDAFTAR; ?></div></td>
				</tr>
				<tr>
					<td>City</td>
					<td><div class="col-xs-5"><?php echo $pendaftar[0]->CITY; ?></div></td>
				</tr>
				<tr>
					<td>Province</td>
					<td><div class="col-xs-5"><?php echo $pendaftar[0]->PROVINCE; ?></div></td>
				</tr>	
				<tr>
					<td>Country</td>
					<td><div class="col-xs-7">
							<?php 
								foreach($negara as $value){
									if($value->KD_NEGARA == $pendaftar[0]->COUNTRY){ ?>
							<?php echo $value->NM_NEGARA;?>
							<?php 	}
							}		
							?></div>
					</td>
				</tr>
				<tr>
					<td>Zip/Postcode</td>
					<td><div class="col-xs-5"><?php echo $pendaftar[0]->KODE_POS; ?></div></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td><div class="col-xs-5"><?php echo $pendaftar[0]->PMB_TELP_PENDAFTAR; ?></div></td>
				</tr>
				<tr>
					<td>Mobile</td>
					<td><div class="col-xs-5"><?php echo $pendaftar[0]->MOBILE_PHONE; ?></div></td>
				</tr>
				<tr>
					<td>Passport Number</td>
					<td><div class="col-xs-5"><?php echo $pendaftar[0]->PASSPORT_NUMBER; ?></div></td>
				</tr>
				<tr>
					<td>Place Of Issue</td>
					<td><div class="col-xs-5"><?php echo $pendaftar[0]->PLACE_OF_ISSUE; ?></div></td>
				</tr>
				<tr>
					<td>Expiry Date</td>
					<td><div class="col-xs-5">
					<?php echo $pendaftar[0]->EXPIRY_DATE; ?></div></td>
				</tr>
				<tr>
					<td>Photo</td>
					<td><div class="col-xs-7"><img src='<?php echo base_url().'img_pendaftar/matrikulasi_ln/'.$pendaftar[0]->PMB_TAHUN_PENDAFTARAN.'/'.$pendaftar[0]->PMB_FOTO_PENDAFTAR.''; ?>' width="200" />
						</div>
					</td>
				</tr>
				<tr>
					<td>Proof of payment</td>
					<td><div class="col-xs-7"><img src='<?php echo base_url().'payment/'.$pendaftar[0]->PMB_TAHUN_PENDAFTARAN.'/'.$pendaftar[0]->PMB_PIN_PENDAFTAR.'-PAYMENT-.jpg'; ?>' width="200" />
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><b>PROGRAM TO BE ATTENDED</b></td>
					<td><div class="col-xs-7"><?php 
						foreach ($program as $v){ ?>
						<?php if($v->ID_PROGRAM==$program_peserta[0]->PROGRAM){  echo $v->PROGRAM_NAME;  }} ?>
						</div></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<?php if($program_peserta[0]->PROGRAM!=1){ ?>
				<tr>
					<td colspan='2'><strong>DEPARTMENT TO BE ATTENDED</strong><br /></td>
				</tr>
				<tr>
					<td>Education Level</td>
					<td>
						<div class="col-xs-7">
					<?php 
						foreach ($KD_PENDIDIKAN as $v){ ?>
							<?php if($v->ID_JENJANG==$EDUCATION_LEVEL[0]->ID_JENJANG){echo $v->NAMA_JENJANG; } ?>
						<?php } ?>
						</div></td>
				</tr>
			<?php 
			
			if($choice[0]->ID_JENJANG==3){ ?>
				<input type="hidden" name="ID_JENJANG" value="<?php echo $choice[0]->ID_JENJANG; ?>" />
				<tr>
				<td>First Department</td>
				<td><div class="col-xs-7">
					<?php
						foreach($JENJANG as $v){
							if($v->PMB_ID_PRODI==$choice[0]->PMB_PILJUR_1){
								echo $v->PMB_NAMA_PRODI; 
							}							
						}
					?>
				</div></td>
			</tr>
			<?php }else{ ?>
				<input type="hidden" name="ID_JENJANG" value="<?php echo $choice[0]->ID_JENJANG; ?>" />
				<tr>
				<td>First Department</td>
				<td><div class="col-xs-7">
					<?php
						foreach($JENJANG as $v){
							if($v->PMB_ID_PRODI==$choice[0]->PMB_PILJUR_1){
								echo $v->PMB_NAMA_PRODI; 
							}							
						}
					?>
				</div></td>
			</tr>
		<tr>
			<td>Second Department</td>
			<td><div class="col-xs-7">
					<?php
						foreach($JENJANG as $v){
							if($v->PMB_ID_PRODI==$choice[0]->PMB_PILJUR_2){
								echo $v->PMB_NAMA_PRODI; 
							}							
						}
					?>
				</div></td>
		</tr>
		<tr>
			<td>Third Department</td>
			<td><div class="col-xs-7">
					<?php
						foreach($JENJANG as $v){
							if($v->PMB_ID_PRODI==$choice[0]->PMB_PILJUR_3){
								echo $v->PMB_NAMA_PRODI; 
							}							
						}
					?>
				</div></td>
		</tr>
		<?php } }?>
		</table>
	<?php echo form_close(); 
	$url_base=base_url().$this->session->userdata('status'); ?>
</div>
<script>
$(function() {
$("form#frm-input").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'data-actionform',
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(x) {
        var data = $.parseJSON(x);
        //console.log(data);
		
        $("#notif-upsbp").html(data['pesan']);
		$('html, body').animate({ scrollTop: 0 }, 200);
		if(data['hasil'] == 'sukses'){
			window.setTimeout( function(){
				window.location = '<?php echo "$url_base/data-finish"; ?>';
			}, 1000);
		}
    });
 
    return false;
        });
});
</script>
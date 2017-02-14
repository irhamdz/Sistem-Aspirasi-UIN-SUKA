 <link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://static.uin-suka.ac.id/plugins/timepicker/js/bootstrap-timepicker.js"></script>
    <script type="text/javascript">
        $(document).ready(function () { 
            $('#jm,#js').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false,
                defaultTime: false
            });
        });
    </script>
	<style>
	.day{
		font-size:14px;
	}
	</style>
   <link href="http://static.uin-suka.ac.id/plugins/datepicker/css/datepicker.css" rel="stylesheet">

    <script src="http://static.uin-suka.ac.id/plugins/datepicker/js/bootstrap-datepicker.js"></script>
	<script>

		$(function(){
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = $('#dpd1').datepicker({
			format: 'dd/mm/yyyy',
          onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate());
            checkout.setValue(newDate);
          }
          checkin.hide();
		  
          $('#dpd2')[0].focus();
        }).data('datepicker');
        var checkout = $('#dpd2').datepicker({
			format: 'dd/mm/yyyy',
          onRender: function(date) {
            return date.valueOf() < checkin.date.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          checkout.hide();
        }).data('datepicker');
		
		$('#ruang').on('change',function(){
			var ruang=$('#ruang option:selected').val();
			if(ruang==""){
				$('#tempat').show();
				$('#tempat').focus();
			}else{
				$('#tempat').val($("#ruang option:selected").text());
				$('#tempat').hide();
			}
		});
		});
		
	</script>
	<style>
		#tempat{
			display:none;
		}
	</style>
<?php //echo $d->KD_RUANG ?>
<h2 style="margin-bottom:30px;">Agenda</h2>
 <form id="finput" name="finput" method="post" class=" form-horizontal" action="" enctype="multipart/form-data">
<div id="">
	<table name="tinput" id="tinput" class="table table-hover">
	<tbody><tr>
		<td class="col-md-2">Nama Agenda</td>
		<td>
		<input id="nama_agenda" name="nama_agenda" class="form-control input-md" type="text" value="<?php if(isset($d->NAMA_AGENDA)) echo $d->NAMA_AGENDA?>" />
		</td>
	  </tr>
	<tr>
		<td>Tanggal:</td>
		<td><input style="width:200px; display:inline-block" id="dpd1" name="tgl_mulai" class="form-control input-md" value="<?php if(isset($d->TGL_MULAI)) echo $d->TGL_MULAI ?>" type="text">
		 &nbsp;s.d&nbsp; <input style="width:200px; display:inline-block" id="dpd2" name="tgl_selesai" class="form-control input-md"  value="<?php if(isset($d->TGL_SELESAI)) echo $d->TGL_SELESAI ?>"type="text"></td>
	</tr>
	<tr>
		<td>Jam:</td>
		<td><div style="width:200px; display:inline-block" class="input-append bootstrap-timepicker">
				<input style="width:182px; display:inline-block" id="jm" name="jam_mulai" class="form-control input-md" value="<?php if(isset($d->JAM_MULAI)){ echo $d->JAM_MULAI; }else{ echo "08:00:00"; }?>" type="text"/><span class="add-on"><i class="icon-time"></i></span>
			</div> &nbsp;s.d&nbsp;&nbsp; <div style="width:240px; display:inline-block" class="input-append bootstrap-timepicker">
				<input style="width:182px; display:inline-block" id="js" name="jam_selesai" class="form-control input-md" value="<?php if(isset($d->JAM_SELESAI)){ echo $d->JAM_SELESAI; }else{ echo "08:00:00"; }?>"  type="text"/><span class="add-on"><i class="icon-time"></i></span>
			</div>
	</td>
       </tr>
	  <tr>
		<td>Tempat</td>
		<td>
			<select style="width:280px; display:inline-block" class="form-control" id="ruang" name="ruang">
			
			<?php foreach($ruang as $r):?>
				<?php if(isset($d->KD_RUANG) and $d->KD_RUANG==$r['KD_RUANG']){ ?>
				<option value="<?php echo $r['KD_RUANG'];?>" selected ><?php echo $r['NM_GEDUNG'].' '. $r['NM_RUANG'];?></option>
				<?php }else{?>
				<option value="<?php echo $r['KD_RUANG'];?>"><?php echo $r['NM_GEDUNG'].' '. $r['NM_RUANG'];?></option>
				<?php } ?>
			<?php endforeach;?>
			<?php if($d->KD_RUANG==NULL and $d->TEMPAT!=NULL){?>
			<option value="" selected>LAINNYA</option>
			<?php }else{?>
			<option value="" >LAINNYA</option>
			<?php } ?>
			</select>
			<?php
			if(!isset($d->KD_RUANG)){
			$KD_RUANG="";
			}else{
			$KD_RUANG=$d->KD_RUANG;
			}
			?>
			<?php if($KD_RUANG==NULL and isset($d->TEMPAT) and $d->TEMPAT!=NULL){?>
			<input style="width:300px; display:inline-block" type="text" class="form-control input-md" id="tempat" name="tempat" value="<?php  echo $d->TEMPAT ?>" />
			<?php }else{ ?>
			<input style="width:300px;" type="text" class="form-control input-md" id="tempat" name="tempat" value="" />
			<?php } ?>
		</td>
	  </tr>
	  <tr>
		<td class="">Lampiran</td>
		<td>
			<?php if(isset($d->FOTO)) echo $d->FOTO?>
			<input id="file" name="file"  type="file" />
		</td>
	  </tr>
	  <tr>
		<td colspan="2">
			<span> Deskripsi Agenda</span>
			<textarea name="deskripsi" id="text1" ><?php if(isset($d->DESKRIPSI)) echo $d->DESKRIPSI?></textarea>
			<?php echo display_ckeditor($ckeditor); ?>
		</td>
	  </tr>
	  <tr>
		<td class="">Sumber</td>
		<td><input id="sumber" name="sumber" class="form-control input-md" type="text" value="<?php if(isset($d->SUMBER)) echo $d->SUMBER?>"/></td>
	  </tr>
	  <tr>
		<td class=""></td>
		<td>
			<button type="submit" class="btn btn-inverse btn-uin btn-small">Simpan</button>
			<a href="<?php echo site_url('admin/berita')?>" class="btn btn-inverse btn-uin btn-small">Batal</button>
		</td>
	  </tr>
  </tbody>
  </table>
  </div>
  </form>
  
  

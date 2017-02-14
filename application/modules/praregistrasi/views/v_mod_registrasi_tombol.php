<div class='reg-kolom-kiri'>
<?php if($lokasi_sebelumnya){ ?>
<input onclick="tab_tujuan('<?php echo $lokasi_sebelumnya?>');return false;" class="btn btn-small btn-inverse btn-uin-right" id="btnSimpan" type="button" value="<< sebelumnya">
<!--
<a class="btn" onclick="tab_tujuan('<?php echo $lokasi_sebelumnya?>');return false;" href="#"><i class="icon-chevron-left"></i> Sebelumnya</a>
-->
<?php } ?>
</div>
<?php if($lokasi_selanjutnya){ ?>
<div class='reg-kolom-kanan'>
<input onclick="tab_tujuan('<?php echo $lokasi_selanjutnya?>');return false;" class="btn btn-small btn-inverse btn-uin" id="btnSimpan" type="button" value="selanjutnya >>">
</div>
<?php } ?>
<br class='ganjel'/>
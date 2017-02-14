<script type="text/javascript">
$(function () {
  $(document).ajaxStart(function () {
        $("#tbl-rekap").html("<span id='xxx' style='background-color: white; position: relative; z-index:1; text-align:center;'><center><img  src='http://pustaka.uin-suka.ac.id/asset/img/loading.gif'></img><br>Harap menunggu...</center></span>");
    });

  $(".perr").change(function() {
    id = $(this).attr('id');
    val = $(this).val();
    perr = $("#perr").val();
    berr = $("#berr").val();
    
    if(id == 'tarr'){
      $.ajax({
        type: 'POST',
        dataType: 'html',
        data : {op: id, kd:val,},
      })
      .done(function(x) {
        $("#berr").html(x);
        $("#perr").html('<option value="xx">Pilih Periode</option>');
        $("#tbl-rekap").html('');
      });
    }

   if(id == 'berr'){
      $.ajax({
      type: 'post',
      dataType: 'html',
      data: {op: id, kd: val},
      })
      .done(function(x) {
       $("#perr").html(x);
       $("#tbl-rekap").html('');
      }); 
    }
  if(id == 'perr'){
          $("#tbl-rekap").load("<?php echo $kd_menu;?>/"+perr);
      }
  });


});
</script> 
<table id="mn_periode" class="table table-hover">
  <tbody>
  <tr>
    <td class="col-md-2"><strong>Tahun</strong></td>
    <td>
    <select class="perr form-control col-md-3" id="tarr" style="margin-bottom:0px;">
    <?php echo $dd_ta; ?> 
    </select>
    </td>
  </tr>

  <tr>
    <td class="input-medium"><strong>Bulan </strong></td>
    <td>
    <select class="perr form-control col-md-4" id="berr" style="margin-bottom:0px;">
    <?php echo $dd_bulan; ?> 
    </select>
    </td>
  </tr>

   <tr>
    <td class="input-medium"><strong>Periode </strong></td>
    <td>
    <select class="perr form-control " id="perr" name="perr" style="margin-bottom:0px;">
    <?php echo $dd_periode; ?> 
    </select>
    </td>
  </tr>

  </tbody>
</table>
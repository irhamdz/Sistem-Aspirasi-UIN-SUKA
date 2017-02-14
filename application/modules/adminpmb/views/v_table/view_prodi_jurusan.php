<div>
<h3> Centang prodi tidak yang diijinkan. abaikan prodi yang tidak diijinkan</h3>
<br>
<?php
if(!is_null($data_prodi))
{
  foreach ($data_prodi as $prodi) 
  {
    echo "<strong><font id='".$prodi->id_prodi."'>".$prodi->nama_prodi.'</font></strong><br>';
 
     if(!is_null($data_jurusan))
    {
      foreach ($data_jurusan as $jur) 
      {
        echo "<input type='checkbox' ";
        if(!is_null($data_sarat))
        {
          foreach ($data_sarat as $dasar) {
            
            if(($dasar->id_prodi==$prodi->id_prodi) && ($dasar->id_jurusan_sekolah==$jur->id_jurusan_sekolah))
            {
              echo " checked ";
            }
            
          }
        }
        echo " onchange='kasih_sarat(this)' id='".$prodi->id_prodi.$jur->id_jurusan_sekolah."' isi='".$prodi->id_prodi."' value='".$jur->id_jurusan_sekolah."'>  ".$jur->nama_jurusan_sekolah.'   ';
      
        
      }
    }
    echo "<br>";
    echo "<hr>";
  }
}
?>
</div>
<script type="text/javascript">
 function kasih_sarat (kasar) {
   var prodi=$('#'+kasar.id).attr('isi');
   var elem=$('#'+kasar.id);
   
   if(elem.prop('checked'))
   {
    
        $.ajax({
        url: "<?php echo base_url('adminpmb/input_data_c/insert_prasyarat_jurusan'); ?>",
        type: "POST",
        data: "id_prodi="+prodi+"&id_jurusan_sekolah="+kasar.value+"&kode_minat="+minat,
        success: function(prasjur){
       
        }
        });

   }
   else
   {
        $.ajax({
        url: "<?php echo base_url('adminpmb/input_data_c/hapus_prasyarat_jurusan'); ?>",
        type: "POST",
        data: "id_prodi="+prodi+"&id_jurusan_sekolah="+kasar.value,
        success: function(prasjur){
       
        }
        });
   }
  
  

 }
</script>
<?php
$gf=array();
if(!is_null($data_grup))
{
  foreach ($data_grup as $dagrup) {
    array_push($gf, $dagrup->kode_grup_form);
    # code...
  }
}
?>


<?php
$fp=array();
if(!is_null($pilih_form))
{
  foreach ($pilih_form as $pilform) {
    # code...
    array_push($fp, $pilform->kode_form);
  }
}

?>
<div id="cekgrup">
  <form method="POST" id="set_grup_jalur">
    <?php
    if(!is_null($grup_form))
    {
      foreach ($grup_form as $grup) {
        
        echo "<input type='checkbox' onchange='change_grup(this)' ";   
       
       for($i=0; $i<count($gf); $i++)
       {
         
         if($gf[$i]==$grup->kode_grup_form)
         {
            echo " checked ";
         }
 
        }

         echo " id='".$grup->kode_grup_form."' value='".$grup->kode_grup_form."'> ";
         echo '<strong><u>'.strtoupper(str_replace('_',' ',$grup->label)).'</u></strong>';
         if(!is_null($grup->keterangan))
         {
           echo '  ( '.$grup->keterangan.' )';
         }

         echo '<br><br>';
        
         if(!is_null($form_item))
         {
          echo "<table>";
          foreach ($form_item as $item) 
          {
            if($grup->kode_grup_form==$item->kode_grup_form)
            {
              
              echo "<tr>";
              echo '<td>'.strtoupper(str_replace('_',' ',$item->label)).'</td>';
               echo "<td><input type='checkbox' onchange='change_form_item(this)' ";

               for($a=0; $a<count($fp); $a++)
               {
                if($fp[$a]==$item->kode_form)
                {
                  echo "checked";
                }
               }

               echo " id='".$grup->kode_grup_form.$item->kode_form."' isi='".$item->kode_form."' value='".$grup->kode_grup_form."'></td>";
               echo "</tr>";
            }
          }
          echo "</table>";
         }
         echo "<hr width='1'>";
       
        
      }
    }

    ?>
  </form>
</div>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>asset/crop/css/styles.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>asset/crop/css/jquery.Jcrop.css">
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Wellfleet">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url()?>asset/crop/js/jquery.Jcrop.js"></script>
  <script type="text/javascript" src="<?php echo base_url()?>asset/crop/js/cropsetup.js"></script>
 
<div id="admin-content">
  <div class="jc-box" >
  <div>
    <img src="<?php echo base_url('media/slide/'.$img['file_name'])?>" width="640" id="target" alt="[Jcrop Example]" />
    <br>
	</div>
	<div>
	<div id="preview-pane" style="display:block">
      <div class="preview-container">
        <img src="<?php echo base_url('media/slide/'.$img['file_name'])?>" class="jcrop-preview" alt="Preview" />
      </div>
    </div><!-- @end #preview-pane -->
    </div>
    <div id="form-container">
      <form id="cropimg" name="cropimg" method="post" action="" target="_blank">
			  <input type="hidden" id="crop" name="crop" value="crop"/>
			  <input type="hidden" id="filename" name="filename" value="<?php echo $img['file_name'] ?>"/>
			  <input type="hidden" id="x" name="x">
			  <input type="hidden" id="y" name="y">
			  <input type="hidden" id="w" name="w">
			  <input type="hidden" id="h" name="h">
			  <input type="submit" id="submit" value="Crop Image!">
      </form>
    </div><!-- @end #form-container -->
  </div><!-- @end .jc-demo-box -->
</div><!-- @end #wrapper -->
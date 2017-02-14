
<script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxdata.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxbuttons.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxscrollbar.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxdropdownlist.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxmenu.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxgrid.pager.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxgrid.sort.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxgrid.filter.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxgrid.columnsresize.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxgrid.selection.js"></script> 
	
<script type="text/javascript">
	$(document).ready(function () {
		// prepare the data
		var theme = getDemoTheme();
      
		var source =
		{
			datatype: "json",
			datafields: [
			{ name: 'no', type: 'string'},
			{ name: 'judul', type: 'string'},
			{ name: 'active', type: 'string' },
			{ name: 'image', type: 'string' },
			{ name: 'action', type: 'string' }
		],
		cache: false,
		url: "<?php echo site_url('admin/slide/slide_json')?>",
		filter: function()
		{
			// update the grid and send a request to the server.
			$("#jqxgrid").jqxGrid('updatebounddata', 'filter');
		},
		sort: function()
		{
			// update the grid and send a request to the server.
			$("#jqxgrid").jqxGrid('updatebounddata', 'sort');
		},
		root: 'Rows',
		beforeprocessing: function(data)
		{		
			if (data != null)
			{
				source.totalrecords = data[0].TotalRows;					
			}
		}
		};		
		var dataadapter = new $.jqx.dataAdapter(source, {
			loadError: function(xhr, status, error)
			{
				alert(error);
			}
		}
		);
	
		// initialize jqxGrid
		$("#jqxgrid").jqxGrid(
		{	
			width: 735,
			source: dataadapter,
			theme: 'bootstrap',
			filterable: true,
			sortable: true,
			autoheight: true,
			autorowheight: true,
			rowsheight: 40,
			pageable: true,
			virtualmode: true,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: 'No', datafield: 'no', width: 30 },
				{ text: 'Judul', datafield: 'judul', width: 500 },
				{ text: 'Aktif', datafield: 'active', width: 40 },
				{ text: 'Foto', datafield: 'image', width: 95 },
				{ text: 'Action', datafield: 'action', width: 70 }
			]
		});
		
		$("#jqxButton").jqxLinkButton({ width: '80', height: '25', theme: theme });
	});
</script>

<style type="text/css">
.ui-jqgrid tr.jqgrow td {vertical-align:middle !important}
</style>
	
<div id="content-admin">
	<h2>Slide</h2>


<?php 
$a=$this->session->flashdata('msg');
if($a!=null):?>
	<div class="msg_alert info">
		<?php echo $a ?>
	</div>
	
	<script type="text/javascript" charset="utf-8">
		$(function(){
			setTimeout('closing_msg()', 3000)
		})

		function closing_msg(){
			$(".msg_alert").slideUp();
		}
	</script>
<?php  endif;?>
<div style="text-align:right; margin-bottom:5px;">		
	 <a  href="<?php echo site_url('admin/slide/add')?>" id='jqxButton'>Tambah</a>
</div>	 
<div id="jqxgrid"></div>
</div>
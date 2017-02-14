<!DOCTYPE HTML>
<html>
    <head>
        <link href="http://code.jquery.com/ui/1.10.3/themes/cupertino/jquery-ui.css" type="text/css" rel="stylesheet"/>
        <link href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" rel="stylesheet"/>
        <link type="text/css" href="<?php echo base_url()?>asset/jqgrid/css/ui.jqgrid.css" rel="stylesheet" />
        <link type="text/css" href="<?php echo base_url()?>asset/jqgrid/css/jquery.searchFilter.css" rel="stylesheet" />

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" type="text/javascript"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>asset/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>asset/jqgrid/js/jquery.jqGrid.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>asset/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
 
 
 
        <title>Menampilkan Data Grid Dengan jQgrid Di CodeIgniter</title>
    </head>

    <body> <?php echo site_url('admin/jqgrid/tampil_data') ?>
        <script type="text/javascript">
            jQuery().ready(function (){
                jQuery("#daftardosen").jqGrid({
                    url:'<?php echo site_url('admin/jqgrid/tampil_data')?>',
                    mtype : "post",
                    datatype: "json",
                    colNames:['No','Action','Kode Dosen','NIDN','Nama Dosen'], 
                    colModel:[
                        {name:'nomor',index:'nomor', width:10, align:"center"},
					{name:'aksi', index:'aksi', width:20 },
                        {name:'kode_dosen',index:'kode_dosen', width:15, align:"center",editable:true, },
                        {name:'nidn',index:'nidn', width:10, align:"center",editable:true},
                        {name:'nama_dosen',index:'nama_dosen', width:40, align:"center",editable:true},
                    ],
					ondblClickRow: function(rowid) {
					alert(rowid);
						jQuery(this).jqGrid('editGridRow', rowid);
					},
					gridComplete: function(rowid) {
						var grid = jQuery("#daftardosen");
						var ids = grid.jqGrid('getDataIDs');
						for (var i = 0; i <= ids.length; i++) {
							var rowId = ids[i];
							var checkOut = "<a href='#' onclick=\"alert("+rowId+")\">"+rowId+"</a>";
							grid.jqGrid('setRowData', rowId, { aksi: checkOut });
						}
					},
                    rowNum:10,
                    width: 800,
                    height: 300,
                    rowList:[10,20,30,40,50,60,70],
                    pager: '#pager1',
                    sortname: 'kode_dosen',
                    viewrecords: true,
					editurl:"<?php echo site_url('admin/jqgrid/edit')?>",
                    caption:"Daftar Nama-Nama Dosen di Kampus Ane"
                }).navGrid('#pager1',{edit:true,add:true,del:true});
				

            });
							
        </script>
 <a href='#' class='delete'>Hapus</a>
        <table id="daftardosen"></table>
        <div id="pager1"></div>
    </body>


/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
CKEDITOR.editorConfig = function( config )    
{
   config.filebrowserBrowseUrl = '/asset/kcfinder/browse.php?type=files';
   config.filebrowserImageBrowseUrl = '/asset/kcfinder/browse.php?type=images';
   config.filebrowserFlashBrowseUrl = '/asset/kcfinder/browse.php?type=flash';
   config.filebrowserUploadUrl = '/asset/kcfinder/upload.php?type=files';
   config.filebrowserImageUploadUrl = '/asset/kcfinder/upload.php?type=images';
   config.filebrowserFlashUploadUrl = '/asset/kcfinder/upload.php?type=flash'
};

CKEDITOR.replace( 'textarea_id', {
	toolbar: [
		{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
		[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
		'/',																					// Line break - next group will be placed in new line.
		{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
	]
});
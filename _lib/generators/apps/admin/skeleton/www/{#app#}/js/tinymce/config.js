	// Tiny Editor
	tinyMCE.init({
		mode: 								"textareas",
		editor_selector:					"editor-tiny",   
		language: 							"fr",
		theme:  							"advanced",
		skin:  								"custom",
		content_css :						"editor.css",

		theme_advanced_toolbar_location:  	"top",
		theme_advanced_toolbar_align: 		"left",
		theme_advanced_statusbar_location:  "bottom",
	//	theme_advanced_resizing:  			true,

		theme_advanced_buttons1:  			"bold,italic,underline,|,link,unlink,|,undo,redo",
		theme_advanced_buttons2:  			"",
		theme_advanced_buttons3:  			"",
		
		apply_source_formatting:  			true,

		inlinepopups_skin: 					"custom",
		
		plugins:							"inlinepopups,wordcount"
	});
	
	// Simple Editor
	tinyMCE.init({
		mode: 								"textareas",
		editor_selector:					"editor-simple",   
		language: 							"fr",
		theme:  							"advanced",
		skin:  								"custom",
		content_css :						"editor.css",
		
		theme_advanced_toolbar_location:  	"top",
		theme_advanced_toolbar_align: 		"left",
		theme_advanced_statusbar_location:  "bottom",
	//	theme_advanced_resizing:  			true,

		theme_advanced_buttons1:  			"bold,italic,underline,|,styleselect|,link,unlink,image,|,undo,redo,|,charmap,|,removeformat,code",
		theme_advanced_buttons2:  			"",
		theme_advanced_buttons3: 			"",
		theme_advanced_blockformats:  		"h1,h2,h3,h4,h5,h6,p,pre",
		
		apply_source_formatting:  			true,

		inlinepopups_skin: 					"custom",
		plugins: 							"library,fullscreen,visualchars,inlinepopups,wordcount"
	});
	
	// Editor
	tinyMCE.init({
		mode: 								"textareas",
		editor_selector:					"editor",    
		language: 							"fr",
		theme:  							"advanced",
		skin:  								"custom",
		content_css :						"editor.css",
		
		theme_advanced_toolbar_location:  	"top",
		theme_advanced_toolbar_align: 		"left",
		theme_advanced_statusbar_location:  "bottom",
	//	theme_advanced_resizing:  			true,

		theme_advanced_path:  				true,
		theme_advanced_buttons1:  			"bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect",
		theme_advanced_buttons2:  			"bullist,numlist,|,link,unlink,image,|,search,replace,|,undo,redo",
		theme_advanced_buttons3:  			"charmap,|,removeformat,code,|,fullscreen,library",
		theme_advanced_blockformats:  		"h1,h2,h3,h4,h5,h6,p,pre",

		inlinepopups_skin: 					"custom",
		plugins: 							"library,fullscreen,searchreplace,visualchars,inlinepopups,wordcount"
	});

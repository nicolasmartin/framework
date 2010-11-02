(function() {
	tinymce.create('tinymce.plugins.LibraryPlugin', {
		init : function(ed, url) {
			this.editor = ed;

			// Register commands
			ed.addCommand('libraryCommand', function() {
				var se = ed.selection;

/*				if (se.isCollapsed()) {
					return;
				}*/
				
				ed.windowManager.open({
					file : url + '/window.php',
					width : 480,
					height : 600,
					inline : 1
				}, {
					plugin_url : url
				});
				

			});

			// Register buttons
			ed.addButton('library', {
				title : "Librairie d'image",
				cmd : 'libraryCommand'
			});
		},

		getInfo : function() {
			return {
				longname : 	'Plugin',
				author : 	'Jay Salvat',
				authorurl : 'http://jaysalvat.com',
				infourl : 	'http://jaysalvat.com',
				version : 	'0.1'
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('library', tinymce.plugins.LibraryPlugin);
})();
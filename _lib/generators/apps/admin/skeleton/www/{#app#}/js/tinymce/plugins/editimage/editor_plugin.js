
(function() {
	tinymce.create('tinymce.plugins.EditImage', {

		init : function(ed, url) {
			var t = this;

			t.url = url;
			t._createButtons();

			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('...');
			ed.addCommand('editImage', function() {
				var el 	= ed.selection.getNode(), 
					vp 	= tinymce.DOM.getViewPort(), 
					H 	= vp.h, 
					W 	= ( 720 < vp.w ) ? 720 : vp.w, 
					cls = ed.dom.getAttrib(el, 'class');

				if ( cls.indexOf('mceItem') != -1 || el.nodeName != 'IMG' ) {
					return;
				}

				alert('edit image');
			});

/*			ed.onInit.add(function(ed) {
				tinymce.dom.Event.add(ed.getBody(), 'dragstart', function(e) {
					if ( !tinymce.isGecko && e.target.nodeName == 'IMG' && ed.dom.getParent(e.target, 'dl.wp-caption') )
						return tinymce.dom.Event.cancel(e);
				});
			});
*/
			ed.onMouseUp.add(function(ed, e) {
				if ( tinymce.isWebKit || tinymce.isOpera )
					return;

				if ( ed.dom.getParent(e.target, 'div.mceTemp') || ed.dom.is(e.target, 'div.mceTemp') ) {					
					window.setTimeout(function(){
						var ed = tinyMCE.activeEditor, n = ed.selection.getNode(), DL = ed.dom.getParent(n, 'dl.wp-caption');

						if ( DL && n.width != ( parseInt(ed.dom.getStyle(DL, 'width'), 10) - 10 ) ) {
							ed.dom.setStyle(DL, 'width', parseInt(n.width, 10) + 10);
							ed.execCommand('mceRepaint');
						}
					}, 100);
				}
			});

			ed.onMouseDown.add(function(ed, e) {
				var p;

				if ( e.target.nodeName == 'IMG' && ed.dom.getAttrib(e.target, 'class').indexOf('mceItem') == -1 ) {
					ed.plugins.wordpress._showButtons(e.target, 'wp_editbtns');
					if ( tinymce.isGecko && (p = ed.dom.getParent(e.target, 'dl.wp-caption')) && ed.dom.hasClass(p.parentNode, 'mceTemp') )
						ed.selection.select(p.parentNode);
				}
			});

			ed.onKeyPress.add(function(ed, e) {
				var DL, DIV, P;

				if ( e.keyCode == 13 && (DL = ed.dom.getParent(ed.selection.getNode(), 'DL')) && ed.dom.hasClass(DL, 'wp-caption') ) {
					P = ed.dom.create('p', {}, '&nbsp;');
					if ( (DIV = DL.parentNode) && DIV.nodeName == 'DIV' ) 
						ed.dom.insertAfter( P, DIV );
					else
						ed.dom.insertAfter( P, DL );

					if ( P.firstChild )
						ed.selection.select(P.firstChild);
					else
						ed.selection.select(P);

					tinymce.dom.Event.cancel(e);
					return false;
				}
			});
		},

		_createButtons : function() {
			var t = this, ed = tinyMCE.activeEditor, DOM = tinymce.DOM, editButton, dellButton;

			DOM.remove('wp_editbtns');

			DOM.add(document.body, 'div', {
				id : 'wp_editbtns',
				style : 'display:none;'
			});

			editButton = DOM.add('wp_editbtns', 'img', {
				src : t.url+'/img/image.png',
				id : 'wp_editimgbtn',
				width : '24',
				height : '24',
				title : ed.getLang('wpeditimage.edit_img')
			});

			tinymce.dom.Event.add(editButton, 'mousedown', function(e) {
				var ed = tinyMCE.activeEditor;
				ed.windowManager.bookmark = ed.selection.getBookmark('simple');
				ed.execCommand("WP_EditImage");
			});

			dellButton = DOM.add('wp_editbtns', 'img', {
				src : t.url+'/img/delete.png',
				id : 'wp_delimgbtn',
				width : '24',
				height : '24',
				title : ed.getLang('wpeditimage.del_img')
			});

			tinymce.dom.Event.add(dellButton, 'mousedown', function(e) {
				var ed = tinyMCE.activeEditor, el = ed.selection.getNode(), p;

				if ( el.nodeName == 'IMG' && ed.dom.getAttrib(el, 'class').indexOf('mceItem') == -1 ) {
					if ( (p = ed.dom.getParent(el, 'div')) && ed.dom.hasClass(p, 'mceTemp') )
						ed.dom.remove(p);
					else if ( (p = ed.dom.getParent(el, 'A')) && p.childNodes.length == 1 )
						ed.dom.remove(p);
					else
						ed.dom.remove(el);

					ed.execCommand('mceRepaint');
					return false;
				}
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

	tinymce.PluginManager.add('editimage', tinymce.plugins.EditImage);
})();

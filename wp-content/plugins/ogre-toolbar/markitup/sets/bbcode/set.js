// ----------------------------------------------------------------------------
// markItUp!
// ----------------------------------------------------------------------------
// Copyright (C) 2008 Jay Salvat
// http://markitup.jaysalvat.com/
// ----------------------------------------------------------------------------
// BBCode tags example
// http://en.wikipedia.org/wiki/Bbcode
// ----------------------------------------------------------------------------
// Feel free to add more tags
// ----------------------------------------------------------------------------
myBBCodeSettings =
{
	nameSpace: "bbcode",
	previewParserPath:	'', // path to your BBCode parser
	markupSet: [
		{name:'Gras', key:'B', openWith:'[b]', closeWith:'[/b]'},
		{name:'Italique', key:'I', openWith:'[i]', closeWith:'[/i]'},
		{name:'Souligné', key:'U', openWith:'[u]', closeWith:'[/u]'},
		{separator:'---------------' },
		{name:'Image', key:'P', replaceWith:'[img][![Url]!][/img]'},
		{name:'Lien', key:'L', openWith:'[url=[![Url]!]]', closeWith:'[/url]', placeHolder:'Your text to link here...'},
		{separator:'---------------' },
		{name:'Citation', openWith:'[quote]', closeWith:'[/quote]'},
		{name:'Code', openWith:'[code]', closeWith:'[/code]'}, 
		{separator:'---------------' },
		{name:'Clean', className:"clean", replaceWith:function(markitup) { return markitup.selection.replace(/\[(.*?)\]/g, "") } },
		{name:'Preview', className:"preview", call:'preview' }
	],
	resizeHandle: false
}
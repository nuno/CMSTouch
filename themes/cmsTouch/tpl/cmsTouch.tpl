<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
{* DNS Speed*}
<link rel="dns-prefetch" href="//code.jquery.com">
<link rel="dns-prefetch" href="//ajax.googleapis.com">

<meta name="viewport" content="width=device-width, initial-scale="1""> 
<link rel="apple-touch-icon" type="image/png" href="{$module_url_path}/themes/cmsTouch/icons/cmstouchGrey.png" />

<title>{sitename} - {title}</title>

{* jQueryMobile build - 2011-05-27 *}
<link href="{$module_url_path}/themes/cmsTouch/jqm/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
<script src="{$module_url_path}/themes/cmsTouch/js/global.js"></script>
<script src="{$module_url_path}/themes/cmsTouch/jqm/jquery.mobile.min.js"></script>

{* jQueryMobile build *}
{*
<link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
<script src="{$module_url_path}/themes/cmsTouch/js/global.js"></script>
<script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>
*}
<base href="{root_url}/">
{literal}
<script>
/*your scripts, or overrides*/
</script>
<style>
.search label,
.search .hidden{
    text-indent: -999%;
    visibility:hidden;
    height: 0;
    width: 0;
}
</style>
{/literal}
</head> 
<body>
<div data-role="page" data-theme="a" id="{if $page_alias ne ""}{$page_alias}{else}home{/if}">
	<div data-role="header">
	    <a href="#home" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-left">Home</a>
		  <h1 class="ui-title">{title}</h1>
      <a href="#menu" data-icon="grid" data-rel="dialog" data-iconpos="notext" data-transition="slidedown" class="ui-btn-right">Menu</a>
	</div>
  <div data-role="content">
   <div class="search" data-role="fieldcontain">{search}</div>
   <div id="cmscontent">
       {content}
     {*<div class="menu">{menu template='minimal_menu.tpl' loadprops="0"}</div>*} 
    </div><!-- /cmscontent-->

</div><!-- /content-->

</div><!-- /page-->

<div data-role="page" id="menu"> 
 
    <div data-role="header"> 
        <h2>MENU</h2> 
    </div><!-- /header --> 
 
    <div data-role="content">   
    <div id="cmscontent"> 
    <div class="menu">
    {menu template='minimal_menu.tpl' loadprops="0" number_of_levels="1"}
    </div>  
    
    </div>
    </div><!-- /content --> 
 
   
</div><!-- /page -->
{*  Put your google ID  *}  
{literal}
<script type="text/javascript">
/*
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-foo']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
	*/
</script>
{/literal}
</body>
</html>
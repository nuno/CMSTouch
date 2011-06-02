<?php

$lang["friendlyname"]="CMS Touch module";
$lang["installed"]="CMS Touch module was succesfully installed";
$lang["uninstalled"]="CMS Touch module was succesfully uninstalled, all the cache is now clean!";
$lang["moddescription"]="This module allows for some template magic based on the current UserAgent of the visitor";
$lang["settings"]="Settings";
$lang["postinstall"]="CMS Touch module was succesfully installed";
$lang["postuninstall"]="CMS Touch module was succesfully uninstalled, all the cache is now clean!";
$lang["savesettings"]="Save settings";
$lang["settingssaved"]="Settings saved";
$lang["autoprocess"]="Always do CMSTouch-processing";
$lang["autoprocesshelp"]="Active CMSTouch Processing";
$lang["useragents"]="User agents";

$lang["config_warning"]="Please note that this module will not work without the config-parameter being 'process_whole_template' set to true. Please fix this or ask your system administrator.";
#$lang["cachedpages_warning"]="Please not that you have active pages with caching turned on, but no cache control. Accessing these pages with a Touch-device may not give the experience you expect.";

$lang["uaactive"]="Active";
$lang["uaname"]="Name";
$lang["uatemplate"]="Template";
$lang["uaactions"]="Actions";
$lang["newua"]="Add useragent";
$lang["uaexists"]="User agent already exists";

$lang["theme"]="Theme";

$lang["defaulttouchtemplate"]="Default touch template";
$lang["defaulttemplate"]="Default template";

$lang["deleteua"]="Delete this useragent: %s";
$lang["uadeleted"]="The useragent was deleted";
$lang["confirmdeleteua"]="Are you sure this useragent, %s, should be deleted?";

$lang["preview"]="Preview";
$lang["livepreview"]="Live preview";
$lang["livepreviewhelp"]="Show a live preview instead of the static one. Please note that rendering quality may vary, and this is unfortunately now available in Internet Explorer.";
$lang["ielivepreview"]="Sorry, live preview is not available in Internet Explorer";
$lang["livepreviewwarning"]="Please remember that this live preview may not look exactly like when rendered on a Touch-device. Only use for a quick reference.";

$lang["statistics"]="Statistics";
$lang["resetstatistics"]="Reset statistics";
$lang["statisticsreset"]="Statistics reset";
$lang["confirmresetstatistics"]="Are you sure statistics should be reset?";

$lang["statmatches"]="User Agent Matches";
$lang["statnonmatches"]="User Agent Didn't match";
$lang["statuamatches"]="Matches for individual User Agent";

$lang["updateavailable"]="There is a new version available";

#$lang["cachecontrol"]="Cache control";
#$lang["cachedonothing"]="Do not handle cache, I have turned caching off on the pages themselves";
#$lang["cachesmarty"]="Make Smarty handle the touch-templates (works with only one touch-template)";
#$lang["cacheforceclear"]="Force clearing of the cache each time a new UserAgent is matched (works with multiple touch-tempalte, but can be a bit slower)";
#$lang["cachedisable"]="Automatically keep the cachable-option of all pages turned off (please note, this alters the actual settings for your pages)";

$lang["defaulttouchtemplate"]="Default touch template";
$lang["accessdenied"]=" accessdenied ";
#### HELP
$lang["help"]="
<p><a href='../modules/CMSTouch/docs/index.html' >Please see some help here:</a> or <a target='_blank' href='http://criacaoweb.net/project/cmstouch/' >More Documentation soon at http://criacaoweb.net/project/cmstouch/ </a></p>
<p>You need to 'Set'  process_whole_template = true  in config.php</p>";
?>
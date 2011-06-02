<?php
# CMSTouch Project. A module for CMS Made Simple to run also on Iphone and others smartphones.
# Copyright (c) 2011 by Nuno Costa <nuno@criacaoweb.net>
# I want thank Morten <morten@poulsen.org> for his help and code on the beginning of this module.
#
#CMS - CMS Made Simple
#(c)2004 by Ted Kulp (wishy@users.sf.net)
#This project's homepage is: http://cmsmadesimple.sf.net
#
#This program is free software; you can redistribute it and/or modify
#it under the terms of the GNU General Public License as published by
#the Free Software Foundation; either version 2 of the License, or
#(at your option) any later version.
#
#This program is distributed in the hope that it will be useful,
#but WITHOUT ANY WARRANTY; without even the implied warranty of
#MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#GNU General Public License for more details.
#You should have received a copy of the GNU General Public License
#along with this program; if not, write to the Free Software
#Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

if (!is_object(cmsms())) exit;

if (! $this->CheckPermission('Use CMSTouch')) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}

if ($this->GetPreference("cachecontrol","nothing") == "disable") {
	$this->DisableCacheForPages();
}

$config = cmsms()->GetConfig();

if (!$config["process_whole_template"]) {
	echo $this->ShowErrors($this->Lang("config_warning"));
}
/*
 * //TODO  maybe remove this?
if ($this->GetPreference("cachecontrol", "nothing") == "nothing") {
	if ($this->CachedPagesExist()) {
	    
	  //echo $this->ShowErrors($this->Lang("cachedpages_warning"));
	}
}
*/
$tab = "settings";
if (isset($params["tab"])) $tab=$params["tab"];

//echo $this->ProcessTemplate('admin_ct_all.tpl');

echo $this->StartTabHeaders();

echo $this->SetTabHeader("settings",$this->Lang("settings"), ($tab=="settings"));
//echo $this->SetTabHeader("preview",$this->Lang("preview"), ($tab=="preview"));
echo $this->SetTabHeader("statistics",$this->Lang("statistics"), ($tab=="statistics"));



echo $this->EndTabHeaders();
echo $this->StartTabContent();

echo $this->StartTab("settings");

include(dirname(__FILE__)."/function.settingstab.php");

echo $this->EndTab();

//echo $this->StartTab("preview");

//include(dirname(__FILE__)."/function.previewtab.php");

//echo $this->EndTab();


echo $this->StartTab("statistics");

include(dirname(__FILE__)."/function.statisticstab.php");

echo $this->EndTab();


echo $this->EndTabContent();

?>
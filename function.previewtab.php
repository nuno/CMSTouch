<?php
# CMSTouch Project. A module for CMS Made Simple to run also on Iphone and others smartphones.
# Copyright (c) 20010 by Nuno Costa <nuno@criacaoweb.net>
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

if (!isset($gCms)) exit;

if (! $this->CheckPermission('Use CMSTouch')) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}
$config = $gCms->GetConfig();

$forcestatic = false;
  
if (preg_match("/msie/i",$_SERVER['HTTP_USER_AGENT']))
{
	echo "<strong>".$this->Lang("ielivepreview")."</strong><br/>";
	$forcestatic = true;
}
			

if ($this->GetPreference("livepreview", 0) == 1 && !$forcestatic) {
  $this->smarty->assign('rooturl', $config["root_url"]);
	$this->smarty->assign('livepreviewwarning', $this->Lang("livepreviewwarning"));
  echo $this->ProcessTemplate('livepreview.tpl');
} else {
	if (file_exists($config["root_url"]."/modules/CMSTouch/themes/".$this->GetPreference("defaulttouchtemplage","cmsTouch")."/icons/cmsTouchScreen.png")) {
	  $this->smarty->assign('previewimage', $config["root_url"]."/modules/CMSTouch/themes/".$this->GetPreference("defaulttouchtemplage","cmsTouch")."/icons/cmsTouchScreen.png");
	} else {
    $this->smarty->assign('previewimage', $config["root_url"]."/modules/CMSTouch/img/cmsTouchScreen.png");
	}
  echo $this->ProcessTemplate('preview.tpl');
}


?>

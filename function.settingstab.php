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

if (!is_object(cmsms())) exit;

if (! $this->CheckPermission('Use CMSTouch')) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}

$themeObject = cmsms()->variables['admintheme'];

$this->smarty->assign('formstart', $this->CreateFormStart($id,"savesettings"));
$this->smarty->assign('formend', $this->CreateFormEnd());
$this->smarty->assign('submit',$this->CreateInputSubmit($id,"savesettings",$this->Lang("savesettings")));

$this->smarty->assign('autoprocess', $this->Lang("autoprocess"));
$this->smarty->assign('autoprocesshelp', $this->Lang("autoprocesshelp"));
$this->smarty->assign('autoprocessinput',$this->CreateInputCheckbox($id,"autoprocess","1",$this->GetPreference("autoprocess","0")));

$this->smarty->assign('useragents', $this->Lang("useragents"));

$uainput = array();
$this->smarty->assign('useragentsinput',$this->CreateTextarea(false,$id,$this->GetPreference("useragents"),"useragents","","","","","40","10"));

$templatelist =$this->GetFullTemplateList();
$templatelist = array_merge(array($this->Lang("defaulttouchtemplate")=>"defaulttouchtemplate",$this->Lang("defaulttemplate")=>"defaulttemplate"),$templatelist);
$uas = $this->GetUAList();
foreach($uas as $ua=>$uatpl) {
	
  $onerow = new stdClass();
  $uaactive = ($ua[0]!="#");
  $onerow->uaname = str_replace("#","",$ua);
  $onerow->activeinput = $this->CreateInputCheckbox($id, $onerow->uaname."_active", "1", $uaactive);
  
  $onerow->templateinput = $this->CreateInputDropdown($id, $onerow->uaname."_template",$templatelist,-1,$uatpl);
  $onerow->deleteicon = $this->CreateLink($id, "savesettings", "",
          $themeObject->DisplayImage('icons/system/delete.gif', $this->Lang("deleteua", $onerow->uaname),'','','systemicon'),
          array("todo"=>"deleteua","ua"=>$onerow->uaname),
          $this->Lang("confirmdeleteua",
                  $onerow->uaname));

  $uainput[] = $onerow;
}

$this->smarty->assign_by_ref('uainput',$uainput);



$this->smarty->assign("uaactive", $this->Lang("uaactive"));
$this->smarty->assign("uaname", $this->Lang("uaname"));
$this->smarty->assign("uatemplate", $this->Lang("uatemplate"));
$this->smarty->assign("uaactions", $this->Lang("uaactions"));
$this->smarty->assign("newua", $this->Lang("newua"));

$this->smarty->assign('newuanameinput', $this->CreateInputText($id, "newuaname", ""));
$this->smarty->assign('newuatemplateinput', $this->CreateInputDropdown($id, "newuatemplate", $templatelist,"","defaulttouchtemplate"));

$cachecontroloptions = array(
		$this->Lang("cachedonothing")=>"nothing",
		/*$this->Lang("cachesmarty")=>"smarty",*/
		$this->Lang("cachedisable")=>"disable",
		$this->Lang("cacheforceclear")=>"forceclear"
);

$this->smarty->assign("cachecontrol", $this->Lang("cachecontrol"));
$this->smarty->assign("cachecontrolinput", $this->CreateInputRadioGroup($id, "cachecontrol", $cachecontroloptions, $this->GetPreference("cachecontrol","nothing"),"","<br/>"));
/*$this->smarty->assign('adduseragent', $this->Lang("adduseragent"));
$this->smarty->assign('defaulttouchtemplateinput',$this->CreateInputDropdown($id,"defaulttouchtemplate",$this->GetFullTemplateList(),$this->GetPreference("defaulttouchtemplate", "cmsTouch")));
*/
//$this->smarty->assign('allowedtemplates', $allowedtemplates);

$this->smarty->assign('defaulttouchtemplate', $this->Lang("defaulttouchtemplate"));
$this->smarty->assign('defaulttouchtemplateinput',$this->CreateInputDropdown($id,"defaulttouchtemplate",$templatelist,-1,$this->GetPreference("defaulttouchtemplate", "cmsTouch"/*$this->GetDefaultTemplate()*/)));

$this->smarty->assign('livepreviewtext', $this->Lang("livepreview"));
$this->smarty->assign('livepreviewhelp', $this->Lang("livepreviewhelp"));
$this->smarty->assign('livepreviewinput',$this->CreateInputCheckbox($id,"livepreview","1",$this->GetPreference("livepreview","0")));

echo $this->ProcessTemplate('settings.tpl');

?>

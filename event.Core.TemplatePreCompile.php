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

if( !isset($gCms) ) exit;

$template = $params["template"];

if ($this->GetPreference("autoprocess","0")!="1") {
  if (!preg_match("/{CMSTouch}/i",$template)) {
    //die( "not active!");
    return;
  }
}

if ($this->GetPreference("cachecontrol","nothing") == "disable") {
	$this->DisableCacheForPages();
}


$thisuseragent = $_SERVER['HTTP_USER_AGENT'];

$matchone = false;

$useragents = $this->GetUAList();

foreach($useragents as $useragent=>$uatemplate) {
  $useragent  = trim($useragent);
  $uatemplate = trim($uatemplate);
  

  if (preg_match("/$useragent/i", $thisuseragent))
  {
    if (trim($uatemplate)=="defaulttouchtemplate")
	{
      $uatemplate = $this->GetPreference("defaulttouchtemplate", "cmsTouch");
			//echo $uatemplate;
    }
    $uatemplate = trim($uatemplate);
    $newtemplate=false;
    //echo $config["root_path"]."/".$uatemplate;
    //die();

   
	  /* First option is a named CMSTouch-theme */
    if (file_exists(dirname(__FILE__)."/themes/".$uatemplate."/tpl/".$uatemplate.".tpl"))
  	{
      //echo dirname(__FILE__)."/themes/".$uatemplate."/tpl/".$uatemplate.".tpl";
      $newtemplate = file_get_contents(dirname(__FILE__)."/themes/".$uatemplate."/tpl/".$uatemplate.".tpl");

    /* Second option is a cmsms-template */
    } else {
      $newtemplate = $this->GetTemplateContent(trim($uatemplate));
    }

    /* Something went wrong! uhmm, shall I active the default template here, or is better the menssage? */
    if (!$newtemplate) {
      echo "Error fetching template content";
      die();
    }
    $template = $newtemplate;
    $matchone = true;
    $matches = $this->GetPreference("touchmatches",0);
    $this->SetPreference("touchmatches",$matches+1);

    $uamatches = $this->GetPreference($useragent."_matches",0);
    $this->SetPreference($useragent."_matches",$uamatches+1);
    break;
  }
}

if (!$matchone) {
  $nonmatches = $this->GetPreference("touchnonmatches",0);
  $this->SetPreference("touchnonmatches",$nonmatches+1);
}

$params["template"] = $template;

?>
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

if (!is_object(cmsms())  || !$this->VisibleToAdminUser()) {
  echo $this->Lang("accessdenied");
  return;
}

$errors="";

if (isset($params["todo"]) && $params["todo"]=="deleteua") {
  $ualist="";
  if (isset($params["ua"])) {
    
    $uas=$this->GetUAList();
    foreach($uas as $ua=>$uatpl) {
      if ($ua!=$params["ua"] && $ua!=("#".$params["ua"])) {
        $ualist.=($ua."|".$uatpl."\n");
      }
    }
    //echo $params["ua"];
    //print_r($ualist);
    //die();
    $this->SetPreference("useragents", $ualist);
    $this->Redirect($id, 'defaultadmin', $returnid,array("module_message"=>$this->Lang("uadeleted")));
  }
}

//print_r($params);die();
$ualist="";
$uas = $this->GetUAList();

foreach($uas as $ua=>$uatpl) {
  //echo $params[$ua."_active"];
  $uaactive=true;
  $uaname=str_replace("#","",$ua);
  if (!isset($params[$uaname."_active"])) {
    $uaactive=false;
  }
  
  if (isset($params[$uaname."_template"])) {
    //echo $ua.$params[$ua."_template"];
    $ua=str_replace("#","",$ua);
    if (!$uaactive) $ualist.="#";
    $ualist.=$ua."|";
    $ualist.=$params[$ua."_template"];
    $ualist.="\n";
  }
}
//print_r($ualist); die();

if (isset($params["newuaname"]) && isset($params["newuatemplate"])) {
  if ($params["newuaname"]!="") {
        
    $uaexists = false;
    foreach($uas as $ua=>$uatpl) {
      if (strtolower($ua)==strtolower(trim($params["newuaname"]))) {
        $uaexists=true; break;
      }
    }
    if ($uaexists) {
      $errors.=$this->Lang("uaexists");
    } else {
      $ualist.=$params["newuaname"]."|";
      $ualist.=$params["newuatemplate"];
      $ualist.="\n";
    }
  }
}

$this->SetPreference("useragents", $ualist);


if (isset($params["autoprocess"]) && $params["autoprocess"] == 1) {
  $this->SetPreference("autoprocess","1");
} else {
  $this->SetPreference("autoprocess","0");
}
/*
if (isset($params["livepreview"])) {
  $this->SetPreference("livepreview","1");
} else {
  $this->SetPreference("livepreview","0");
}

if (isset($params["cachecontrol"])) $this->SetPreference("cachecontrol",$params["cachecontrol"]);
*/
if (isset($params["defaulttouchtemplate"])) $this->SetPreference("defaulttouchtemplate",$params["defaulttouchtemplate"]);

$this->Redirect($id, 'defaultadmin', $returnid,array("module_error"=>$errors,"module_message"=>$this->Lang("settingssaved")));
?>
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
#
#$Id: CMSTouch.module.php 145 2011-05-20 19:48:16Z nuno $: 
#

class CMSTouch extends CMSModule { 

  public function __construct()
  {
    parent::__construct();
    $smarty = cms_utils::get_smarty();
    $this->check_compiler();
    $smarty->assign('module_url_path',$this->GetModuleURLPath());
    $smarty->assign('module_root_path',$this->GetModulePath());
    }  


  function GetName()  {
    return 'CMSTouch';
  }

  function GetFriendlyName() {
		return $this->Lang('friendlyname');
	}
    
  function AllowAutoInstall() {
		return false;
  }

  function AllowAutoUpgrade() {
		return false;
  }
  
  function IsPluginModule() {
    return false;
  }

  function HasAdmin() {
    return true;
  }
  
  function MinimumCMSVersion() {
    return '1.9.4.1';
  }
  function GetVersion() {
    return '1.0.1-b1';
  }

	function GetAdminSection() {
		return 'layout';
	}

	function GetAdminDescription() {
		return $this->Lang('moddescription');
	}

  function InstallPostMessage() {
    return $this->Lang("postinstall");
  }

  function UninstallPostMessage() {
    return $this->Lang("postuninstall");
  }
  
  function VisibleToAdminUser() {
    return $this->CheckPermission('Use CMSTouch');
  }

  function HandlesEvents () {
    return true;
  }

	function SetParameters() {
		$this->RestrictUnknownParams();
		$this->RegisterModulePlugin();
	}

  function GetHelp($lang = 'en_US') {
  	return $this->Lang("help");
  }

  function GetAuthor() {
    return 'Nuno Costa, Morten';
  }

  function GetAuthorEmail() {
    return 'nuno@criacaoweb.net';
  }

  function GetChangeLog() {
    return $this->ProcessTemplate('changelog.tpl');
  }

/** 
 *
 *@return Files in Header CSS, JS on Admin-side
 */
  function GetHeaderHTML(){
    return $this->ProcessTemplate('admin_ct_headers.tpl');
  }

  function GetFullTemplateList() {
    return array_merge($this->GetThemeList(), $this->GetTemplateList());    
  }

  function GetTemplateList() {
    $db = cms_utils::get_db();
    $q = "SELECT template_name FROM ".cms_db_prefix()."templates";
    $p = array();
    $dbresult = $db->Execute($q, $p);
    $templatelist=array();
    
    while($dbresult && $row = $dbresult->FetchRow())
    {
      $templatelist[$row["template_name"]]=$row["template_name"];
    }
		return $templatelist;   
  }
  
  function GetDefaultTemplate()
  {
    $db = cms_utils::get_db();
    $q = "SELECT template_name FROM ".cms_db_prefix()."templates WHERE default_template = ?";
    $p = array(1);
    $dbresult = $db->Execute($q, $p);
    if (!$dbresult || !$dbresult->RecordCount()) return false;
    $row = $dbresult->FetchRow();
    return $row["template_name"];
  }

  function GetTemplateContent($templatename="")
  {
    $db = cms_utils::get_db();
    if ($templatename=="") $templatename=$this->GetDefaultTemplate();
    $q = "SELECT template_content FROM ".cms_db_prefix()."templates WHERE template_name = ?";
    //echo $templatename;
    $p = array($templatename);
    $dbresult = $db->Execute($q, $p);
    
    if (!$dbresult || $dbresult->RecordCount()==0) return false;
    $row = $dbresult->FetchRow();
    return $row["template_content"];
  }

  function GetUANameList() {
    $uanamelist = array();
    $uas = $this->GetPreference("useragents");
    $ualines = explode("\n",$uas);
    foreach($ualines as $ualine) {
      $uaparts = explode("|",$ualine);
      if (count($uaparts)!=2) continue;
      $uanamelist[$uaparts[0]] = $uaparts[0];
    }
    return $uanamelist;
  }

  function GetUAList() {
    $ualist = array();
    $uas = $this->GetPreference("useragents");
    $ualines = explode("\n",$uas);
    foreach($ualines as $ualine) {
			//echo $ualine."<br>";
      $uaparts = explode("|",$ualine);
      if (count($uaparts)!=2) continue;
      $ualist[$uaparts[0]] = $uaparts[1];
    }
    return $ualist;
  }

  function GetUATemplate($ua)
  {
    $ualist = $this->GetUAList();
    foreach ($ualist as $uaid=>$uatemplate) {
      if ($uaid ==$ua)
       return $uatemplate;
    }
    return false;
  }

  function GetThemeList()
   {
    $themelist = array();
    $dir = @opendir(dirname(__FILE__)."/themes/");
    if (!$dir) return false;
    while ($file = readdir($dir)) {
      if (!is_dir(dirname(__FILE__)."/themes/".$file)) continue;
      if ($file[0] =="." || $file[0] == "_") continue;      
      $themelist[$this->Lang("theme").": ".$file]=$file;
    }
    return $themelist;
  }
	
	function GetMatchingUA()
	{
	 $thisuseragent = $_SERVER['HTTP_USER_AGENT'];
	 $useragents = $this->GetUAList();
    
    foreach($useragents as $useragent => $uatemplate) {
			$useragent = trim($useragent);
			$uatemplate = trim($uatemplate);
			
			if (preg_match("/$useragent/i", $thisuseragent)) {
        return $useragent;
			}
		}
		return "none";
	}
 
/*
// PRE 1.0
 function DisableCacheForPages() {
    $db = cms_utils::get_db();    
    $q = "UPDATE ".cms_db_prefix()."content SET cachable=? WHERE active=?";
    //echo $templatename;
    $p = array(0,1);
    $dbresult = $db->Execute($q, $p);
    if (!$dbresult || $dbresult->RecordCount()==0) return false;
    return true;
  }


	function CachedPagesExist() {
    $db = cms_utils::get_db();
    $q = "SELECT * FROM ".cms_db_prefix()."content WHERE cachable=? AND active=?";
    //echo $templatename;
    $p = array(1,1);
    $dbresult = $db->Execute($q, $p);
		//echo $dbresult->RecordCount();
    if (!$dbresult || $dbresult->RecordCount()==0) return false;
    return true;
  }

 */

 
 /** 
 *
 * @TODO IMPORTANT, NEED TO APPLY A NEW CONCEPT... if possible
 * @return Smarty Compiler
 */
 
 function check_compiler() {
	  $smarty = cms_utils::get_smarty();
    $thisua = $this->GetMatchingUA();
    //die($thisua);
    $lastua = $this->GetPreference("lastua","none");
        
        if ($lastua != $thisua)
        {
           //die("!".$thisua);
           $smarty->force_compile = true;
           $this->SetPreference("lastua", $thisua);
					
        }
        else{
		    //$smarty->force_compile = false;
						
			// if we have more than 1 template set for pages, the compile must always be true, bah
            $smarty->force_compile = true;
            }

 }//end fn

  
}//end class
?>
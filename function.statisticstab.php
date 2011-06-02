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
    
    if (! $this->CheckPermission('Use CMSTouch'))
    {
        return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
    }
    
    $matches = $this->GetPreference("touchmatches",0);
    $nonmatches = $this->GetPreference("touchnonmatches",0);
    
    $pcmatches = 0;
    $pcnonmatches = 0;
    
    if ($matches!= 0) {
            
        if ($nonmatches == 0) {
            $pcmatches = "100%";
            $pcnonmatches = "0%";
        } 
        else
            {
            $total = $nonmatches+$matches;
            //echo "total:".$total;
            $pcmatches = round(($matches*100)/$total);
            $pcmatches.= "%";
            $pcnonmatches = round(($nonmatches*100)/$total);
            $pcnonmatches .= "%";
            }
    
    } else {
        
        if ($nonmatches !=0) {
            $pcmatches = "0%";
            $pcnonmatches = "100%";
        } else {
            $pcmatches = "0%";
            $pcnonmatches = "0%";
        }
    }
    $uastat = "";
    $ct_ua_names = array();
    $ct_ua_total = array();
    
        if ($matches!=0) {
        $uas = $this->GetUANameList();
        //print_r($uas);
        foreach($uas as $ua=>$uaname) {
            if ($uaname[0]=="#") continue;
            
            $uaname = str_replace("#","",$uaname);
            $uamatches = $this->GetPreference($uaname."_matches",0);
            $pc= "";
                if ($uamatches!=0) {
                    $pc=round(($uamatches*100)/$matches);
                    $pc.="%";
                } else {
                    $pc="0%";
                }
        
        $uastat .=$uaname . " : ".$pc." (".$uamatches.")
        <br/>
        ";
        
        //to the graphic stats
        $ct_ua_names[] = "'$uaname'";
        $ct_ua_total[] = $uamatches;
        //end 
        }
        }
    
    $this->smarty->assign('matchestext', $this->Lang("statmatches"));
    $this->smarty->assign('matches', $pcmatches." (".$matches.")");
    
    $this->smarty->assign('nonmatchestext', $this->Lang("statnonmatches"));
    $this->smarty->assign('nonmatches', $pcnonmatches." (".$nonmatches.")");
    
    //nuno stats
    $this->smarty->assign('ua_names', $ct_ua_names);
    $this->smarty->assign('ua_total', $ct_ua_total);
    
    $this->smarty->assign('pcmatches', $pcmatches);
    $this->smarty->assign('pcnonmatches', $pcnonmatches);
    //end nuno
    
    if ($matches!=0) {
    $this->smarty->assign('uamatchestext', $this->Lang("statuamatches"));
    $this->smarty->assign('uamatches', $uastat);
    }
    
    $this->smarty->assign('formstart', $this->CreateFormStart($id,"resetstatistics"));
    $this->smarty->assign('formend', $this->CreateFormEnd());
    $this->smarty->assign('submit',$this->CreateInputSubmit($id,"resetstatistics",$this->Lang("resetstatistics"),"","",$this->Lang("confirmresetstatistics")));
    
    echo $this->ProcessTemplate('statistics.tpl');

?>

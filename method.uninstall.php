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

$this->RemovePreference();
$this->RemoveEventHandler( 'Core', 'TemplatePreCompile' );
//$this->RemoveEventHandler( 'Core', 'ContentPostRender' );

$this->RemovePermission('Use CMSTouch');


$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('uninstalled'));
cmsms()->clear_cached_files();

?>

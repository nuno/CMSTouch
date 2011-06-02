{$formstart}

<div class="pageoverflow">
	<p class="pagetext">{$autoprocess}</p>
	<p class="pageinput">{$autoprocessinput}<br/>{$autoprocesshelp}</p>
</div>
{*
<div class="pageoverflow">
	<p class="pagetext">{$cachecontrol}</p>
	<p class="pageinput">{$cachecontrolinput}</p>
</div>
*}
<div class="pageoverflow">
	<p class="pagetext">{$defaulttouchtemplate}</p>
	<p class="pageinput">{$defaulttouchtemplateinput}</p>
</div>
{* old textarea<div class="pageoverflow">
	<p class="pagetext">{$useragents}</p>
	<p class="pageinput">{$useragentsinput}</p>
</div>
*}

<div class="pageoverflow">
	<p class="pagetext">{$useragents}</p>
  <div class="pageinput">
<table class="pagetable" style="width:800px; margin-left: 0;">
<tr>
  <th>{$uaactive}</th>
  <th>{$uaname}</th>
  <th>{$uatemplate}</th>
  <th>{$uaactions}</th>
</tr>
{foreach from=$uainput item=entry}
	<tr>
    <td>{$entry->activeinput}</td>
		<td>{$entry->uaname}</td>
		<td>{$entry->templateinput}</td>
		<td>{$entry->deleteicon}</td>
	</tr>
{/foreach}
  <tr>
    <td>{$newua}</td>
    <td>{$newuanameinput}</td>
    <td>{$newuatemplateinput}</td>
    <td>&nbsp;</td>
</table>
</div>
</div>

<div class="pageoverflow">
	<p class="pagetext">{$adduseragent}</p>
	<p class="pageinput">{$adduseragentidinput}{$adduseragenttemplateinput}</p>
</div>

{*<br/>Allowed templates:<br/><br/>{$allowedtemplates}*}
<div class="pageoverflow">
	<p class="pagetext">&nbsp;</p>
	<p class="pageinput">{$submit}</p>
</div>

{$formend}

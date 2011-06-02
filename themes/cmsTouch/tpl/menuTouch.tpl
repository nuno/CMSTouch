{* OLD TEMPLATE, PRE-1.0, IS HERE JUST IN CASE *}

{* DO NOT REMOVE THIS CALL *}
{menu assign='touch'}
{* END OF - DO NOT REMOVE THIS CALL*}
{literal}
<script type="text/javascript">
function touchToggleCollapse(cid){
	imgid='expimage' + cid;
	ulid='expand' + cid;

  document.getElementById(ulid).style.display=(document.getElementById(ulid).style.display!="block")? "block" : "none";
	if (document.getElementById(ulid).style.display == "block") {
	  document.getElementById(imgid).src= 'modules/CMSTouch/themes/cmsTouch/img/close.png';
	} else {
		document.getElementById(imgid).src= 'modules/CMSTouch/themes/cmsTouch/img/open.png';
	}
  return false;
}
</script>
{/literal}
{assign var=nextexpand value=0}
{if $count > 0}
<ul id="menu" title="Menu">
{foreach from=$nodelist item=node}
{if $node->depth > $node->prevdepth}
{section name=foo loop=$node->depth-$node->prevdepth}
<ul class="touch-toggle" id="expand{$nextexpand}">
{assign var=nextexpand value=$nextexpand+1}
{/section}
{elseif $node->depth < $node->prevdepth}
{repeat string='</li></ul>' times=$node->prevdepth-$node->depth}
{elseif $node->index > 0}
{/if}
{if $node->parent == true or ($node->current == true and $node->haschildren == true)}
<li class="menuactive menuparent"><a class="menuactive menuparent" {elseif $node->current == true}
<li class="menuactive"><a class="menuactive" {elseif $node->haschildren == true}
<li class="menuparent"><a class="menuparent" {elseif $node->type == 'sectionheader' and $node->haschildren == true}
<li class="sectionheader"><span class="sectionheader">{$node->menutext}</span> {elseif $node->type == 'separator'}
<li style="list-style-type: none;"> <hr class="menu_separator" />
{else}
<li><a {/if}
{if $node->type != 'sectionheader' and $node->type != 'separator'}{if $node->target}target="{$node->target}" {/if}
href="{$node->url|replace:$absolute_url:''}{$q}showtemplate=false{if $node->index == 0}&amp;cmstouchloaded=1{/if}" >{$node->menutext}</a>
{if $node->haschildren}<img id="expimage{$nextexpand}" class="haschildren" src="modules/CMSTouch/themes/cmsTouch/img/open.png" onclick="touchToggleCollapse('{$nextexpand}');" />
{/if}
{elseif $node->type == 'sectionheader'}><span class="sectionheader">{$node->menutext}</span></a>
{/if}
{/foreach}
{repeat string='</li></ul>' times=$node->depth-1}
</ul>
{/if}
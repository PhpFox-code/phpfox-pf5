<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: index.html.php 2826 2011-08-11 19:41:03Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<div class="table_header">
	{_p var='default_user_groups'}
</div>
<table>
<tr>
	<th style="width:20px;"></th>
	<th>{_p var='title'}</th>
	<th style="width:100px;">{_p var='users'}</th>
</tr>
{foreach from=$aGroups.special key=iKey item=aGroup}
<tr class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
	<td class="t_center">
		{if Phpfox::getUserParam('user.can_edit_user_group') || Phpfox::getUserParam('user.can_manage_user_group_settings')}
		<a href="#" class="js_drop_down_link" title="Manage">{img theme='misc/bullet_arrow_down.png' alt=''}</a>
		<div class="link_menu">
			<ul>
				{if Phpfox::getUserParam('user.can_manage_user_group_settings')}
				<li><a href="{url link='admincp.user.group.add' id=$aGroup.user_group_id setting='true'}">{_p var='manage_user_settings'}</a></li>
				{/if}
				{if Phpfox::getUserParam('user.can_edit_user_group')}
				<li><a href="{url link='admincp.user.group.add' id=$aGroup.user_group_id}" class="popup">{_p var='edit_user_group'}</a></li>
				{/if}
				<li><a href="{url link='admincp.user.group.activitypoints' id=$aGroup.user_group_id}" class="popup">{_p var='manage_activity_points'}</a></li>
			</ul>
		</div>		
		{/if}
	</td>	
	<td>{$aGroup.title|convert|clean}</td>
	<td>{if $aGroup.user_group_id == 3}N/A{else}{$aGroup.total_users}{/if}</td>
</tr>
{/foreach}
</table>
{if isset($aGroups.custom)}
<div class="table_header">
	{_p var='custom_user_groups'}
</div>
<table>
<tr>
	<th style="width:20px;"></th>
	<th>{_p var='title'}</th>
	<th style="width:100px;">{_p var='users'}</th>
</tr>
{foreach from=$aGroups.custom key=iKey item=aGroup}
<tr class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
	<td class="t_center">
		{if Phpfox::getUserParam('user.can_edit_user_group') || Phpfox::getUserParam('user.can_manage_user_group_settings') || Phpfox::getUserParam('user.can_delete_user_group')}
		<a href="#" class="js_drop_down_link" title="Manage">{img theme='misc/bullet_arrow_down.png' alt=''}</a>
		<div class="link_menu">
			<ul>
				{if Phpfox::getUserParam('user.can_manage_user_group_settings')}
				<li><a href="{url link='admincp.user.group.add' id=$aGroup.user_group_id setting='true'}">{_p var='manage_user_settings'}</a></li>
				{/if}
				{if Phpfox::getUserParam('user.can_edit_user_group')}
				<li><a href="{url link='admincp.user.group.add' id=$aGroup.user_group_id}" class="popup">{_p var='edit_user_group'}</a></li>
				{/if}
				{if !$aGroup.is_special && Phpfox::getUserParam('user.can_delete_user_group')}
				<li><a href="{url link='admincp.user.group.delete' id=$aGroup.user_group_id}">{_p var='delete'}</a></li>
				{/if}
				<li><a href="{url link='admincp.user.group.activitypoints' id=$aGroup.user_group_id}" class="popup">{_p var='manage_activity_points'}</a></li>
			</ul>
		</div>	
		{/if}	
	</td>	
	<td>{$aGroup.title|convert|clean}</td>
	<td>{if $aGroup.user_group_id == 3}{_p var='n_a'}{else}{$aGroup.total_users}{/if}</td>
</tr>
{/foreach}
</table>
{/if}
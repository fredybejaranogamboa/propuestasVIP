<div id="aros_link" class="acl_links">
<?php
$selected = isset($selected) ? $selected : $this->params['action'];

$links = array();
$links[] = $this->Html->link(__d('acl', 'Construir AROs perdidos'), '/admin/acl/aros/check', array('update'=>'content','indicator'=>'loading','class' => ($selected == 'admin_check' )? 'selected' : null));
$links[] = $this->Html->link(__d('acl', 'Gupo de  usuario'), '/admin/acl/aros/users', array('update'=>'content','indicator'=>'loading','class' => ($selected == 'admin_users' )? 'selected' : null));

if(Configure :: read('acl.gui.roles_permissions.ajax') === true)
{
    $links[] = $this->Ajax->link(__d('acl', 'Permisos por grupo'), '/admin/acl/aros/ajax_role_permissions_index', array('update'=>'content', 'indicator'=>'loading','class' => ($selected == 'admin_role_permissions' || $selected == 'admin_ajax_role_permissions' )? 'selected' : null));
}
else
{
    $links[] = $this->Ajax->link(__d('acl', 'Permisos por grupo'), '/admin/acl/aros/role_permissions', array('update'=>'content','indicator'=>'loading','class' => ($selected == 'admin_role_permissions' || $selected == 'admin_ajax_role_permissions' )? 'selected' : null));
}
$links[] = $this->Ajax->link(__d('acl', 'Permisos por usuario'), '/admin/acl/aros/user_permissions', array('update'=>'content','indicator'=>'loading','class' => ($selected == 'admin_user_permissions' )? 'selected' : null));

echo $this->Html->nestedList($links, array('class' => 'acl_links'));
?>
</div>
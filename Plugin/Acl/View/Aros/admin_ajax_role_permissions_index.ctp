<?php
echo $this->Html->script('/acl/js/jquery');
echo $this->Html->script('/acl/js/acl_plugin');

echo $this->element('design/header');
?>
<?php
echo $this->element('Aros/links');
?>
<table border="0" id="tabla">
<thead>
<tr>
<th>Grupo</th>
<th></th>
</tr>
</thead>
<tbody>
<?php foreach ($roles as $rol):?>
<tr>
<td><?php echo $rol['Group']['name']; ?></td>
<td><?php echo $this->Ajax->link('Editar permisos',array('action'=>'admin_ajax_role_permissions',$rol['Group']['id']),array('update'=>'content','indicator'=>'loading'));  ?></td>

</tr>
<?php endforeach;?>
</tbody>
</table>

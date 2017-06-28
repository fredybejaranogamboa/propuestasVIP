<script>
    $(document).ready(function(){
        $('#total').change(function(){
            if(this.checked){
            
                $('.tab').attr('checked',true);
            }else{
                $('.tab').attr('checked',false);
            }
      
        });
      
    })

</script>


<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::Import('model', 'GroupsTab');
$gi = new GroupsTab();
?>
<?php echo $this->Form->create(); ?>
<?php echo( $this->Form->hidden('GroupsTab.group_id', array('value' => $id))) ?>
<table border = "1">
    <thead>
        <tr>
            <th>Nombre Tab</th>
            <th><?php
echo $this->Form->input('', array(
    'type' => 'checkbox',
    'id' => 'total'
));
?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tabs as $tab): ?>

            <tr>
                <td><?php echo( $tab['Tab']['titulo']) ?></td>
                <td>
                    <?php
                    $conteo = $gi->find('count', array('conditions' => array('GroupsTab.group_id' => $id, 'GroupsTab.tab_id' => $tab['Tab']['id'])));
                    $chequeado = "";
                    if ($conteo > 0) {
                        $chequeado = "checked";
                    }
                    echo $this->Form->input('Seleccionar todos', array(
                        'type' => 'checkbox',
                        'checked' => $chequeado,
                        'value' => $tab['Tab']['id'],
                        'name' => 'tabs[]',
                        'class' => 'tab'
                    ));
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
<?php echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'GroupsTabs', 'action' => 'edit', $id), 'update' => 'content')); ?>
<?php echo $this->Form->end(); ?>
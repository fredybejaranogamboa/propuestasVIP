<script>
    $(document).ready(function () {
        $('#total').change(function () {
            if (this.checked) {

                $('.item').attr('checked', true);
            } else {
                $('.item').attr('checked', false);
            }
        });
    })
</script>
<?php
App::Import('model', 'ActionsGroup');
$ag = new ActionsGroup();
?>
<?php echo $this->Form->create(); ?>
<?php echo( $this->Form->hidden('ActionsGroup.group_id', array('value' => $id))) ?>
<table border = "1">
    <thead>
        <tr>
            <th>Acción</th>
            <th>Controlador</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($actions as $action): ?>

            <tr>
                <td><?php echo( $action['Entity']['name']) ?></td>
                <td><?php echo( $action['Action']['name']) ?></td>
                <td>
                    <?php
                    $conteo = $ag->find('count', array('conditions' => array('ActionsGroup.group_id' => $id, 'ActionsGroup.action_id' => $action['Action']['id'])));
                    $chequeado = "";
                    if ($conteo > 0) {
                        $chequeado = "checked";
                    }
                    echo $this->Form->input('', array(
                        'type' => 'checkbox',
                        'checked' => $chequeado,
                        'value' => $action['Action']['id'],
                        'name' => 'actions[]',
                        'class' => 'action',
                        'label'=>''
                    ));
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'ActionsGroups', 'action' => 'edit', $id), 'update' => 'content')); ?>
<?php echo $this->Form->end(); ?>
<script>
$(document).ready(function(){
    $('#total').change(function(){
        if(this.checked){
            
            $('.item').attr('checked',true);
        }else{
             $('.item').attr('checked',false);
        }
        
    });
    
   
})

</script>


<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::Import('model', 'GroupsItem');
$gi = new GroupsItem();
// 
?>
<?php echo $this->Form->create();?>
<?php echo( $this->Form->hidden('GroupsItem.group_id',array('value'=>$id))) ?>
<table border = "1">
    <thead>
        <tr>
            <th>Nombre Item</th>
            <th>Controlador</th>
            <th>Acción</th>
            <th><?php echo $this->Form->input('', array(
                        'type' => 'checkbox',
                        'id'=>'total'
                    ));?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?php echo( $item['Item']['nombre']) ?></td>
                <td><?php echo( $item['Item']['controlador']) ?></td>
                <td><?php echo ( $item['Item']['accion']) ?></td>
                <td>
                    <?php
                     $conteo = $gi->find('count', array('conditions' => array('GroupsItem.group_id' => $id,'GroupsItem.item_id'=>$item['Item']['id'])));
                     $chequeado="";
                     if($conteo>0){
                         $chequeado="checked";
                     }
                    echo $this->Form->input('', array(
                        'type' => 'checkbox',
                        'checked'=>$chequeado,
                        'value'=>$item['Item']['id'],
                        'name'=>'items[]',
                        'class'=>'item',
                        'label'=>''
                    ));
                    ?>
                </td>

            </tr>
        <?php endforeach; ?>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
<?php echo $this->Ajax->submit('Guardar',array('url'=> array('controller'=>'GroupsItems','action'=>'edit',$id),'update'=>'content'));?>
<?php echo $this->Form->end();?>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-6">
            <?php
            echo $this->Form->create('BranchUser', array('role' => "form"));
            echo $this->Form->hidden("BranchUser.branch_id", array('value' => $branch_id));
            ?>
            <div id="loading" style="display: none;">
                <?php echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); ?>
            </div>
            <?php
            //creo el array de options para el select incluyendo los aspirantes principales
            $optionsUsers = array();
            foreach ($users as $user) {
                $optionsUsers[$user['User']['id']] = $user['User']['primer_apellido'] . " " . $user['User']['segundo_apellido'] . " " . $user['User']['nombre'];
            }
            echo $this->Form->input('BranchUser.user_id', array('label' => 'Usuario', 'empty' => 'Seleccione un usuario', 'options' => $optionsUsers, 'class' => 'form-control'));
            ?> 
            <?php
            echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'BranchUsers', 'action' => 'add', $branch_id), 'update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-default'));
            echo $this->Form->end();
            ?>
        </div>
    </div>
</div>


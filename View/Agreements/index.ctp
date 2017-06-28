<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Número</th>
            <th>Fecha</th>
            <th>Suscriptor</th>
            <th colspan="3"></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Número</th>
            <th>Fecha</th>
            <th>Suscriptor</th>
            <th colspan="3"></th>
        </tr>
        <tr>
            <th colspan="7" class="ts-pager form-horizontal">
                <button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
                <button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
                <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                <button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i></button>
                <button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i></button>
                <select class="pagesize input-mini" title="Select page size">
                    <option selected="selected" value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                </select>
                <select class="pagenum input-mini" title="Select page number"></select>
            </th>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($Agreements as $Agreement): ?>
            <?php
            $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Convenios";
            ?>
            <tr>
                <td><?php echo $Agreement['Agreement']['id']; ?></td>
                <td><?php echo $Agreement['Agreement']['numero']; ?></td>
                <td><?php echo $Agreement['Agreement']['fecha']; ?></td>
                <td><?php echo $Agreement['Agreement']['suscriptor']; ?></td>
                <td>
                    <?php
                    echo $this->Ajax->link(' Editar', array('controller' => 'Agreements', 'action' => 'edit', $Agreement['Agreement']['id']), array('class' => 'btn btn-success fa fa-pencil', 'update' => 'content', 'indicator' => 'loading'));
                    ?>
                </td>
                <td>
                    <?php echo $this->Ajax->link(' Eliminar', array('controller' => 'Agreements', 'action' => 'delete', $Agreement['Agreement']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Realmente desea borrar el convenio?'); ?>
                </td>
                <td>
                    <?php
                    if (file_exists("../webroot/files/Convenios/Convenio-" . $Agreement['Agreement']['id'] . ".pdf"))
                        echo $this->Html->link('  Adjunto', "../files/Convenios/Convenio-" . $Agreement['Agreement']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Convenio-" . $aleatorio . ".pdf"));
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<?php
echo $this->Ajax->link(' Adicionar', array('controller' => 'Agreements', 'action' => 'add'), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o'));
?>
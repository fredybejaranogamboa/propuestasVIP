<script>
    $(document).ready(function () {
        $("#container").html("");
    });
</script>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th><?php echo "TIPO REPORTE"; ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reports as $report): ?>
            <tr>
                <td><?php echo $report['name']; ?></td>
                <td><?php echo $this->Html->link(' Descargar', array('controller' => $report['controller'], 'action' => $report['action'], $report['option']), array('target' => 'blank', 'class' => 'btn btn-success fa fa-file-excel-o')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

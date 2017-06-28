<div class="panel panel-default">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->fetch('content'); ?>
    <?php echo $this->element('sql_dump'); ?> 
</div>
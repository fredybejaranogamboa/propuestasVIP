<?php

App::Import('model', 'Item');
$item = new Item();
$item->recursive = -1;
?>

<?php echo $this->Html->css('style'); ?>
<script>
    $(document).ready(function () {
        $("#menu ul li ul").hide();
        $("#menu ul li span.current").addClass("open").next("ul").show();
        $("#menu ul li span").click(function () {
            $(this).next("ul").slideToggle("slow").parent("li").siblings("li").find("ul:visible").slideUp("slow");
            $("#menu ul li").find("span").removeClass("open");
            $(this).addClass("open");
        });
    })
</script>
<ul>
    <?php $menuid = 0; ?>
    <?php foreach ($listado as $menu): ?>

        <?php if ($menuid != $menu['Menu']['id']): ?>
            <?php if ($menuid != 0): ?>

</ul>
</li>
        <?php endif; ?>
<li>
    <span id="<?php echo 'men_' . $menu['Menu']['id'] ?>">
        <table  padding="0px">
            <tbody>
                <tr>
                    <td width="20px"> <?php echo $this->Html->image($menu['Menu']['icono'], array('width' => '30', 'heigth' => '30', 'border' => "0", 'id' => "menu_img")) ?>      
                    </td>
                    <td><a href="javascript:void(0);" style="color: #f1f5f5;background: transparent; text-decoration: none; border: none" ><?php echo $menu['Menu']['nombre'] ?> </a></td>
                </tr>
            </tbody>
        </table>
    </span>
    <ul>   
            <?php endif; ?>    
        <li><?php echo $this->Ajax->link($menu['Item']['nombre'], array('controller' => $menu['Item']['controlador'], 'action' => $menu['Item']['accion']), array('update' => 'content', 'indicator' => 'loading','class'=>'normal_link')) ?></li>
            <?php ( $menuid = $menu['Menu']['id']) ?>  
        <?php endforeach; ?>
    </ul>

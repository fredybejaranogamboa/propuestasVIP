<script>
    $(document).ready(function ()
    {

        if ($.cookie('tab_id') != null) {

            if ($('#' + $.cookie('tab_id') != "")) {
                $('#' + $.cookie('tab_id')).addClass("active");
                var tab_id = $.cookie('tab_id').replace("tab_", "");
                $('#menu').load('<?php echo $this->Html->url(array('controller' => 'menus', 'action' => 'ver')) ?>/' + tab_id);
            }
        }


        $(".tab_content").hide();
        $("ul.tabs li:first").addClass("active").show();
        $(".tab_content:first").show();

        $("ul.tabs li").click(function ()
        {
            $("ul.tabs li").removeClass("active");
            $(this).addClass("active");
            $(".tab_content").hide();
            $.cookie('tab_id', $(this).attr('id'));
        });


    });

</script>

<div id="tabs-container" >
    <ul class="tabs">
        <?php foreach ($lista as $tab): ?>
            <li id="tab_<?php echo $tab['Tab']['id'] ?>"><?php echo $this->Ajax->link($tab['Tab']['titulo'], array('controller' => 'Menus', "action" => "ver", $tab['Tab']['id']), array('update' => 'menu', 'indicator' => 'loading', 'class' => "menu_link", 'title' => $tab['Tab']['titulo'])) ?></li>
            <?php endforeach; ?>
    </ul>
</div>
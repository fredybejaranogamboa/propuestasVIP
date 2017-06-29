<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">


        <title>PDRET - Proyecto de desarrollo rural con enfoque territorial - ADR</title>
        <?php echo $this->Html->css('/bower_components/bootstrap/dist/css/bootstrap.css'); ?>
        <?php echo $this->Html->css('/bower_components/metisMenu/dist/metisMenu.min.css'); ?>
        <?php echo $this->Html->css('/dist/css/sb-admin-2.css'); ?>
        <?php echo $this->Html->css('/bower_components/font-awesome/css/font-awesome.min.css'); ?>
        <?php echo $this->Html->css('jquery-ui.min'); ?>
        <?php echo $this->Html->css('jquery-ui.structure.min'); ?>
        <?php echo $this->Html->css('jquery-ui.theme.min'); ?>
        <?php echo $this->Html->css('bootstrap-select.min'); ?>
        <?php echo $this->Html->css('theme.bootstrap.css'); ?>
        <?php echo $this->Html->css('jquery.tablesorter.pager'); ?>
        <?php echo $this->Javascript->link('jquery'); ?>
        <?php echo $this->Javascript->link('jquery.validate'); ?>
        <?php echo $this->Javascript->link('additional-methods.min'); ?>
        <?php echo $this->Javascript->link('jquery-ui.min'); ?>
        <?php echo $this->Javascript->link('jquery.ui.datepicker-es'); ?>
        <?php echo $this->Javascript->link('/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>
        <?php echo $this->Javascript->link('/bower_components/metisMenu/dist/metisMenu.min.js'); ?>
        <?php echo $this->Javascript->link('/dist/js/sb-admin-2.js'); ?>
        <?php echo $this->Javascript->link('jquery.tablesorter'); ?>
        <?php echo $this->Javascript->link('jquery.tablesorter.widgets'); ?>
        <?php echo $this->Javascript->link('jquery.tablesorter.pager'); ?>
        <?php echo $this->Javascript->link('jquery.validate'); ?>
        <?php echo $this->Javascript->link('bootstrap-select'); ?>
    </head>
    <body>
        <script>
            $(document).ready(function () {

                // NOTE: $.tablesorter.theme.bootstrap is ALREADY INCLUDED in the jquery.tablesorter.widgets.js
                // file; it is included here to show how you can modify the default classes
                $.tablesorter.themes.bootstrap = {
                    // these classes are added to the table. To see other table classes available,
                    // look here: http://getbootstrap.com/css/#tables
                    table: 'table table-striped table-bordered table-hover',
                    caption: 'caption',
                    // header class names
                    header: 'bootstrap-header', // give the header a gradient background (theme.bootstrap_2.css)
                    sortNone: '',
                    sortAsc: '',
                    sortDesc: '',
                    active: '', // applied when column is sorted
                    hover: '', // custom css required - a defined bootstrap style may not override other classes
                    // icon class names
                    icons: '', // add "icon-white" to make them white; this icon class is added to the <i> in the header
                    iconSortNone: 'bootstrap-icon-unsorted', // class name added to icon when column is not sorted
                    iconSortAsc: 'glyphicon glyphicon-chevron-up', // class name added to icon when column has ascending sort
                    iconSortDesc: 'glyphicon glyphicon-chevron-down', // class name added to icon when column has descending sort
                    filterRow: '', // filter row class; use widgetOptions.filter_cssFilter for the input/select element
                    footerRow: '',
                    footerCells: '',
                    even: '', // even row zebra striping
                    odd: ''  // odd row zebra striping
                };

                // call the tablesorter plugin and apply the uitheme widget
                $("table").tablesorter({
                    // this will apply the bootstrap theme if "uitheme" widget is included
                    // the widgetOptions.uitheme is no longer required to be set
                    theme: "bootstrap",
                    widthFixed: true,
                    headerTemplate: '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!

                    // widget code contained in the jquery.tablesorter.widgets.js file
                    // use the zebra stripe widget if you plan on hiding any rows (filter widget)
                    widgets: ["uitheme", "filter", "zebra"],
                    widgetOptions: {
                        // using the default zebra striping class name, so it actually isn't included in the theme variable above
                        // this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
                        zebra: ["even", "odd"],
                        // reset filters button
                        filter_reset: ".reset",
                        // extra css class name (string or array) added to the filter element (input or select)
                        filter_cssFilter: "form-control",
                        // set the uitheme widget to use the bootstrap theme class names
                        // this is no longer required, if theme is set
                        // ,uitheme : "bootstrap"

                    }
                })
                        .tablesorterPager({
                            // target the pager markup - see the HTML block below
                            container: $(".ts-pager"),
                            // target the pager page select dropdown - choose a page
                            cssGoto: ".pagenum",
                            // remove rows from the table to speed up the sort of large tables.
                            // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
                            removeRows: false,
                            // output string - default is '{page}/{totalPages}';
                            // possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
                            output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'

                        });

            });
        </script>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php echo $this->Ajax->link("INICIO", array('controller' => 'Pages', 'action' => 'home'), array('escape' => FALSE, 'update' => 'content', 'indicator' => 'loading', 'class' => "navbar-brand")); ?>

                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>
                            <?php
                            App::import('Model', 'Group');
                            $gr = new Group();
                            $grupo = $gr->find('first', array('conditions' => array('Group.id' => AuthComponent::User('group_id'))));
                            echo AuthComponent::User('nombre') . " " . AuthComponent::User('primer_apellido') . " (" . $grupo['Group']['name'] . ")";
                            ?>
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>


                                <?php echo $this->Ajax->link(
                                'Mis datos',
                                array( 'controller' => "Users", "action" => "edit_user", 1 ),
                                array(  
                                'update' => 'cont',
                                'complete' => '$("#edit").modal("show")',
                                'class' => 'fa fa-user fa-fw',
                                'type' => 'synchronous'
                                )
                                );
                                ?>


                            </li>
                            <li class="divider"></li>
                            <li>
                                <?php
                                echo $this->Html->link("SALIR", array('controller' => 'users', 'action' => 'logout'), array('class' => 'fa fa-sign-out fa-fw', 'escape' => FALSE, 'update' => 'content'));
                                ?>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->
                <!-- /.inicio del menu -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                       <?php     
                       echo $this->Form->create("Proyects", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "search")));
                        ?>
                                <div class="input-group custom-search-form">
                                    <?php 
                                    echo $this->Form->input("Proyect.parametro", array('label' => '', 'class' => 'form-control', 'required' => '', 'placeholder' => 'Buscar'));
                                    ?>
                                    <span class="input-group-btn">
                                    <?php
                                    echo $this->Form->end(array('label'=>'Enviar', 'class' => 'btn btn-default'));
                                    ?>
                                    </span>

                                </div>

                                <div>

                                </div>   

                                <!-- /input-group -->
                            </li>

                            <?php
                            App::import('Model', 'GroupsItem');
                            $gi = new GroupsItem();
                            $gi->recursive = -1;

                            App::import('Model', 'Item');
                            $i = new Item();
                            $i->recursive = -1;

                            App::import('Model', 'Menu');
                            $m = new Menu();
                            $m->recursive = -1;

                            $items_id = $gi->find('all', array(
                            'fields' => 'DISTINCT GroupsItem.item_id',
                            'order' => 'GroupsItem.item_id ASC',
                            'conditions' => array('GroupsItem.group_id' => AuthComponent::User('group_id'))
                            ));

                            $items = array();
                            foreach ($items_id as $item_id) {
                            $items[] = $item_id["GroupsItem"]["item_id"];
                            }

                            $menus_id = $i->find('all', array(
                            'fields' => 'DISTINCT Item.menu_id',
                            'order' => 'Item.menu_id ASC',
                            'conditions' => array('Item.id' => $items)
                            ));

                            $menus = array();
                            foreach ($menus_id as $menu_id) {
                            $menus[] = $menu_id["Item"]["menu_id"];
                            }

                            $menus2 = $m->find('all', array(
                            'order' => 'orden ASC',
                            'conditions' => array('Menu.id' => $menus)
                            ));
                            ?>
                            <?php foreach ($menus2 as $menu2): ?>
                            <?php
                            $items2 = $i->find('all', array(
                            'order' => 'orden ASC',
                            'conditions' => array('Item.menu_id' => $menu2['Menu']['id'], 'Item.id' => $items)
                            ));
                            ?>
                            <li>
                                <a href="#"><i class="fa fa-<?php echo $menu2['Menu']['icono'] ?> fa-fw"></i> <?php echo $menu2['Menu']['nombre'] ?><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php foreach ($items2 as $item2): ?>
                                    <li>
                                        <?php
                                        echo $this->Html->link($item2['Item']['nombre'], array('controller' => $item2['Item']['controlador'], 'action' => $item2['Item']['accion']), array('escape' => FALSE, 'update' => 'content'));
                                        ?>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <?php endforeach; ?>

                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>

                <!-- /.navbar-static-side -->
            </nav><!-- /fin del menu -->

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div id="selector"  >
                    <?php
                    echo $this->Form->create('Proyect');
                    ?>
                    <table>
                        <tr>
                            <td>
                                <input type="text" name="data[Proyect][codigo]" class="form-control"  placeholder="Código de proyecto"/>
                            </td>
                            <td>
                                <label>Año</label>
                            </td>
                            <td>
                                <select name="data[Proyect][call_id]" class="form-control">
                                    <?php
                                    foreach ($calls as $key => $value) {
                                    echo "<option value='$key'>" . $value . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <?php echo $this->Ajax->submit('Seleccionar Proyecto', array('url' => array('controller' => 'Proyects', 'action' => 'select_proyect'), 'update' => 'current', 'indicator' => 'loading', 'class' => 'btn btn-default', 'complete' => '$("#content").html("");$("#candidate").html("");')); ?>
                            </td>
                        </tr>
                    </table>
                    <?php echo $this->Form->end(); ?>
                </div>

                <div id="current"  >
                    <?php
                    if ($this->Session->read('codigo') == "") {
                    echo"<h3>  NO HA SELECCIONADO PROYECTO </h3>";
                    } else {
                    echo"<h3>  PROYECTO ACTIVO: " . $this->Session->read('call_nombre') . " " . strtoupper($this->Session->read('codigo')) . "</h3>";
                    }
                    ?> 
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"></h1>
                    </div>
                </div>
                <div id="loading" style="display: none;">
                    <?php echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); ?>
                </div>
                <div id="content">
                    <?php
                    $rutaArchivoSoportes = "files";
                    ?>
                    <?php
                    echo $this->Session->flash('auth');
                    echo $this->Session->flash();
                    ?>
                    <?php echo $content_for_layout; ?>
                    <?php echo $this->element('sql_dump'); ?>  
                </div>
            </div>
            <!-- /#page-wrapper -->
        </div>
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            <div class="modal-dialog" style="width: 60%">
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <div id="banner" align="center">
                            <?php 
                            echo $this->Html->image('actualusu.png', array('width'=>'600','height'=>'auto')); 
                            ?> 

                        </div>
                    </div>


                    <!-- -->

                    <div class="modal-body" id="cont">

                    </div>

                    <!-- -->


                </div>
            </div>
        </div>
    </body>
</html>
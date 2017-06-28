<?php ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php
            __('Version 1.1 ');
            echo "IPDR";
            ?>
        </title>
        <?php echo $this->Html->css('complex'); ?>
        <?php echo $this->Html->css('mytabs'); ?>
        <?php echo $this->Html->css('cake.generic'); ?>
        <?php echo $this->Html->css('redmond/jquery-ui-1.8.18.custom'); ?>
        <?php echo $this->Javascript->link('jquery-1.7.1.min'); ?>
        <?php echo $this->Javascript->link('jquery.cookie'); ?>


        <script>
            $(document).ready(function() {

                $('#menu').load('<?php echo $this->Html->url(array('controller' => 'menus', 'action' => 'ver')) ?>/' + 1);

            });
        </script>
        <body>

            <div  style="">
                <div class="header">PDRET</div>
                <div id="selector"  >
                <?php
                echo $this->Form->create('Proyect');
                ?>

                <table  cellpadding="0" border="0"  cellspacing="0"style="width: 300px;" >

                    <tr>

                        <td>
                            <input type="text" name="data[Proyect][codigo]" id="usr"  />
                        </td>
                        <td>

                            <select name="data[Proyect][call_id]">
                                <?php
                                foreach ($calls as $key => $value) {
                                    echo "<option value='$key'>" . $value . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <?php echo $this->Ajax->submit('Seleccionar Proyecto', array('url' => array('controller' => 'Proyects', 'action' => 'select_proyect'), 'update' => 'current', 'indicator' => 'loading', 'class' => 'not_hidden', 'complete' => '$("#content").html("");$("#candidate").html("");')); ?>
                        </td>
                    </tr>
                </table>

                <?php echo $this->Form->end(); ?>
            </div>

            <div id="current"  >

                <?php
                if ($this->Session->read('codigo') == "") {
                    echo"<h1>  NO HA SELECCIONADO<br> PROYECTO </h1>";
                } else {
                    echo"<h1>  PROYECTO ACTIVO:<br> " . $this->Session->read('call_nombre') . " " . strtoupper($this->Session->read('codigo')) . "</h1>";
                }
                ?> 
                
            </div>
            <div id="buscador">
                    <form style="clear: both" >
                        <table border="0" cellspacing="0" cellpaddding="0" style="width: 200px;height: 20px; padding: 0px 0px 0px 0px">
                            <tr>
                                <td ><input type="text"  name="data[Proyect][busqueda]" style="width: 130px" ></td>
                                <td ><?php echo $this->Ajax->submit('Buscar', array('url' => array('controller' => 'Proyects', 'action' => 'search', 0), 'update' => 'content', 'indicator' => 'loading')); ?></td>
                            </tr>
                        </table>
                    </form>

                </div>
                <div id="exit_panel" style="background: #d5e1f9;">
                                                     <?php echo $this->Html->link("Incoder","#");?>
                </div>


            </div>
            
            <div id="tabs" style="width: 100%">
                <ul class="toolbar">
                    <?php echo $this->element('tabs', array('lista' => $lista)); ?>
                </ul>

            </div>
            <br>
            <br>
            <br>
            <br>
            <div  id="menu" style="background: #d5e1f9;width: 100%;">


            </div>
            <div id="mainContent" style="margin:auto;-webkit-border-radius: 12px;-moz-border-radius: 12px; background: #d5e1f9;border: solid 1px; border-color: #003399;height: 100%" >

                <div id="content" style="margin:auto">
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->Session->flash('auth'); ?>
                    <?php echo $content_for_layout; ?>
                </div>
            </div>




            <div class="header">Contacto</div>
            <div style="text-align: center" >


                <div class="copyright" style="color: #0063DC;width: 100%">
                    <?php
                    echo $this->Html->link('Contacto', "http://www.incoder.gov.co", array('class' => 'contactLink'));
                    ?>&nbsp;
                    &nbsp;

                    <div class = "copyrightfont">Incoder. Todos los derechos reservados.</div>
                </div>
            </div>

        </body>
</html>

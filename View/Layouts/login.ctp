<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>PROYECTOS ADR 2017</title>
        <?php echo $this->Html->css('bootstrap'); ?>
        <?php echo $this->Html->css('login'); ?>

        <?php echo $this->Javascript->link('jquery'); ?>
        <?php echo $this->Javascript->link('bootstrap.min'); ?>
        <?php //echo $this->Javascript->link('npm'); ?>

        <script>
            function formularioAjax() {

                $(".form").validate({
                    submitHandler: function (form) {
                        $(form).ajaxSubmit({
                            target: "#content"
                        });
                    }

                });
            }
        </script>

    </head>
    <body>
        <div class = "container">
            <div id="banner" align="center"><?php echo $this->Html->image('bandera.png', array('width'=>'300','height'=>'auto')) ?> </div>

            <div id="content">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
                <?php //echo $this->element('sql_dump'); ?>  

            </div>
            <hr/>
            <div class="footer"> <p align="center">Políticas de Privacidad y Condiciones de Uso Agencia de Desarrollo Rural, Nit: 900.948.958-4, Avenida el Dorado C.A.N
                    Calle 43 No. 57 - 41 (Bogotá - Colombia) Conmutador: (571) 3830444 Ext 1112 - 1114
                    Línea de Atención al Ciudadano 018000115121  Horario de Atención: Lunes a Viernes 8.00 a.m. a 5:00 p.m. 
                    E-Mail: atencionalciudadano@adr.gov.co
                    www.adr.gov.co</p>
            </div>
        </div>
    </body>
</html>
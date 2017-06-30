<?php

echo $this->Form->file('Document.documento', array('label' => 'Documento',
        'class' => 'form-control',
        'accept' => $accept,
        'aria-required' => 'true',
        'required' => 'true',
        'extension' => $extension));

?>

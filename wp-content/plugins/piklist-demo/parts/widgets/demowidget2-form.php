<?php

piklist('field', array(
'type' => 'text'
,'field' => 'demo_text_2'
,'label' => 'Text box'
,'description' => 'Field Description'
,'value' => 'Default text'
,'attributes' => array(
'class' => 'text'
)
));

piklist('field', array(
'type' => 'select'
,'field' => 'demo_select_2'
,'label' => 'Select box'
,'description' => 'Choose from the dropdown.'
,'attributes' => array(
'class' => 'text'
)
,'choices' => array(
'option1' => 'Option 1'
,'option2' => 'Option 2'
,'option3' => 'Option 3'
)
));


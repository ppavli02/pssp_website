<?php

$json_encoded = file_get_contents('php://input');
$json_decoded = json_decode($json_encoded);

//echo json_encode($form_errors);
$network = $json_decoded->{'network'};
$iterations = $json_decoded->{'iterations'};

//foreach ()

//{"network":"1","iterations":"","no_neurons":"","prev_layers":"","next_layer":"","layer_type":"1","error_function":"1","activation_function":"1","learning_rate":"","momentum":"","delay_unit":"","unknown_flag":"1"}

//foreach($age as $x => $x_value) {
//
//}

//phpinfo( );

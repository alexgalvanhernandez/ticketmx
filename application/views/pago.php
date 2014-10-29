<?php


// Poner aquí código de inicialización en base de datos //


if($_POST['payment_status']=='Completed' || $_POST['payment_status']=='Processed') {
    // Suponemos que el item_number que nosotros enviamos es del formato: XXXXX-YYYY
    // Donde XXXXX es el tipo de pago e YYYY es el identificador único del pago
    $tipo_venta_aux = explode('-',$_POST['item_number']);
    $tipo_venta = $tipo_venta_aux[0];
    $item_pagado = $tipo_venta_aux[1];

		$file = fopen("prueba.txt", "a");
		fwrite($file, "llego". PHP_EOL);
		fclose($file);

    $pago_valido = false;


        // Verificamos en base de datos
    switch($tipo_venta) {
        case 'VENTA':
            // Verificamos que es una venta existente y pendiente de pago
            $pago_valido = true;
            break;
        case 'ALQUILER':
            // Verificamos que es un alquiler existente y pendiente de pago
            $pago_valido = true;
            break;
        case 'PAGO_MENSUAL':
            // Verificamos que es un pago mensual existente y pendiente de pago
            $pago_valido = true;
            break;
    }


    if($pago_valido == true) {
        // Actualizamos el estado a pagado y hacemos lo que nos interese.
        // Como por ejemplo notificar al cliente de que el pago ha sido registrado.
    }
}


// Poner aquí código de finalización en base de datos //


?>
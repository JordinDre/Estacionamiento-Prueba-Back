<?php

namespace App\Http\Controllers\Utils;


class Functions
{
  public static function formatText($text)
  {
    $listado = [
      ['id' => '&', 'value' => ''],
      ['id' => 'acute;', 'value' => ''],
      ['id' => 'Ntilde;', 'value' => 'Ñ'],
      ['id' => 'ntilde;', 'value' => 'ñ']
    ];

    foreach ($listado as $value) {
      $text = str_replace($value["id"], $value["value"], $text);
    }
    return $text;
  }


  public static function nombreFactura($nit)
{
    $nit = str_replace("-", "", $nit);
    $nit = str_replace("/", "", $nit);

    if (trim($nit) == "") {
        $nit = "CF";
    } else if (strpos(strtolower($nit), 'consumidor') !== false) {
        $nit = "CF";
    } else if (strpos(strtolower($nit), 'final') !== false) {
        $nit = "CF";
    } else if (trim($nit) == 'cf') {
        $nit = "CF";
    }

    $entity = "96457635";
    $requesor = "CA067F23-8E6E-4E2D-AA21-9A1EA44B9DCC";
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://fel.g4sdocumenta.com/ConsultaNIT/ConsultaNIT.asmx/getNIT?vNIT=$nit&Entity=$entity&Requestor=$requesor",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);
    $httpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($httpStatusCode !== 200) {
        curl_close($curl);
        return [
            'nit' => '',
            'mensaje' => "Error en la conexión con la API",
            'success' => false
        ];
    }

    curl_close($curl);

    $arregloNit = json_decode(json_encode(simplexml_load_string($response)), true);

    if ($arregloNit['Response']['Result'] === 'true') {
        return Functions::formatText($arregloNit['Response']['nombre']);
    }
    return  "Numero de nit incorrecto";
}
}

<?php
require __DIR__.'/vendor/autoload.php';

use \App\Pix\Payload;
use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;

//chave do pix valido
$obPayload = (new Payload)->setPixKey('verdadeira')

                         ->setDescription('Pagamento do pedido 123456')
                         ->setMerchantName('Nome da empresa')
                         ->setMerchantCity('Brasilia')
                         ->setAmount(50.00) //valor do pix
                         ->setTxid('PAGGUARDIAN'); //codigo de transacao

 $payloadQrCode = $obPayload->getPayload();
 
 //saida do QRcode
 $obQrCode = new QrCode($payloadQrCode);

 //gerador do QRcode
 $image = (new Output\Png)->output($obQrCode,400);

 header('Content-Type: image/png');
 echo $image;

 //debub//
//echo "<pre>";
//print_r($payloadQrCode);
//echo "<pre>"; exit;


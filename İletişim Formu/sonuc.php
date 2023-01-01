<?php
header("Content-Type:tex/html; charset=UTF-8");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function filtrele($Deger){
    $IslemBir   =   trim($Deger);
    $IslemIki   =   strip_tags($IslemBir);
    $IslemUc   =    htmlspecialchars($IslemIki. ENT_QUOTES);
    $Sonuc      =   $IslemUc;
            return $Sonuc;

}

$GelenIsimSoyisim          =   $_POST["adisoyadi"];
$GelenTelefon              =   $_POST["telefon"];
$GelenEmailadresi          =   $_POST["emailadresi"];
$GelenKonusu               =   $_POST["konusu"];
$GelenMesaji               =   $_POST["mesaji"];





$mailGonder = new PHPMailer(true);

try {
        //Sunucu Ayarları
        $mailGonder->SMTPDebug                = 0;                      
        $mailGonder->isSMTP();                                            
        $mailGonder->Host              = 'mail.extraegitim.net';                     
        $mailGonder->SMTPAuth          = true; 
        $mailGonder->CharSet           = 'UTF-8';                                   
        $mailGonder->Username          = 'info@extraegitim.net';                    
        $mailGonder->Password          = 'VOlkan80';                              
        $mailGonder->SMTPSecure        = 'tls'
        $mailGonder->Port              = 587;  
        $mailGonder->SMTPOptions       = array(
                                                'ssl' => [
                                                    'verify_peer' => false,
                                                    'verify_peer_name' => false,
                                                    'allow_self_signed' => true 
                                                ],
        )  
                                  
        $mailGonder->setFrom($GelenEmailadresi, $GelenIsimSoyisim);
        $mailGonder->addAddress('info@extraegitim.net', 'Extra Eğitim');     
        $mailGonder->addReplyTo($GelenEmailadresi, $GelenIsimSoyisim);
        $mailGonder->isHTML(true);                                  
        $mailGonder->Subject = $GelenKonusu;
        $mailGonder->MsgHTML($GelenMesaji);
     //   $mailGonder->Body    = 'Mailin gövdesi';
    //$mailGonder->AltBody = 'Mailin gövdesi(HTML mail kanul etmeyen sunucular için)';

    $mailGonder->send();
    echo 'Mail GÖnderildi';

} catch (Exception $e) {
    echo 'Mail Gönderim Hatası<br />Hata Açıklaması: ' {$mailGonder->ErrorInfo};
}












?>
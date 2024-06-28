<?php
namespace Placestart\Utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Mailer{
    private PHPMailer $mail;

    /**
     * @param string $subject
     * @param string $body
     */
    function __construct(string $subject, string $body){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'm1.system.place-start.ru';
        $mail->Port = 25;
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->setFrom('chikarno.ru@srv11.ps', 'chikarno.ru');
        $mail->addAddress('feadback@place-start.ru');
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $this->mail = $mail;
    }

    function send(): array{
        $result = [
            "status" => "success"
        ];
    
        try{
            $this->mail->send();
        }
        catch (Exception $e) {
            $result["status"] = "error";
            $result["error"] = $this->mail->ErrorInfo;
        }
    
        return $result;
    }
}
<?php
    require_once 'PHPMailer/src/PHPMailer.php';
    require_once 'PHPMailer/src/SMTP.php';
    require_once 'PHPMailer/src/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class Email {
        private static $from = 'tccetecds2022@gmail.com';
        private static $password = 'zhyfzwffawordslm';
        private $destinatarios;
        private $assunto;
        private $mensagem;
        private $altBody;
        private $images;
        private $anexos;

        public static function verifyEmail ($to) {
            $api_key = "b5206d199c8f4ec3840393832346f615";
            $data = json_decode(file_get_contents("https://emailvalidation.abstractapi.com/v1/?api_key=".$api_key."&email=".$to));

            if($data->deliverability == "UNDELIVERABLE")
                return false;
            else
                return true;
        }

        public function setDestinatarios ($destinatarios) {
            $this->destinatarios = $destinatarios;
        }

        public function getDestinatarios () {
            return $this->destinatarios;
        }

        public function setAssunto ($assunto) {
            $this->assunto = $assunto;
        }

        public function getAssunto() {
            return $this->assunto;
        }

        public function setMensagem ($mensagem ) {
            $this->mensagem = $mensagem;
        }

        public function getMensagem () {
            return $this->mensagem;
        }

        public function setAltBody ($mensagem) {
            $this->altBody = utf8_encode($mensagem);
        }

        public function getAltBody () {
            return $this->altBody;
        }

        public function setImages ($images) {
            $this->images = $images;
        }

        public function getImages () {
            return $this->images;
        }

        public function getAttachments () {
            return $this->anexos;
        }

        public function setAnexos ($attachments) {
            $this->anexos = $attachments;
        }

        public function send () {
            try {
                $mail = new PHPMailer(false);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Username = SELF::$from;
                $mail->Password = SELF::$password;
                $mail->Port = 587;
                $mail->CharSet = "UTF-8";
                $mail->isHTML(true);

                $mail->setFrom(SELF::$from);
                $mail->Subject = $this->getAssunto();
                $mail->Body = $this->getMensagem();
                $mail->AltBody = $this->getAltBody();

                $images = is_array($this->getImages()[0]) ? $this->images : array($this->images);
                foreach($images as $image)
                    $mail->addEmbeddedImage($image[0], $image[1]);

                $addresses = is_array($this->destinatarios) ? $this->destinatarios : [$this->destinatarios];
                foreach($addresses as $address) {
                    if(!$this->verifyEmail($address))
                        return false;
                    else
                        $mail->addAddress($address);
                }

                $attachments = is_array($this->anexos) ? $this->anexos : [$this->anexos];
                foreach($attachments as $attachment)
                    $mail->addAttachment($attachment);

                if($mail->send())
                    return true;
                else
                    return false;
            } catch(Exception $e) {
                echo "<br>" . $mail->Username .
                    "<br>" . $mail->Password . "<br>".
                    $mail->From . "<br>";
                    exit;
            }
        }

        public function __construct ($addresses, $assunto, $mensagem, $altBody, $images = [], $attachments = []) {
            $this->setDestinatarios($addresses);
            $this->setAssunto($assunto);
            $this->setMensagem($mensagem);
            $this->setAltBody($altBody);
            $this->setImages($images);
            $this->setAnexos($attachments);
        }
    }
?>
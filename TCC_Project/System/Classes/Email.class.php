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
        private $anexos;

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
            $this->mensagem = $mensagem ;
        }

        public function getMensagem () {
            return $this->mensagem;
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
                $mail->isHTML(true);

                $mail->setFrom(SELF::$from);
                $mail->Subject = $this->getAssunto();
                $mail->Body = $this->getMensagem();

                $addresses = is_array($this->destinatarios) ? $this->destinatarios : [$this->destinatarios];
                foreach($addresses as $address)
                    $mail->addAddress($address);

                $attachments = is_array($this->anexos) ? $this->anexos : [$this->anexos];
                foreach($attachments as $attachment)
                    $mail->addAttachment($attachment);

                if($mail->send()) {
                    echo "Email enviado com sucesso";
                    exit;
                }
            } catch(Exception $e) {
                echo "<br>" . $mail->Username .
                    "<br>" . $mail->Password . "<br>".
                    $mail->From . "<br>";
                    exit;
            }
        }

        public function __construct ($addresses, $assunto, $mensagem, $attachments = []) {
            $this->setDestinatarios($addresses);
            $this->setAssunto($assunto);
            $this->setMensagem($mensagem);
            $this->setAnexos($attachments);
        }
    }
?>
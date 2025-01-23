<?php

namespace App\Utils;

use PHPMailer\PHPMailer\PHPMailer;

class Mail {
    /**
     * Server variables
     */
    private int $port = 2525;
    private string $host = "sandbox.smtp.mailtrap.io";
    private string $username = "b97c3cb8ff3d9f";
    private string $password = "23e8e5a597a114";

    /**
     * E-mail variables
     */
    private string $from;
    private string $recipient;
    private string $subject;
    private string $body;
    private ?string $fromName = null;
    private ?string $recipientName = null;
    private ?string $reply = null;
    private ?string $replyName = null;
    private ?string $pathToFile = null;

    public function from(string $from, string $name = null) {
        $this->from = $from;
        $this->fromName = $name;
        return $this;
    }

    public function recipient(string $recipient, string $name = null) {
        $this->recipient = $recipient;
        $this->recipientName = $name;
        return $this;
    }

    public function reply(string $reply = null, string $name = null) {
        $this->reply = $reply;
        $this->replyName = $name;
        return $this;
    }

    public function attachment(string $pathToFile) {
        $this->pathToFile = $pathToFile;
        return $this;
    }

    public function subject(string $subject) {
        $this->subject = $subject;
        return $this;
    }

    public function body(string $body) {
        $this->body = $body;
        return $this;
    }

    public function sendMail() {
        try {
            /**
             * SERVER CONFIG
             */
            $phpMailer = new PHPMailer();
            $phpMailer->isSMTP();
            $phpMailer->SMTPAuth = true;
            $phpMailer->Host = $this->host;
            $phpMailer->Username = $this->username;
            $phpMailer->Password = $this->password;
            $phpMailer->Port = $this->port;
            $phpMailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    
            /**
             * EMAIL CONFIG
             */
            $phpMailer->setFrom($this->from, $this->fromName);
            $phpMailer->addAddress($this->recipient, $this->recipientName);
            $phpMailer->addReplyTo($this->reply, $this->replyName);

            /**
             * ATTACHMENTS CONFIG
             */
            $phpMailer->addAttachment($this->pathToFile);

            /**
             * CONTENT CONFIG
             */
            $phpMailer->isHTML(true);
            $phpMailer->CharSet = PHPMailer::CHARSET_UTF8;
            $phpMailer->Encoding = PHPMailer::ENCODING_BASE64;
            $phpMailer->Subject = $this->subject;
            $phpMailer->Body    = $this->body;
            if (!$phpMailer->send()) {
                return false;
            }
    
            return true;
        } catch (\Exception $e) {
            return Notify::notify('error', $e->getMessage());
        }
    }
}
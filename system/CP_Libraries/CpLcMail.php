<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) === basename(__FILE__)) {
    header('Location: 404');
}

/**
 * $mail = new cMail;
 * $file = "path/to/file";
 * $to   = "laudarchzilon@gmail.com";
 * $from = "Tester Jones<no-reply@gmail.com>";
 * $subject = "Here's the file you requested";
 * $message = "Thank you for requesting this File ^^";
 * $mail->mail($to, $from, $subject, $message, $file);
 */
final class CpLcMail implements IMail
{
    private $newline;

    public function __construct($nl = "\n")
    {
        $this->newline = $nl;
    }

    public function mail($to, $from, $subject, $message, $file = '')
    {
        if ($file !== '') {
            $fn = explode('/', $file);
            $filename = $fn[sizeof($fn) - 1];
            $attachment = chunk_split(base64_encode(file_get_contents($file)));
        }
        $uid = md5(uniqid(time()));
        $header = "From: {$from}" . $this->newline;
        $header .= "Reply-To: {$from}" . $this->newline;
        $header .= 'MIME-Version: 1.0' . $this->newline;
        $header .= "Content-Type: multipart/mixed; boundary=\"{$uid}\"" . $this->newline;
        $header .= 'This is a multi-part message in MIME format.' . $this->newline;
        $header .= "--{$uid}" . $this->newline;
        $header .= 'Content-type:text/html; charset="UTF-8"' . $this->newline;
        $header .= 'Content-Transfer-Encoding: 7bit' . $this->newline;
        $header .= $message . $this->newline;

        if ($file !== '') {
            $header .= "--{$uid}" . $this->newline;
            $header .= 'Content-Type: application/octet-stream; name="' . $filename . '"' . $this->newline;
            $header .= 'Content-Transfer-Encoding: base64' . $this->newline;
            $header .= "Content-Disposition: attachment; filename=\"{$filename}\"" . $this->newline;
            $header .= $attachment . $this->newline . $this->newline;
        }
        $header .= '--' . $uid . '--';
        $subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

        return mail($to, $subject, $message, $header) ? true : false;
    }
}

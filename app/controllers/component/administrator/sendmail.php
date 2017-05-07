<?php
// Create the message
$this->configMail();
try{
    $this->mail->setFrom($this->mail->Username, 'HEC - Haiti Event Core');
    $this->mail->addAddress($to, $to_name);     // Add a recipient
    $this->mail->isHTML(true);  // Set email format to HTML

    $this->mail->Subject = $subject;
    $this->mail->Body    = $message;
    //$this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$this->mail->send()) {
        return true;
    } else {
        return true;
    }
} catch (phpmailerException $e) {
      // $e->errorMessage();
      return false;
}
?>

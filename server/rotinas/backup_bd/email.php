<?php
function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
 $file = $path.$filename;
 $file_size = filesize($file);
 $handle = fopen($file, "r");
 $content = fread($handle, $file_size);
 fclose($handle);
 $content = chunk_split(base64_encode($content));
 $uid = md5(uniqid(time()));
 $header = "From: ".$from_name." <".$from_mail.">\r\n";
 $header .= "Reply-To: ".$replyto."\r\n";
 $header .= "MIME-Version: 1.0\r\n";
 $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
 $header .= "This is a multi-part message in MIME format.\r\n";
 $header .= "--".$uid."\r\n";
 $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
 $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
 $header .= $message."\r\n\r\n";
 $header .= "--".$uid."\r\n";
 $header .= "Content-Type: application/octet-stream; name=\"".date('d/m/y').$filename."\"\r\n"; // use different content types here
 $header .= "Content-Transfer-Encoding: base64\r\n";
 $header .= "Content-Disposition: attachment; filename=\"".date('d/m/y').$filename."\"\r\n\r\n";
 $header .= $content."\r\n\r\n";
 $header .= "--".$uid."--";
 if (mail($mailto, $subject, "", $header)) {
 echo "mail send ... OK"; // or use booleans here
 } else {
 echo "mail send ... ERROR!";
 }
}

$data_hoje = date('d/m/y');

$my_file = "backup.sql";
$my_path = "";
$my_name = "Iago Silva";
$my_mail = "iagorrs@gmail.com";
$my_replyto = "iagorrs@gmail.com";
$my_subject = "Backup ". $data_hoje;
$my_message = "Backup da base de dados do servidor da aplicação da Ouvidoria.";
$mail_to = "iagorrs@gmail.com";

mail_attachment($my_file, $my_path, $mail_to, $my_mail, $my_name, $my_replyto, $my_subject, $my_message);

?>
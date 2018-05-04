<?php
	$email=$_POST['textEmail'];
    $token=crypt($email,'acaso');

if(!empty($email)){

          $conn=mysqli_connect(localhost,"stefanophp7", "3pasquaman3", "my_stefanophp7");
          $strSQL=("SELECT * FROM Tusers WHERE Email='".$email."'");
          $query=mysqli_query($conn,$strSQL);
          $numeroRecord=mysqli_num_rows($query);
          if($numeroRecord==1){
      $token=crypt($email,"acaso");

        $to = $email;
        $subject = "email di Ripristino password";

        $message = "
        <html>
        <head>
        <title>Email di ripristino password</title>
        </head>
        <body>
        <table>
        <tr>
        <td>Carissimo cliente, </td>
        </tr>
        <tr>
        <td>quest'email ti permette di ripristinare la password, clicca qui:</td>
        </tr>
        <tr>
        <td><a href='http://dieffecorsop.altervista.org/4-9aprile18-registrazione-email-insert/ripristinopw.php?token=".$token."'>Clicca qui per confermare l'email</a></td>
        </tr>
        </table>
        </body>
        </html>
        ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <iketto@gmail.com>' . "\r\n";

            mail($to,$subject,$message,$headers);
   	echo 'Ti abbiamo inviato un\'email per il recupero della tua password. Controlla la tua email';
      return;
      mysqli_close($conn);
      }
      else{

      echo('devi prima registrarti');
      return;
      mysqli_close($conn);
      }
   }
?>

<form name="formPwDimenticata" id="formPwDimenticata" method="post" action="pwdimenticata.php">
         <p>Inserisci email: </p>
         <input type="text" id="textEmail" name="textEmail"><label id="erroreEmail"></label>
         <br/>
         <input type="button" id="buttonLogin" value="Ripristina mail" onclick="submit()">
</form>

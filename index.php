<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Esercizio Email HTML</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <script>


    function FaseInput(){

      emailString=document.getElementById("email").value;
      passwordString=document.getElementById("password").value;
      confermaPasswordString=document.getElementById("confermaPassword").value;
      nomeString=document.getElementById("nome").value;
      cognomeString=document.getElementById("cognome").value;
      checkboxString=document.getElementById("checkboxCondizioni").value;
      indiceChiocciola=emailString.indexOf("@");
      lunghezzaMail=emailString.length;
      lunghezzaPassword=passwordString.length;
      indiceSpazio=emailString.indexOf(" ");

      // erroriString

      document.getElementById("erroreEmail").innerHTML="";
      document.getElementById("errorePassword").innerHTML="";
      document.getElementById("erroreConfermaPassword").innerHTML="";
      document.getElementById("erroreNome").innerHTML="";
      document.getElementById("erroreCognome").innerHTML="";
      document.getElementById("erroreCheck").innerHTML="";

      errore=false;

      if (indiceChiocciola==-1||lunghezzaMail<6||indiceSpazio!=-1){
        document.getElementById("erroreEmail").innerHTML="Email non valida";
        errore=true;
      }

      if (lunghezzaPassword<6){
        document.getElementById("errorePassword").innerHTML="Password non valida";
        errore=true;
      }

      if (passwordString != confermaPasswordString){
        document.getElementById("erroreConfermaPassword").innerHTML="Password non combacia";
        errore=true;
      }

      if (nomeString==""){
        document.getElementById("erroreNome").innerHTML="Inserisci il tuo nome";
        errore=true;
      }


      if (cognomeString==""){
        document.getElementById("erroreCognome").innerHTML="Inserisci il tuo cognome";
        errore=true;
      }

      if (checkboxCondizioni.checked==false) {
        document.getElementById("erroreCheck").innerHTML="Accetta le condizioni please";
        errore=true;
      }
    }

    function eseguiRegistrati(){
      FaseInput();
      if (errore==false) {
        esercizio_Email.submit();
      }

    }
  </script>
  <body>


<?php

$emailSQL=$_POST['email'];
$passwordSQL=$_POST['password'];
$nomeSQL=$_POST['nome'];
$cognomeSQL=$_POST['cognome'];

//$token=crypt($email,"a caso salt");

$conn=mysqli_connect("localhost","pasquaman", "3P@squaman3", "Luongo");
$str_sql="SELECT * FROM Tusers WHERE Email='$emailSQL'";


$query=mysqli_query($conn,$str_sql);

echo $str_sql;

$numeroRecord=mysqli_num_rows($query);
if ($numeroRecord!=0) {
  echo "Mail già in utilizzo";
}

else {
  echo "<br>";
  $token=crypt($emailSQL,"3f5g6h");
  $str_sql2="INSERT INTO `Tusers`(`UserID`, `Username`, `Password`, `Email`, `Cognome`, `Nome`, `RegistrazioneConfermata`, `Token`) VALUES (NULL,0,'$passwordSQL','$emailSQL','$cognomeSQL','$nomeSQL','0','$token')";
  $query2=mysqli_query($conn,$str_sql2);

  //invio Mail

  $to = $emailSQL;
  $subject = "HTML email";

  $message = "
  <html>
  <head>
  <title>HTML email</title>
  </head>
  <body>
  <p>This email contains HTML Tags!</p>
  <table>
  <tr>
  <th>Firstname</th>
  <th>Lastname</th>
  </tr>
  <tr>
  <td>$nomeSQL</td>
  <td>$cognomeSQL</td>
  </tr>
  </table>
  <h3>Per confermare la registrazione clicca qua</h3>
  <a href='confermaRegistrazione.php?Token=$token'>Conferma Registrazione</a>
  </body>
  </html>
  ";

  // Always set content-type when sending HTML email
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  // More headers
  $headers .= 'From: <webmaster@example.com>' . "\r\n";
  $headers .= 'Cc: myboss@example.com' . "\r\n";

  mail($to,$subject,$message,$headers);

  echo $str_sql2;
}


 ?>

 <!--form di registrazione-->
 <div class="container">
   <form class="form-group" name="esercizio_Email" id="esercizio_Email" action="index.php" method="post">
     <h3>Email:</h3>
     <input type="text" id="email" name="email" value="" placeholder="Inserisci Email"><label id="erroreEmail"></label>
     <h3>Password:</h3>
     <input type="text" id="password" name="password" value="" placeholder="Inserisci Password"><label id="errorePassword"></label>
     <h3>Conferma Password:</h3>
     <input type="text" id="confermaPassword" name="confermaPassword" value="" placeholder="Inserisci nuovamente la Password"><label id="erroreConfermaPassword"></label>
     <h3>Nome:</h3>
     <input type="text" id="nome" name="nome" value="" placeholder="Inserisci il tuo nome"><label id="erroreNome"></label>
     <h3>Cognome:</h3>
     <input type="text" id="cognome" name="cognome" value="" placeholder="Inserisci il tuo cognome"><label id="erroreCognome"></label>
     <h3>Accetta condizioni:</h3>
     <input type="checkbox" id="checkboxCondizioni" name="checkboxCondizioni" value=""><label id="erroreCheck"></label>
     <br>
     <br>
     <h3>Registrati:</h3>
     <button type="button" name="button" class="btn btn-info" onclick="eseguiRegistrati()">Registrati</button>
   </form>



 </div>


 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

   </body>
 </html>

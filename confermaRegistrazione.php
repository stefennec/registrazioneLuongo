<?php

//tramite query string ricevere Token

//va a vedere se quel token esiste SELECT fare if per dare messaggio di non esiste.

// se token esiste registrazione confermata su campo registrazione confermata cambiare a 1 se siamo a 0 fare update e tutto ok

// se registrazione già 1 dire che è già registrato

$getToken=$_GET['Token'];

$conn=mysqli_connect("localhost","pasquaman", "3P@squaman3", "Luongo");
$strSQL="SELECT * FROM Tusers WHERE Token='$getToken'";
$query=mysqli_query($conn,$strSQL);
$numeroRecord=mysqli_num_rows($query);



if ($numeroRecord!=1) {
  echo "Impossibile confermare la registrazione (FINE)";
}
elseif ($numeroRecord==1) {
  $row=mysqli_fetch_assoc($query);
  if ($row=['RegistrazioneConfermata']==1) {
    echo "Sei già Registrato";
  }

  else {
    $strSQL2="UPDATE `Tusers` SET `RegistrazioneConfermata`=1 WHERE `Token`='$getToken'";
    $query=mysqli_query($conn,$strSQL2);
    echo "Abbiamo confermato la tua registrazione";
  }
  echo "<h3>Per confermare la registrazione clicca qua</h3>";
  echo "<a href='login.php'>";

}




echo $strSQL;
echo $strSQL2;
echo $strSQL3;
 ?>

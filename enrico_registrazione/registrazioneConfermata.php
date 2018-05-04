<html>
<head>
      <title>Pagina di conferma registrazione</title>
</head>
<body>
<h1>Com'è il tuo stato di registrazione</h1>
<?php
//1- tramite query string riceve il token
        $token=$_GET['token'];

//2- fai una selezione per vedere se il token c'è, se no utente malintenzionato
//select per verificare se quell'utente esiste
//il token non c'è dentro il db collegamento non valido=> impossibile confermare la registrazione. Fine
//prova da fare
     $conn=mysqli_connect(localhost,"stefanophp7", "3pasquaman3", "my_stefanophp7");
     $strSQL=("SELECT * FROM Tusers WHERE token='".$token."'");
     $query=mysqli_query($conn,$strSQL);
     $numeroRecord=mysqli_num_rows($query);
        if($numeroRecord==0){
             echo('Impossibile registrare conferma di email');
             return;
             mysqli_close($conn);
          }
//3- il token esiste e registrazione confermata =1 registrazione già confermata
    else{
            $row=mysqli_fetch_assoc($query);
            $RegistrazioneConfermata=$row["RegistrazioneConfermata"];
            if($RegistrazioneConfermata==1){
                echo('ti sei già registrato');
                return;
                mysqli_close($conn);
                }
            else{
                $strSQL=("UPDATE Tusers SET RegistrazioneConfermata = '1' WHERE Token = '".$token."'");
                $query=mysqli_query($conn,$strSQL);
                echo('Hai confermato la registrazione');
                return;
                mysqli_close($conn);
            }

    }
//4- se token esiste deve fare l'update e modificare a 1 registrazione confermata->update
//grazie hai completato la registrazione dell'email
//fai clic qui per andare sulla login
?>
</body>
</html>

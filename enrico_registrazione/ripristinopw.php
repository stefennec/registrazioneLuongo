<html>
<head>
      <title>Pagina di ripristino della password</title>
</head>
<body>
<h1>Inserisci la nuova password</h1>
<?php
    session_start();
      $token=$_GET['token'];


      if(!empty($token)){
       $conn=mysqli_connect(localhost,"stefanophp7", "3pasquaman3", "my_stefanophp7");
       $strSQL=("SELECT * FROM Tusers WHERE token='".$token."'");
       $query=mysqli_query($conn,$strSQL);
       $numeroRecord=mysqli_num_rows($query);
          if($numeroRecord==0){
               echo('Impossibile cambiare passsword, assicurarsi di aver cliccato sul codice corretto');
               return;
               mysqli_close($conn);
            }
        else{?>

        <div style="float:right">
        <form name="formCambioPw" id="formCambioPw" method="post" action="changepw.php">
               <p>Inserisci Nuova Password: </p>
               <input type="password" id="newPw" name="newPw"><br/><label id="labelNewPW"></label>
               <br/>
               <p>Conferma Password: </p>
               <input type="password" id="confermaNewPw" name="confermaNewPw"><br/><label id="labelConfirmPW"></label>
               <br/>
                <br/>
               <input type="button" id="buttonChange" value="Cambia Password" onclick="submit()">
        </form>
        </div>
       <?php
       $_SESSION["token"]=$token;
            }
    }
    else{
        echo('OPS sembra che qualcosa sia andato storto');
    }
?>
</body>
</html>

<html>
<head>
      <title>Pagina di registrazione</title>
</head>
<body>
  <script>


    function faseinput()

    {
      document.getElementById("erroreEmail").innerHTML="";
      document.getElementById("errorePassword").innerHTML="";
      document.getElementById("erroreConfermaPassword").innerHTML="";
      document.getElementById("erroreNome").innerHTML="";
      document.getElementById("erroreCognome").innerHTML="";
      document.getElementById("erroreContratto").innerHTML="";

  email=document.getElementById("textEmail").value;
  password=document.getElementById("textPassword").value;
  confermaPassword=document.getElementById("textConfermaPassword").value;
  nome=document.getElementById("textNome").value;
  cognome=document.getElementById("textCognome").value;
  contratto=document.getElementById("checkboxContratto").checked;
  lunghezzaEmail=email.length;
  lunghezzaPassword=password.length;
  lunghezzaConfermaPassword=confermaPassword.length;
  indiceChiocciola=email.indexOf("@");
  indicePunto=email.indexOf(".");
  spazioChiocciola=email.indexOf(" ");
  spazioPassword=password.indexOf(" ");
  spazioConfermaPassword=confermaPassword.indexOf(" ");


  errore=false;

  if (spazioChiocciola!=-1)
  {
    document.getElementById("erroreEmail").innerHTML="Non deve contenere uno spazio";
    errore=true;

  }
  if (spazioPassword!=-1)
  {
    document.getElementById("errorePassword").innerHTML="Non deve contenere uno spazio";
    errore=true;

  }
  if (spazioConfermaPassword!=-1)
  {
    document.getElementById("errorePassword1").innerHTML="Non deve contenere uno spazio";
    errore=true;

  }

    if (contratto.checked==false)
    {
    errore=true;
    document.getElementById("erroreContratto").innerHTML="QUESTO DEVE ESSERE SPUNTATO";
    }

    if (email=="")
      {
        document.getElementById("erroreEmail").innerHTML="INSERIRE EMAIL";
        errore=true;

      }

      if (password=="")
      {
        document.getElementById("errorePassword").innerHTML="INSERIRE PASSWORD";
        errore=true;
      }

      if (confermaPassword=="")
        {
          document.getElementById("erroreConfermaPassword").innerHTML="REINSERIRE PASSWORD";
          errore=true;
        }

    if (lunghezzaEmail<6)
    {
      document.getElementById("erroreEmail").innerHTML="L'EMAIL DEVE AVERE ALMENO 6 CARATTERI";
      errore=true;
    }

    if (indiceChiocciola==-1)
    {
      document.getElementById("erroreEmail").innerHTML="EMAIL DEVE AVERE ALMENO LA CHIOCCIOLA";
      errore=true;
    }

    if (indicePunto==-1)
    {
    document.getElementById("erroreEmail").innerHTML="EMAIL DEVE AVERE ALMENO IL PUNTO";
    errore=true;
    }

    if (lunghezzaPassword<4)
      {
        document.getElementById("errorePassword").innerHTML="EMAIL DEVE AVERE ALMENO 4 caratteri";
        errore=true;
      }

      if (lunghezzaConfermaPassword<4)
      {
        document.getElementById("erroreConfermaPassword").innerHTML="EMAIL DEVE AVERE ALMENO 4 caratteri";
        errore=true;
      }

    if (password!=confermaPassword)
    {
      document.getElementById("erroreConfermaPassword").innerHTML="Le password devono coincidere";
      errore=true;
    }

    if (nome=="")
    {
      document.getElementById("erroreNome").innerHTML="Inserire un nome";
      errore=true;
    }

    if (cognome=="")
    {
      document.getElementById("erroreCognome").innerHTML="Inserire un cognome";
      errore=true;
    }

	if (contratto==false)
    {
    errore=true;
    document.getElementById("erroreContratto").innerHTML="QUESTO DEVE ESSERE SPUNTATO";
    }

    if (errore==true)
    {
      return;
    }


  }
  function registrati()

  {
    faseinput();
    if (errore==false)
    {
      formRegistrazione.submit();
    }

  }

  </script>
  <!--finisco il javascript e ora gli dico con il php di registrare i dati ma se ci sono già di lasciare stare-->
  <?php

        $email=$_POST['textEmail'];
        $password=$_POST['textPassword'];
        $nome=$_POST['textNome'];
        $cognome=$_POST['textCognome'];
	if(!empty($email))
    {



  $conn=mysqli_connect(localhost,"stefanophp7", "3pasquaman3", "my_stefanophp7");
  $strSQL=("SELECT * FROM Tusers WHERE Email='".$email."'");
  $query=mysqli_query($conn,$strSQL);
  $numeroRecord=mysqli_num_rows($query);
  if($numeroRecord==1)
  {
    echo('email già presente');
    return;
    mysqli_close($conn);
  }
  else
  {
  	$token=crypt($email,"acaso");
    //salt=acaso =>la stringa a caso per criptare l'email
    //il token salvato sul db salva l'email e fa clic->aprire la pagina e generare il token)
    $strSQL=("INSERT INTO `my_stefanophp7`.`Tusers` (`UserID`, `UserName`, `Password`, `Email`, `Nome`, `Cognome`, `RegistrazioneConfermata`, `Token`,`FilePathImageAvatar`) VALUES (NULL, 'UserName', '".$password."', '".$email."', '".$nome."', '".$cognome."', '0', '".$token."', 'da definire')");
    $query=mysqli_query($conn,$strSQL);

 	 mysqli_close($conn);

	$to = $email;
	$subject = "email registrazione";
    $message = "
      <html>
      <head>
      <title>HTML email</title>
      </head>
      <body>
      <p><a href='http://stefanophp7.altervista.org/ripassoRegistrazione/registrazioneConfermata.php?token=".$token."'>Clicca qui per confermare l'email</a></p>
      <span>Gentile ".$nome." ".$cognome."</span>
      <table>
      <tr>
      <td>Le inviamo questa email solamente per la pura pecca di essere terrona.</td>
      </tr>
      <tr>
      <td>A mai piu,</td>
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

        header("location: welcome.php");


        }

      }
      ?>


<form name="formRegistrazione" id="formRegistrazione" method="post" action="registrazione.php">
         <p>Inserisci email: </p>
         <input type="text" id="textEmail" name="textEmail"><label id="erroreEmail"></label>
         <br/>
        	 <p>Inserisci Password: </p>
         <input type="password" id="textPassword" name="textPassword"><label id="errorePassword"></label>
         <br/>
         	<p>Conferma Password: </p>
         <input type="password" id="textConfermaPassword" name="textConfermaPassword"><label id="erroreConfermaPassword"></label>
         <br/>
         	<p>Nome: </p>
         <input type="text" id="textNome" name="textNome"><label id="erroreNome"></label>
         <br/>
          <p>Cognome: </p>
         <input type="text" id="textCognome" name="textCognome"><label id="erroreCognome"></label>
         <br/>
         <br/><br/>
         <p>Accetta il contratto: </p><input type="checkbox" id="checkboxContratto"><label id="erroreContratto"></label>
         <br/>
         <input type="button" id="buttonLogin" value="REGISTRATI" onclick="registrati()">
         <label id="vaTuttoBene"></label>

</form>
</body>
<html>

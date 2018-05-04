<?php
    session_start();
    if(isset($_SESSION['Email'])){
          header("location: navigaqui.php");
        }
        $email=$_POST['Email'];
        $_SESSION['email']=$email;
        $password=$_POST['Password'];

        //let's enscrypt in 2 secondi installi il certificato nel tuo sito e poi installi la s
		if(!empty($email))
    {
       $conn=mysqli_connect(localhost,"stefanophp7", "3pasquaman3", "my_stefanophp7");
 	     $strSQL=("SELECT * FROM Tusers WHERE Email='".$email."' AND Password='".$password."'");
       $query=mysqli_query($conn,$strSQL);
       $numeroRecord=mysqli_num_rows($query);
       $row=mysqli_fetch_assoc($query);
       $RegistrazioneConfermata=$row["RegistrazioneConfermata"];
       if ($numeroRecord==0)
  	  {
      	echo("La credenziali inserite non sono corrette");
        mysqli_close($conn);
       }
       else{
     	  if($RegistrazioneConfermata==0){
            	echo('devi confermare la tua email');
                return;
                mysqli_close($conn);
                }
            else{
               header("location: navigaqui.php");
                return;
                mysqli_close($conn);
			}
          }

 	}
?>

<html>
	<head>
    		<title>Pagina di login</title>

    <script>
    function input ()
          {
                  document.getElementById("inserisciLogin").innerHTML="";
                  document.getElementById("inserisciPassword").innerHTML="";
//ora vado a fare la verifica sul valore testuale
                email=document.getElementById("Email").value;
                password=document.getElementById("Password").value;

                  errore=false;
                }
    function verifica ()
      {
        if (email=="")
        {
          document.getElementById("inserisciLogin").innerHTML="Inserire Email Valido";
          errore=true;
         }
         if (password=="")
         {
           document.getElementById("inserisciPassword").innerHTML="Inserire Password Valida";
           errore=true;
          }
        }
      function elaborazione ()
          {
            if (errore){
              return;
          }
          else {

      formLogin.submit();
     		}
      }

        function loggati()
        {
          input()
          verifica()
          elaborazione()
        }

    </script>
    </head>
    <body>
<form name="formLogin" id="formLogin" method="post" action="login.php">
           <p>Inserisci Email: </p>
           <input type="text" id="Email" name="Email"><label id="inserisciLogin"></label>
           <br/>
           <p>Inserisci Password: </p>
           <input type="password" id="Password" name="Password"><label id="inserisciPassword"></label>
           <br/>
            <br/>
           <input type="button" id="buttonLogin" value="LOGIN" onclick="loggati()">
           <br/>
           <a href="pwdimenticata.php">Hai dimenticato la password? Clicca qui</a>
	</form>
	</body>
<html>

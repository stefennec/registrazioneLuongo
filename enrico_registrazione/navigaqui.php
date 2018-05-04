<html>
<head>
      <title>Naviga nella tua area riservata</title>
</head>
<body>
	   <h1>Naviga nella tua area riservata</h1>

    <script>
    function input ()
          {
                  document.getElementById("labelOldPw").innerHTML="";
                  document.getElementById("labelNewPW").innerHTML="";
                  document.getElementById("labelConfirmPW").innerHTML="";
//ora vado a fare la verifica sul valore testuale
                oldPw=document.getElementById("oldPW").value;
                newPw=document.getElementById("newPw").value;
                confNewPw=document.getElementById("confermaNewPw").value;

                  errore=false;
                }
    function verifica ()
      {
        if (oldPw=="")
        {
          document.getElementById("labelOldPw").innerHTML="Inserire la vecchia Password";
          errore=true;
         }
         if (newPw=="")
         {
           document.getElementById("labelNewPW").innerHTML="Inserire la nuova Password";
           errore=true;
          }
          if (confNewPw=="")
         {
           document.getElementById("labelConfermaPW").innerHTML="Confermare la nuova Password";
           errore=true;
          }
          if (newPw!=confNewPw)
   		 {
        document.getElementById("labelConfirmPW").innerHTML="Le password devono coincidere";
       errore=true;
    }
        }
      function elaborazione ()
          {
            if (errore){
              return;
          }
          else {
      formCambioPw.submit();
     		}
      }

        function cambiaPassword()
        {
          input()
          verifica()
          elaborazione()
        }

    </script>
    <?php
      session_start();

      $email=$_SESSION['email'];
      $oldPassword=$_POST['oldPW'];
      $newPassword=$_POST['newPw'];
      $confirmPassword=$_POST['confermaNewPw'];

     echo $oldPassword;

      echo 'benvenuto '.$email;

      if(!empty($oldPassword))
      {
      $conn=mysqli_connect(localhost,"stefanophp7", "3pasquaman3", "my_stefanophp7");
      $strSQL=("SELECT * FROM Tusers WHERE Email='".$email."' AND Password='".$oldPassword."'");
     	$query=mysqli_query($conn,$strSQL);
      $numeroRecord=mysqli_num_rows($query);
    		if($numeroRecord==0){
          		 echo('La password inserita non è corretta');
                 return;
       			 mysqli_close($conn);
         	  }
      else{
        $strSQL=("UPDATE Tusers SET Password = '".$newPassword."' WHERE Email='".$email."'");
                        $query=mysqli_query($conn,$strSQL);
                        echo('<br/> <p> Complimenti, hai cambiato la Password</p>');
                        return;
 		print_r('$strSQL');
      }


}

    ?>
<div style="float:right">
<form name="formCambioPw" id="formCambioPw" method="post" action="navigaqui.php">
           <p>Inserisci Vecchia Password: </p>
           <input type="text" id="oldPW" name="oldPW"><br/><label id="labelOldPw"></label>
           <br/>
           <p>Inserisci Nuova Password: </p>
           <input type="password" id="newPw" name="newPw"><br/><label id="labelNewPW"></label>
           <br/>
           <p>Conferma Password: </p>
           <input type="password" id="confermaNewPw" name="confermaNewPw"><br/><label id="labelConfirmPW"></label>
           <br/>
            <br/>
           <input type="button" id="buttonChange" value="Cambia Password" onclick="cambiaPassword()">
	</form>
    </div>



</body>
</html>

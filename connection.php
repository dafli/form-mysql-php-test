<?php

$con=mysql_connect("localhost","root","" );     //("place of data base","user","password")
mysql_select_db("user");                       //("name of data base")

?>
<html >
<meta charset="utf-8">
<head>
    <title> test connection BD MYSQL with php  </title>
    </head>
    <body style="margin-left: 550px;margin-top: 20px" >

    <?php
    /* fonction de hash password*/
    function NTLMHash($Input) {
        // Convert the password from UTF8 to UTF16 (little endian)
        $Input=iconv('UTF-8','UTF-16LE',$Input);

        // Encrypt it with the MD4 hash
        $MD4Hash=bin2hex(mhash(MHASH_MD4,$Input));

        // You could use this instead, but mhash works on PHP 4 and 5 or above
        // The hash function only works on 5 or above
        //$MD4Hash=hash('md4',$Input);

        // Make it uppercase, not necessary, but it's common to do so with NTLM hashes
        $NTLMHash=strtoupper($MD4Hash);

        // Return the result
        return($NTLMHash);
    }
    ?>

    <?php
    if (isset($_POST['submit'])){
        $var1=$_POST['nom'];
        $var2=$_POST['pren'];
        $var3=$_POST['password'];

        if (($var1 <> ""&&$var2 <> ""&&$var3 <> "" && preg_match("#^[a-z]{3,12}$#i",$var1)!=false &&preg_match("#^[a-z\-]{3,12}$#i",$var2)!=false))
        {
           $var3= NTLMHash($var3);
            mysql_query("INSERT INTO personne VALUES ('$var1','$var2','$var3')");
            echo "Merci de vous être inscrit $var1 , $var2 !";
            exit;
        }
    }
    ?>


        <form  method="post" action="connection.php">
 <div id="div">

                <label>  Nom </label>
                 <input type="text" name="nom"  placeholder="  votre nom" style="margin-left: 56px">


                <?php
                echo "<br>";
                if ( isset($_POST['submit']) ){
                    $var1=$_POST['nom'];
                    if( $var1=="")
                        echo"<label style='color: red'>  Le Nom DOIT être rempli </label>";
                    else if (preg_match("#^[a-z]{3,12}$#i",$var1)==false)
                        echo"<label style='color: slateblue'>  Le Nom est  non valide !! </label>";

                    echo "<br>";
                }

                ?>


                 <label>  Prenom </label>
                  <input type="text" name="pren"  placeholder="  votre prenom" style="margin-left: 40px"">

            <?php
            echo "<br>";
            if ( isset($_POST['submit']) ){
                $var2=$_POST['pren'];
                if( $var2=="")
                    echo"<label style='color: red'>  Le Prenom DOIT être rempli </label>";

                else if (preg_match("#^[a-z\-]{3,12}$#i",$var2)==false)
                    echo"<label style='color: slateblue'>  Le Prenom est  non valide !! </label>";

                echo "<br>";
            }

            ?>


                 <label> Password  </label>
                  <input type="password"name="password"  placeholder="  votre password" style="margin-left: 28px"">


            <?php
            echo "<br>";
            if ( isset($_POST['submit']) ){
                $var3=$_POST['password'];
                if( $var3=="")
                    echo"<label style='color: red'>  Le Mot de Passe DOIT être rempli </label>";
                echo "<br>";
            }

            ?>
             <input type="submit" name="submit" value="Envoyer" style="margin-left: 100px ;margin-top:10px ">

        </form>
    </div>

    </body>
</html>




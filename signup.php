<!DOCTYPE html>
<html lang="en">
<head> 
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <style>
   body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            width: 50%;
            height: calc(100vh - 40px) ;            
            margin: 0 auto;
            padding-top: 20px;
            padding-left: 20px;
            background-color: #f6f6f6;
            border: 2px dashed #333;
            border-radius: 20px;
            text-align: center ;
            position: relative;
        }
        a { display:block;
            position: absolute;
            left: 50% ;
            transform: translateX(-50%);
            bottom: 30px;
            text-decoration: none;
            width: fit-content;
            color: white;
            padding: 20px 40px;
            font-weight: bold;
            transition: 0.3s;
            background-color: red;
        }
        a:hover {
            background-color: #10c4ca;
            color: red;
            cursor: pointer;
            border-radius: 20px;
        }
        </style>
</head>
<body>
<?php
 if(isset($_POST['valider'])){
    $myconn = mysqli_connect("localhost","root",""); 
    if($myconn==false) die("Connexion impossible");
    $selectdb = mysqli_select_db($myconn,"gestion_bus"); 
    if($selectdb==false) die("Database inaccessible");

 $nom = $_POST['nom'] ;
 $prenom = $_POST['prenom'] ;
 $username = $_POST['username'] ;
 $adresse = $_POST['adresse'] ;
 $cin = $_POST['cin'] ;
 $email = $_POST['email'] ;
 $pass = $_POST['pwd'] ;
 $cpass = $_POST['pwdc'] ;
 $check = $_POST['checkstudent'] ;
 $filename = $_FILES["photo"]["name"];
 $tempname = $_FILES["photo"]["tmp_name"];
 $folder = "./image_client/" . $filename;
 if(strcmp($pass,$cpass)!=0) die("<h1>Passwords Are Not Identical</h1>") ;
 $req = " select * from client where cin = '$cin' " ;
 $res = mysqli_query($myconn,$req) ;
 $nb = mysqli_num_rows($res) ;
 if($nb > 0) die("<h1>User Already Exists</h1>") ;
 else {
    
    $req = "insert into client values('$nom', '$prenom', '$username', '$adresse', '$cin', '$email','$filename', '$pass')" ;
    mysqli_query($myconn,$req) ;
    move_uploaded_file($tempname, $folder) ;

    if(strcmp($check,"yes")==0) {
      $filename = $_FILES["carte"]["name"];
      $tempname = $_FILES["carte"]["tmp_name"];
      $folder = "./doc_etud/" . $filename;
      $req = "insert into etudiant(doc,cin) values ('$filename','$cin') " ;
      mysqli_query($myconn,$req) ;
      move_uploaded_file($tempname, $folder) ;
    }
    echo "<h1>Successful Authentication Welcome to our world</h1>" ;
 }
   mysqli_free_result($res) ;
   mysqli_close($myconn) ;   
}
?>
 </div>
  <a href="pay.html">Pay Now</a>
</div>
</body>
</html>
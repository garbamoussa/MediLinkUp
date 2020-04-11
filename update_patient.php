<!--?php 
session_start();
$_SESSION["id_patient"];
?-->
<?php 
    require_once('../inc/config.php');
    require_once('../inc/fonction.inc.php');
//    require_once('inc/header.php');
//    require_once('inc/navbar.php');
//    require_once('inc/head.php');
     ?>

<?php
if (isset($_POST['submit'])) {  // si formulaire soumis

  $fichierpatient ='';
  $fichierpatient = htmlspecialchars($_POST['fichierpatient'],ENT_QUOTES);
  $fichierpatient = ($_POST['fichierpatient']);


 if(isset($_FILES['fichierpatient'])) { 
  debug($_FILES);
              
     $dossier = 'doc_patient/';
     $fichier = basename($_FILES['fichierpatient']['name']);
     $taille_maxi = 100000;
  //Taille du fichier
  $taille = filesize($_FILES['fichierpatient']['tmp_name']);
    
     $extensions = array('.pdf');
  // récupère la partie de la chaine à partir du dernier . pour connaître l'extension.
  $extension = strrchr($_FILES['fichierpatient']['name'], '.');
  //Ensuite on teste
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
  {
     $erreur = 'Vous devez télécharger un fichier de type pdf';
  }

    if($taille>$taille_maxi)
  {
     $erreur = 'Le fichier est trop gros...';
  }



if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{ 
  //On formate le fichierpatient du fichier ici...
  $fichier = strtr($fichier,
     'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
     'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'); 
//On remplace les lettres accentutées par les non accentuées dans $fichier.
//Et on récupère le résultat dans fichier
 
//En dessous, il y a l'expression régulière qui remplace tout ce qui n'est pas une lettre non accentuées ou un chiffre
//dans $fichier par un tiret "-" et qui place le résultat dans $fichier.
$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

if(move_uploaded_file($_FILES['fichierpatient']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Téléchargement effectué avec succès !';
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de au téléchargement !';

     }



} // fin du isset  $erreur

// } // Fin $_files[fichierpatient]

//recupération de l'intitulé du pdf 
$_POST['fichierpatient'] = $_FILES['fichierpatient']['name'];
json_encode($_POST['fichierpatient']);

//changement de l'intitulé du pdf 
$toto = "toto.pdf";
$_POST['fichierpatient']= $toto;


if(!empty($_POST['id'])){

  $mysqli->query ("UPDATE upd_patient (id,descriptif,fichierpatient)

  SET (id,descriptif,fichierpatient)") or die($mysqli->error);
}

/*if (empty($_POST['id'])) {
  $mysqli->query("INSERT INTO upd_patient (descriptif,fichierpatient)

  VALUES ('$_POST[descriptif]','$_POST[fichierpatient]')") or die($mysqli->error);

echo "Succes";
}*/

}

}

?>
<DOCTYPE html>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Multi Step Registration Form Using JQuery Bootstrap in PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />


  <style>
  .box
  {
   width:500px;
   margin:0 auto;
  }
  .active_tab1
  {
   background-color:#fff;
   color:#333;
   font-weight: 600;
  }
  .inactive_tab1
  {
   background-color: #f5f5f5;
   color: #333;
   cursor: not-allowed;
  }
  .has-error
  {
   border-color:#cc0000;
   background-color:#ffff99;
  }
  </style>

 </head>

<body>
 <br />
  <div class="container box">
   <br />
   <h2 align="center"></h2><br />
   
    <div class="tab-content" style="margin-top:0px;">


  <div class="tab-pane active" id="contact_details">
      <div class="panel panel-default" style="background-color:#FFE4C4">
       <div class="panel-heading" style="background-color: #D3D3D3"><h6>Fichier Patient</h6></div>
       <div class="panel-body" style="background-color:#FFE4C4">

    <form class="form-horizontal" method="POST" action="" enctype='multipart/form-data'>
  
        <!--form method="post" id="register_form"-->

          <div class="form-group md-5">                     
            <input type="hidden" name="fichierpatient" value="">
          </div>

        <div class="form-group">
         <!--label>Descriptif :</label-->
         <textarea name ="descriptif" rows="3" cols="3" class="form-control" class="tooltip bottom" title="Entrer une description ou un titre" placeholder="Descriptif"></textarea>
        </div>

     
    <div class="form-row">
        <div class="form-group">
        <input type="file" name="fichierpatient"  class="form-control"class="tooltip bottom" title=" Choisir un fichier en format pdf"  />
        </div>
    </div>


        <div align="center">
         <button type="submit" name="submit"class="btn btn-success" >Envoyez </button>
        </div>

    </div>
        <br />


       </form>

    <!--/form-->
      </div>
</div>
</div>
</div>
</div>
 </body>
 </html>       



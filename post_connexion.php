<?php
//démarrage de session
session_start();

//connexion BDD
// Sous WAMP (Windows)
//include_once "post_bdd_conn.php";
include_once "head.php";

$motdepasseenclair="alex";
$_SESSION['password'] = hash('sha256', $_POST['password']);

if(isset($_SESSION['email']) AND $_SESSION['email']=$_POST['email'])
{
    if(isset($_SESSION['nb_conn']))
    {
        $_SESSION['nb_conn']+=1;
        
        if($_SESSION['password']==hash('sha256',$motdepasseenclair))
        {
            $_SESSION['id']=hash('sha256',time());
            header('Location:vinebody.php');
        }
        else
        {   
        if($_SESSION['nb_conn']>3)
            {
          // TODO : bloquer la session utilisateur     
                ?>
                    <script type="text/javascript">
                        alert('>3 tentatives, contactez administrateur');
                    </script>
                <?php

            }
        }
    }
    
}
else
    {
        $_SESSION['email']=$_POST['email'];
        $_SESSION['nb_conn']=1;
        
        if($_SESSION['password']==hash('sha256',$motdepasseenclair))
        {
            $_SESSION['id']=hash('sha256',time());
            header('Location:vinebody.php');
        }
        else
        {   
        if($_SESSION['nb_conn']>3)
            {
          // TODO : bloquer la session utilisateur OpenLDAP   
                ?>
                    <script type="text/javascript">
                        alert('>3 tentatives, contactez administrateur');
                    </script>
                <?php

            }
        }
    }

?>
   <div class="vertical-align" style="margin:auto; text-align:center" >
       <h5 style="margin:auto; text-align:center"><br><br>Mauvais identifiant ou mot de passe !</h5><br><br>
       
    Vous allez être redirigé dans 5 secondes...<br><br>
       </div>
    
    <?php
    header("refresh:3;url=index.php");
     ?>
 <div style="margin:auto" class="middle preloader-wrapper big active">
    <div class="spinner-layer spinner-blue-only">
      <div class="circle-clipper left">
        <div class="circle"></div>
      </div><div class="gap-patch">
        <div class="circle"></div>
      </div><div class="circle-clipper right">
        <div class="circle"></div>
      </div>
    </div>
  </div>
<?php

header('refresh:3;url=index.php');
?>



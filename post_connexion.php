<?php
//démarrage de session
session_start();

//connexion BDD
// Sous WAMP (Windows)
//include_once "post_bdd_conn.php";
include_once "head.php";

$pwd=$_POST["password"];
$_SESSION['dn'] = $_POST["account"];

$server="localhost";
$port="389";
$dn="cn=".$_SESSION['dn'].",dc=sitevin";

$ds=ldap_connect($server,$port) or die ("Impossible de se connecter au serveur ! \n");
ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

$bind=ldap_bind($ds,$dn,$pwd);

 if(isset($_SESSION['nb_conn']) and (strcmp($_POST["account"],$_SESSION["dn"])==0))
    {
        $_SESSION['nb_conn']+=1;
        
        if($bind==1)
        {
            $_SESSION['id']=hash('sha256',time());
            header('Location:vinebody.php');
        }
        else
        {   
        if($_SESSION['nb_conn']>=3)
            {
          // TODO : bloquer la session utilisateur     
                ?>
                    <script type="text/javascript">
                        alert('>3 tentatives, contactez administrateur');
                    </script>
                  <?php
            }
            ?>
               <div class="vertical-align" style="margin:auto; text-align:center" >
                   <h5 style="margin:auto; text-align:center"><br><br>Mauvais identifiant ou mot de passe !</h5><br><br>
                   
                Vous allez être redirigé dans 5 secondes...<br><br>
                   </div>
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
        }
    }
else
    {
        $_SESSION['nb_conn']=1;

        if($bind==1)
        {
            $_SESSION['id']=hash('sha256',time());
            header('Location:vinebody.php');
        }
        else
        {   
        if($_SESSION['nb_conn']>=3)
            {
          // TODO : bloquer la session utilisateur OpenLDAP   
                ?>
                    <script type="text/javascript">
                        alert('>3 tentatives, contactez administrateur');
                    </script>
                    
                  <?php
            }
            
            ?>
               <div class="vertical-align" style="margin:auto; text-align:center" >
                   <h5 style="margin:auto; text-align:center"><br><br>Mauvais identifiant ou mot de passe !</h5><br><br>
                   
                Vous allez être redirigé dans 5 secondes...<br><br>
                   </div>
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
        }
    }
?>

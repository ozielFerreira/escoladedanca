<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Jaime Arôxa Niterói | Carlinhos de Niterói</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css"/>
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css"/>
  
  <link rel="icon" type="image/png" sizes="32x32" href="/res/site/img/favicon-32x32.png"/>

  <!-- inserindo css do Font Awesome -->
  <link href="/res/site/bootstrap/css/font-awesome.min.css" rel="stylesheet" media="all"/>
  <link rel="stylesheet" href="/res/site/bootstrap/css/bootstrap.css"/>
  <link rel="stylesheet" href="/res/site/css/animate.min.css"/>
  <link rel="stylesheet" href="/res/site/css/estilo.css"/>
  
  <link rel="stylesheet" href="/res/site/css/carousel.css"/>

  <<!-- Commentários do FACEBOOK  -->
  <meta property="og:url" content="http://jaimearoxaniteroi.atwebpages.com/"/>
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="Jaime Aroxa Niteroi"/>
  <meta property="og:description" content="Ambiente ideal para o aprendizado e prática da arte que é dançar!"/>
  <meta property="og:image og:image:width og:image:height" content="http://jaimearoxaniteroi.atwebpages.com/imagens/equipe.jpg"/>
  <meta property="fb:app_id" content="1518140674937267"/>

  <style>
/*  .intro-1 {
    height: 400px;
  }
  .jarallax {
    min-height: 400px;
  }
  @media (min-width: 770px) and (max-width: 1025px) {
    .intro-1 {
      height: 600px;
    }
  }
  @media (max-width: 740px) {
    .intro {
      height: 320px;
    }
    .jarallax {
      min-height: 310px;
    }
  }
  @media (max-width: 414px) {
    .intro-1 {
      height: 200px;
    }
    .jarallax {
      min-height: 200px;
    }
  } */

  .aparelho img{
    background: #E0FFFF;"
    border: 1px solid black;
  }

  .custab {
    border: 0px solid #ccc;
    padding: 5px;
    margin: 5% 0;
    box-shadow: 3px 3px 2px #ccc;
    transition: 0.5s;
    text-align: left;
  }
  .custab:hover{
    box-shadow: 2px 2px 0px transparent;
    transition: 0.5s;
  }
  .thumbnail_prod{
    width: 300px;

  }
  .text-center.img-responsive{
    margin:0 auto;
    width: 80%;
  }

  button.close {
   -webkit-appearance: none;
   padding: 0;
   cursor: pointer;
   background: 0 0;
   border: 0;
 }

 .close {
   float: right;
   font-size: 21px;
   font-weight: 700;
   line-height: 1;
   color: #555;
   text-shadow: 0 1px 0 #000;
   filter: alpha(opacity = 20);
   opacity: inherit;
 }
 .fb-page {
  width: 100%;
  padding: 0px;
  margin: -2px;
}

.fb-comments {
  width: 100%;
  padding: 0px;
  margin: 0px;
}


.social .fa{
  display: inline-block;
  color: rgba(248,248,248,0.75);
  text-decoration: none;
  font-size: 21px;
  padding-left: -1px;
  background: black;
  border-radius: 50%;
  width: 35px;
  height: 35px;
  line-height: 35px;
}
.social .fa-whatsapp:hover {
  background:rgba(52,175,35,0.90);
}
.social .fa-facebook:hover {
  background:rgba(59,89,152,0.90);
}
.social .fa-youtube:hover {
  background:rgba(187,0,0,0.90);
}
.social .fa-instagram:hover {
  background: rgba(81,127,164,0.90);
}
.social a:hover{
  background: white;
  transition: .5s;
}
.social.fa a{
  padding: 5px;
}

</style>

<script>

  function validarEnvio(){

    d = document.envioform;
    e = document.getElementById("e");
    var parte1 = d.email.value.indexOf("@");
    var parte2 = d.email.value.length;
            //VALIDAR O CAMPO NOME


            if(d.nome.value === ""){
                //alert("O campo NOME deve ser preenchido!");
                e.innerHTML="<div class='alert alert-danger'>O campo <b style=font-size:11pt;>nome</b> deve ser preenchido!</div>";
                d.nome.style.backgroundColor = "#000000";
                d.nome.style.color = "#EFFBFB";
                d.nome.focus();
                return false;
              }
                //VALIDAR O CAMPO EMAIL
                if(d.email.value == ""){
                //alert("O campo EMAIL deve ser preenchido!");
                e.innerHTML="<div class='alert alert-danger'>O campo <b style=font-size:11pt;>email</b> deve ser preenchido!</div>";
                d.email.style.backgroundColor = "#000000";
                d.email.style.color = "#EFFBFB";
                d.email.focus();
                return false;
              }
            //VALIDAR EMAIL (VERIFICAR O ENDEREÃO ELETRÃNICO)
            if(!(parte1 >= 3 && parte2 >= 9)){
                //alert("");
                e.innerHTML="<div class='alert alert-danger'>Preencha o campo<b style=font-size:11pt;>email</b> corretamente!<br>Ex: exemplo@exemplo.com.br</div>";
                d.email.style.backgroundColor = "#000000";
                d.email.style.color = "#EFFBFB";
                d.email.focus();
                return false;
              }   

            //VALIDAR O CAMPO Telefone
            if(d.telefone.value == ""){
                //alert("O campo Telefone deve ser preenchido!");
                e.innerHTML="<div class='alert alert-danger'>Preencha o campo<b style=font-size:11pt;>telefone</b> corretamente!</div>";
                d.telefone.style.backgroundColor = "#000000";
                d.telefone.style.color = "#EFFBFB";
                d.telefone.focus();
                return false;
              }

              if(d.ritmo.value == ""){
                e.innerHTML="<div class='alert alert-danger'>Preencha o campo <b style=font-size:11pt;>ritmo</b> corretamente!</div>";
                //alert("O campo Senha deve ser preenchido!");
                d.ritmo.style.backgroundColor = "#000000";
                d.ritmo.style.color = "#EFFBFB";
                d.ritmo.focus();
                return false;
              }

              if(d.assunto.value == ""){
                e.innerHTML="<div class='alert alert-danger'>Preencha o campo <b style=font-size:11pt;>assunto</b> corretamente!</div>";
                //alert("O campo Senha deve ser preenchido!");
                d.assunto.style.backgroundColor = "#000000";
                d.assunto.style.color = "#EFFBFB";
                d.assunto.focus();
                return false;
              }



              if(d.mensagem.value == ""){
                e.innerHTML="<div class='alert alert-danger'>Preencha o campo <b style=font-size:11pt;>mensagem</b> corretamente!</div>";
                //alert("O campo Senha deve ser preenchido!");
                d.mensagem.style.backgroundColor = "#000000";
                d.mensagem.style.color = "#EFFBFB";
                d.mensagem.focus();
                return false;
              }

              if (document.envioform.mensagem.value.length == 0) {
                var alerta = document.getElementById('alerta');
                alerta.textContent = "Mensagem enviada com Sucesso!";
              }


              document.envioform.submit(); 

            }
          </script>



          <script type="text/javascript">
            var controle = 4;
            function mudaEstilo() {
              var objDiv = document.getElementById('myPage');

              if (controle == 0) {
                controle++;
                objDiv.style.color = "#000000";
                objDiv.style.background = "#FFFFFF";

              } else if (controle == 1) {controle++;
                objDiv.style.color = "#FFFFFF";
                objDiv.style.background = "#FE2E2E";

              }  else if (controle == 2) {controle++;
                objDiv.style.color = "#000000";
                objDiv.style.background = "#A9E2F3";

              } else if (controle == 3) {controle++;
                objDiv.style.color = "#FFFFFF";
                objDiv.style.background = "#848484";

              } else {controle = 0;
                objDiv.style.color = "#FF0000";
                objDiv.style.background = "#FFFFD4";

              }
            }
          </script>

          <!-- FIM DA OUTRA FORMA -->
          <style type="text/css" media="screen">
          @media (max-width: 320px) 
          {
            body
            {
              width: 100% !important;
            }
          }
        </style>
        <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Oswald:300,400,700);
        @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic);

        /* Override UGG site */
        #main {width: 100%; padding:0;}
        .content-asset p {margin:0 auto;}
        .breadcrumb {display:none;}

        /* Helpers */
        /**************************/
        .margin-top-10 {padding-top:10px;}
        .margin-bot-10 {padding-bottom:10px;}

        /* Typography */
        /**************************/
        #parallax-world-of-ugg h1 {font-family:'Oswald', sans-serif; font-size:24px; font-weight:400; text-transform: uppercase; color:black; padding:0; margin:0;}
        #parallax-world-of-ugg h2 {font-family:'Oswald', sans-serif; font-size:35px; letter-spacing:5px; text-align:center; color:white; font-weight:400; text-transform:uppercase; z-index:10; opacity:.9;}
        #parallax-world-of-ugg h3 {font-family:'Oswald', sans-serif; font-size:14px; line-height:0; font-weight:400; letter-spacing:2px; text-transform: uppercase; color:black;}
        #parallax-world-of-ugg p {font-family:'Source Sans Pro', sans-serif; font-weight:400; font-size:14px; line-height:24px;}
        .first-character {font-weight:400; float: left; font-size: 84px; line-height: 64px; padding-top: 4px; padding-right: 8px; padding-left: 3px; font-family: 'Source Sans Pro', sans-serif;}

        .sc {color: #3b8595;}
        .ny {color: #3d3c3a;}
        .atw {color: #c48660;}

        /* Section - Title */
        /**************************/
        #parallax-world-of-ugg .title {background: white; padding: 60px; margin:0 auto; text-align:center;}
        #parallax-world-of-ugg .title h1 {font-size:35px; letter-spacing:8px; margin-left: -20px;}

        /* Section - Block */
        /**************************/
        #parallax-world-of-ugg .block {background: white; padding: 60px; width:420px; margin:0 auto; text-align:justify;}
        #parallax-world-of-ugg .block-gray {background: #f2f2f2;padding: 60px;}
        #parallax-world-of-ugg .section-overlay-mask {position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: black; opacity: 0.70;}

        /* Section - Parallax */
        /**************************/

        /* Extras */
        /**************************/
        #parallax-world-of-ugg .line-break {border-bottom:1px solid black; width: 150px; margin:0 auto;}

        /* Media Queries */
        /**************************/
        @media screen and (max-width: 959px) and (min-width: 768px) {
          #parallax-world-of-ugg .block {padding: 40px; width:620px;}
        }
        @media screen and (max-width: 767px) {
          #parallax-world-of-ugg .block {padding: 30px; width:420px;}
          #parallax-world-of-ugg h2 {font-size:20px;}
          #parallax-world-of-ugg .block {padding: 30px;}
        }
        @media screen and (max-width: 479px) {
          #parallax-world-of-ugg .block {padding: 30px 15px; width:290px;}
        }

        /* Section - Parallax */
        /**************************/
     /*   #parallax-world-of-ugg .parallax-one {padding-top: 200px; padding-bottom: 200px; overflow: hidden; position: relative; width: 100%; background-image: url(/res/site/img/background-1.jpg?dpr=1&auto=format&fit=crop&w=1500&h=938&q=80&cs=tinysrgb&crop=); background-attachment: fixed; background-size: cover; -moz-background-size: cover; -webkit-background-size: cover; background-repeat: no-repeat; background-position: top center;}
        #parallax-world-of-ugg .parallax-two {padding-top: 200px; padding-bottom: 200px; overflow: hidden; position: relative; width: 100%; background-image: url(/res/site/img/background-azul.png?dpr=1&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop=); background-attachment: fixed; background-size: cover; -moz-background-size: cover; -webkit-background-size: cover; background-repeat: no-repeat; background-position: center center;}
        #parallax-world-of-ugg .parallax-three {padding-top: 200px; padding-bottom: 200px; overflow: hidden; position: relative; width: 100%; background-image: url(/res/site/img/background-2.jpg?dpr=1&auto=format&fit=crop&w=1500&h=1001&q=80&cs=tinysrgb&crop=); background-attachment: fixed; background-size: cover; -moz-background-size: cover; -webkit-background-size: cover; background-repeat: no-repeat; background-position: center center;}
        #parallax-world-of-ugg .parallax-four {padding-top: 200px; padding-bottom: 200px; overflow: hidden; position: relative; width: 100%; background-image: url(/res/site/img/background-degrade.jpg?dpr=1&auto=format&fit=crop&w=1500&h=1001&q=80&cs=tinysrgb&crop=); background-attachment: fixed; background-size: cover; -moz-background-size: cover; -webkit-background-size: cover; background-repeat: no-repeat; background-position: center center;}
        #parallax-world-of-ugg .parallax-five {padding-top: 200px; padding-bottom: 200px; overflow: hidden; position: relative; width: 100%; background-image: url(/res/site/img/background-praia.jpg?dpr=1&auto=format&fit=crop&w=1500&h=1001&q=80&cs=tinysrgb&crop=); background-attachment: fixed; background-size: cover; -moz-background-size: cover; -webkit-background-size: cover; background-repeat: no-repeat; background-position: center center;}
        #parallax-world-of-ugg .parallax-six {padding-top: 200px; padding-bottom: 200px; overflow: hidden; position: relative; width: 100%; background-image: url(/res/site/img/parallax-1.jpg?dpr=1&auto=format&fit=crop&w=1500&h=1001&q=80&cs=tinysrgb&crop=); background-attachment: fixed; background-size: cover; -moz-background-size: cover; -webkit-background-size: cover; background-repeat: no-repeat; background-position: center center;}
        #parallax-world-of-ugg .parallax-seven {padding-top: 200px; padding-bottom: 200px; overflow: hidden; position: relative; width: 100%; background-image: url(/res/site/img/background_contato.jpg?dpr=1&auto=format&fit=crop&w=1500&h=1001&q=80&cs=tinysrgb&crop=); background-attachment: fixed; background-size: cover; -moz-background-size: cover; -webkit-background-size: cover; background-repeat: no-repeat; background-position: center center;}
        #parallax-world-of-ugg .parallax-eight {padding-top: 100px; padding-bottom: 150px; overflow: hidden; position: relative; width: 100%; background-image: url(/res/site/img/background_contato.jpg?dpr=1&auto=format&fit=crop&w=1500&h=1001&q=80&cs=tinysrgb&crop=); background-attachment: fixed; background-size: cover; -moz-background-size: cover; -webkit-background-size: cover; background-repeat: no-repeat; background-position: center center;}
        #parallax-world-of-ugg .parallax-nine {padding-top: 100px; padding-bottom: 150px; overflow: hidden; position: relative; width: 100%; background-image: url(/res/site/img/background-preto.jpg?dpr=1&auto=format&fit=crop&w=1500&h=1001&q=80&cs=tinysrgb&crop=); background-attachment: fixed; background-size: cover; -moz-background-size: cover; -webkit-background-size: cover; background-repeat: no-repeat; background-position: center center;}
*/

        .ender p{
          font-size: 95% !important;
          font-family: Lato sans-serif;
        }

      </style>

    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

      <!-- CURTIR -->
      <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=1518140674937267';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>


      <!-- COMENTARIOS -->
      <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.11&appId=1518140674937267';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- TIMELINE -->
      <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=1518140674937267';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>


      <!-- PAINEL DO FACEBOOK -->
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '1518140674937267',
            xfbml      : true,
            version    : 'v2.10'
          });
          FB.AppEvents.logPageView();
        };

        (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "https://connect.facebook.net/pt_BR/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
     </script>

     <!-- ABRIR MENSSAGER NO MODAL-->

     <script>
      (function(d, s, id) {
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) return;
       js = d.createElement(s); js.id = id;
       js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'))
      <div class='fb-page' data-href='https://www.facebook.com/hidemiphone/' data-tabs='messages' data-width='320' data-height='500' data-small-header='false' data-adapt-container-width='true' data-hide-cover='false' data-show-facepile='false'>
      <blockquote cite='https://www.facebook.com/hidemiphone/' class='fb-xfbml-parse-ignore'>
      <a href='https://www.facebook.com/hidemiphone/'>Conserto de iPhones e iPads</a>
      </blockquote>
      </div>
    </script>
    <!-- FIM MENSSAGER NO MODAL-->

    <nav class="navbar navbar-default navbar-fixed-top">
    <!-- <input class="btn btn-outline btn-default btn-xs btn-block" type="button" onclick="mudaEstilo()" value="Alterar fonte e background">
      <button class="btn btn-outline btn-default btn-xs btn-block"> Escolha sua cor de preferência?</button> -->

      <!-- Top Navbar -->
      <div class="top_nav">
        <div class="container">
          <ul class="list-inline info">
            <li><a href="tel:212704-8558/"><span class="fa fa-phone"></span> 21 2704-8558</a></li>
            <li><a href="mailto:jaimearoxaniteroifilial@gmail.com"><span class="fa fa-envelope"></span> jaimearoxaniteroifilial@gmail.com</a></li>
            <li><a href="#"><span class="fa fa-clock-o"></span> Seg/Sex 16hs-22hs - Sáb 16hs-20hs</a></li>
          </ul>
          <ul class="list-inline social_icon">
            <li><a href="https://www.facebook.com/jaimearoxaniteroi/" target="_blank"><span class="fa fa-facebook" style="font-size: 14px;"></span></a></li>
            <li><a href="https://www.instagram.com/jaimearoxaniteroi/" target="_blank"><span class="fa fa-instagram" style="font-size: 14px;"></span></a></li>
            <li><a href="https://www.youtube.com/channel/UC0fEs0WekTUlg9qXAqFPSMA" target="_blank"><span class="fa fa-youtube" style="font-size: 14px;"></span></a></li>
            <li><a href="https://api.whatsapp.com/send?phone=5521999244944&text=Deixe%20sua%20mensagem!%20Entraremos%20em%20contato%20o%20mais%20breve%20poss%C3%ADvel.%20Agradecemos%20o%20contato!" target="_blank"><span class="fa fa-whatsapp" style="font-size: 14px;"></span></a></li>
          </ul>
              <!-- ENDEREÇO YOUTUBE DA ESCOLA
                   https://www.youtube.com/channel/UC04ph8Gy11wo-GIpzfD60mQ
                 -->
               </div>
             </div><!-- Top Navbar end -->

             <div class="container">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <div><span class="text-center">MENU</span></div>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#myPage"><img class="img img-responsive logo" src="/res/site/img/logo-ja-niteroi-branco.png" alt="" style="width: 215px; margin-top:-12px;"></a>
              </div>
              <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="#home">HOME</a></li>
                  <!-- criação do menu dorpdown -->
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ESCOLA<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#carlinho_niteroi">Carlinhos de Niterói</a></li>
                      <li><a href="#evento">Nossos Eventos</a></li>
                      <li><a href="#equipe">Nossa Equipe</a></li>
                    </ul>
                  </li>
                  <li><a href="#ritmos">RITMOS</a></li>
                  <li><a href="#horario">HORÁRIOS</a></li>
                  <li><a href="#video">VIDEOS</a></li>
                  <!-- criação do menu dorpdown -->
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CONTATO<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#contato">Fale Conosco</a></li>
                      <li><a href="#ondeEstamos">Onde Estamos</a></li>
                      <li><a href="#comentarios">Comentários</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <!--  -->

          <script>
           $(function () {
            $('.navbar-collapse ul li a(.dropdown-toggle)').bind('click touchstart', function () {
              $('.navbar-toggle:visible').click();

              $(".nav li a").click(function() {
                $(".navbar-collapse").collapse('hide');

              });

            });
          });
        </script>
        <!--  -->
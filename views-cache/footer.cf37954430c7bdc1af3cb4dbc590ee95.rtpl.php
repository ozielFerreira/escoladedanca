<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- MENSAGEM DO ICONE -->
<div id="titulo_fixo">
  <h4 style="color: red;"></h4>
</div>
<!-- ICONES REDES SOCIAIS -->
<div>
  <a class="btn btn-link btn-xs" id="botao_fixo" data-placement="left" data-toggle="popover" data-trigger="hover" data-content="Envie uma Mensagem">
    <img src="/res/site/img/icone-compartilhar-preto.png" width="50" height="50" position="fixed" float="right" class="img-circle" style="border-radius: 50%;"></a>
  </div>
  <div id="redes_sociais" class="Rsocial text-center" position="fixed" style="height:170px;width:40px;display:none;bottom:60px;float: right; margin-right: 10px;">
    <br>
    <a href="https://www.instagram.com/jaimearoxaniteroi/" target="_blanck">
      <img src="/res/site/img/icone-instagram.png" class="img-responsive" alt="instagram" alt="" onclick="instagram()" float="left" style="width: 40px;">
    </a>
    <a href="https://api.whatsapp.com/send?phone=5521999244944&text=Deixe%20sua%20mensagem!%20Entraremos%20em%20contato%20o%20mais%20breve%20poss%C3%ADvel.%20Agradecemos%20o%20contato!" target="_blanck">
      <img src="/res/site/img/icone-whatsapp-iphone.png" class="img-resnposive" alt="whatsapp" alt="" onclick="whatsapp()" float="left" style="width: 40px;">
    </a>
    <a href="#" data-toggle="modal" data-target="#myMenssager" target="_blanck"><img src="/res/site/img/icone-facebook-messenger.png" class="img-responsive" alt="menssager" alt="" onclick="menssager()" float="left" style="width: 40px;">
    </a>
  </div>
  <!-- Container (COMENTARIOS Sessão) -->
  <div  class="container-fluid" id="comentarios" style="background-image: url(/res/site/img/background-1.jpg);">
    <h2 style="font-size:15pt;font-family:'Oswald', sans-serif;letter-spacing:5px; text-align:center; color:white; font-weight:400; text-transform:uppercase; z-index:10; opacity:.9;">COMENTÁRIOS</h2>
    <h4 class="text-center" style="color:white;">Estamos no facebook!</h4>


    <!-- TESTE PAGINA FACEBOOK NO SITE-->


    <div class="row slideanim">

      <div class="col-sm-5" style="padding:40px;">
        <div class="text-center">
          <h2 class="text-center" style="color:white;font-size:12pt;font-family:'Oswald', sans-serif;letter-spacing:5px; text-align:center; font-weight:400; text-transform:uppercase; z-index:10; opacity:.9;">Curta nossa página!</h2>
          <hr>

          <center> 
           <div class="fb-page" 
           data-href="https://www.facebook.com/jaimearoxaniteroi/"
           data-width="270" 
           data-hide-cover="false"
           data-show-facepile="true">
           <blockquote cite="https://www.facebook.com/jaimearoxaniteroi" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/jaimearoxaniteroi">Escola de Dança Jaime Arôxa Carlinhos de Niterói</a></blockquote></div>
         </center>
       </div>
     </div>
     <div class="col-sm-2 hidden-xs"><img src="/res/site/img/logo-academia.jpg" class="img-responsive" alt="" style="width: 75%; margin: 0 auto;"></div>


     <div class="col-sm-5" style="background-color:#323233;margin-top:50px;">
      <div class="text-center">
       <h2 class="text-center" style="font-size:12pt;font-family:'Oswald', sans-serif;letter-spacing:5px; text-align:center; color:white; font-weight:400; text-transform:uppercase; z-index:10; opacity:.9;">Deixei seu comentário.</h2>
       <hr>
       <div class="fb-comments" data-href="https://www.facebook.com/jaimearoxaniteroi/" data-mobile="true" data-width="100%" data-numposts="5" data-colorscheme="dark"></div>
     </div>
   </div>
 </div>
</div>

<footer id="rodape" class="container-fluid text-center" style="padding:100px;">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <img class="img img-responsive" src="/res/site/img/logo-ja-niteroi-branco.png" alt="Jaime Aroxa Niteroi" style="width:120px;margin:0 auto;">
  <p><a href="#" target="_blank" title="Jaime Arôxa Niterói | Carlinhos de Niterói">&copy;2017 Todos direitos reservados </a><br>| <br>Desenvolvido por Oziel Ferreira <br>Escola de Dança Jaime Arôxa Niterói</p>
</footer>

<script src="/res/site/bootstrap/js/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="/res/site/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $("#infoAulas").popover({
      placement : 'top',
      title: '<h3 class="custom-title text-center"><span class="glyphicon glyphicon-info-sign"></span> RITMOS</h3>',
      content : "<p> <mark><strong>DANÇA DE SALÃO</strong></mark>.</p><p>Bolero<br>Soltinho<br>Samba</p><p> <mark><strong>RITMOS QUENTES</strong></mark>.</p><p>Forró<br>Salsa<br>Zouk</p>Forró e Salsa<br>Salsa e Zouk<br>Forró<br>Samba de Gafieira<br>Salsa<br>Tango<br>Aula Particular<br>Nunca dancei",
      html: true
    }); 
    
    $("#botao_fixo").popover({
      placement : 'left',
      trigger: 'hover',
      content : "<p> <mark><strong>DANÇA DE SALÃO</strong></mark>.</p><p> <mark><strong>Bootstrap popover</strong></mark>.</p><p> <mark><strong>Bootstrap popover</strong></mark>.</p>",
      html: true
    }); 
  });
</script>

<script>
  $(function(){
   $('#msg').fadeOut(5000);
 });
</script>

<script src="/res/site/bootstrap/js/jquery.mask.js"></script>
<script src="/res/site/js/efeito-pagina.js"></script>
<script src="/res/site/js/contato.js"></script>
<script src="/res/site/js/validator.js"></script>

<script type="text/javascript" src="/res/site/js/jarallax.js"></script>
<script type="text/javascript" src="/res/site/js/jarallax-video.js"></script>
<script>
  new WOW().init();
</script>

</body>
</html>
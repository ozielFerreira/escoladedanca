<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista da Equipe
    </h1>
    <ol class="breadcrumb">
      <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="/admin/equipes">equipes</a></li>
      <li class="active"><a href="/admin/equipes/create">Cadastrar</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
     <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Novo membro da equipe</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/equipes/create" method="post">
          <div class="box-body">

            <div class="form-group">
              <label for="tituloequipe">Função</label>
              <input type="text" class="form-control" id="tituloequipe" name="tituloequipe" placeholder="Digite a função do membro da equipe.">
            </div>

            <div class="form-group">
              <label for="descequipe">Nome</label>
              <textarea class="form-control" id="descequipe" name="descequipe" placeholder="Digite o nome do membro da equipe" style="resize:none; height:80px;" maxlength="50"></textarea>
            </div>

            <div class="form-group">
              <label for="urlequipe">URL</label>
              <input type="text" class="form-control" id="urlequipe" name="urlequipe" placeholder="Digite uma URL Amigável - Exemplo: fulano-de-tal-jaime-aroxa-niteroi">
            </div>

            <div class="form-group">
              <label for="urlfacebook">Link do Facebook</label>
              <input type="url" class="form-control" id="urlfacebook" name="urlfacebook" placeholder="Cole a URL aqui..." pattern=".*\.facebook\..*" title="A URL deve ser de dominio do facebook">
              <small class="text-primary"> <strong>Exemplo:</strong> https://www.facebook.com/<mark>nome_do_perfil</mark></small>
                  <span class="validity"></span>
            </div>

            <div class="form-group">
              <label for="urlyoutube">Link do Youtube</label>
              <input type="url" class="form-control" id="urlyoutube" name="urlyoutube" placeholder="Cole a URL aqui..." pattern=".*\.youtube\..*" title="A URL deve ser de dominio do youtube">
              <small class="text-primary"> <strong>Exemplo:</strong> https://www.youtube.com/user/<mark>nome_do_perfil</mark></small>
                  <span class="validity"></span>
            </div>

            <div class="form-group">
              <label for="urlinstagram">Link do Instagram</label>
              <input type="url" class="form-control" id="urlinstagram" name="urlinstagram" placeholder="Cole a URL aqui..." pattern=".*\.instagram\..*" title="A URL deve ser de dominio do instagram">
              <small class="text-primary"> <strong>Exemplo:</strong> https://www.instagram.com/<mark>nome_do_perfil</mark></small>
                  <span class="validity"></span>
            </div>

            <div class="form-group">
              <label for="urlwhatsapp">Link do Whatsapp</label>
              <input type="url" class="form-control" id="urlwhatsapp" name="urlwhatsapp" placeholder="Copie o exemplo aqui... Troque o número marcado por seu Nº de celular" pattern=".*\.whatsapp\..*" title="A URL deve ser de dominio do whatsapp">
                  <span class="validity"></span>
              <h5><strong>Exemplo:</strong> https://api.whatsapp.com/send?phone=5521<mark>123456789</mark>&text=Deixe%20sua%20mensagem!</h5>
            </div>
<!--             <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
            </div> -->
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-success">Cadastrar</button>
              <a href="/admin/equipes" class="btn btn-primary">
                <i class="fa fa-undo"></i> Voltar</a>
              </div>
            </form>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
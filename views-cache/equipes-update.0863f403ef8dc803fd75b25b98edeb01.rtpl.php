<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista da Equipe
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
     <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar membros da equipe</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/equipes/<?php echo htmlspecialchars( $equipe["idequipe"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="tituloequipe">Nome</label>
              <input type="text" class="form-control" id="tituloequipe" name="tituloequipe" placeholder="Altere o nome do membro da equipe" value="<?php echo htmlspecialchars( $equipe["tituloequipe"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

            <div class="form-group">
              <label for="descequipe">Função</label>
              <textarea class="form-control" id="descequipe" name="descequipe" placeholder="Digite a função..." style="resize:none; height:80px;" maxlength="50"><?php echo htmlspecialchars( $equipe["descequipe"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
            </div>

            <div class="form-group">
              <label for="urlequipe">URL</label>
              <input type="text" class="form-control" id="urlequipe" name="urlequipe" placeholder="Digite a url amigável" value="<?php echo htmlspecialchars( $equipe["urlequipe"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

            <div class="form-group">
              <label for="urlfacebook">Link do Facebook</label>
              <input type="url" class="form-control" id="urlfacebook" name="urlfacebook" pattern=".*\.facebook\..*" title="A URL deve ser de dominio do facebook" value="<?php echo htmlspecialchars( $equipe["urlfacebook"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              <small class="text-primary"> <strong>Exemplo:</strong> https://www.facebook.com/<mark>nome_do_perfil</mark></small>
                  <span class="validity"></span>
            </div>

            <div class="form-group">
              <label for="urlyoutube">Link do Youtube</label>
              <input type="url" class="form-control" id="urlyoutube" name="urlyoutube" pattern=".*\.youtube\..*" title="A URL deve ser de dominio do youtube" value="<?php echo htmlspecialchars( $equipe["urlyoutube"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              <small class="text-primary"> <strong>Exemplo:</strong> https://www.youtube.com/user/<mark>nome_do_perfil</mark></small>
                  <span class="validity"></span>
            </div>

            <div class="form-group">
              <label for="urlinstagram">Link do Instagram</label>
              <input type="url" class="form-control" id="urlinstagram" name="urlinstagram" pattern=".*\.instagram\..*" title="A URL deve ser de dominio do instagram" value="<?php echo htmlspecialchars( $equipe["urlinstagram"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              <small class="text-primary"> <strong>Exemplo:</strong> https://www.instagram.com/<mark>nome_do_perfil</mark></small>
                  <span class="validity"></span>
            </div>

            <div class="form-group">
              <label for="urlwhatsapp">Link do Whatsapp</label>
              <input type="url" class="form-control" id="urlwhatsapp" name="urlwhatsapp" placeholder="Copie o exemplo aqui... Troque o número marcado por seu Nº de celular" required pattern=".*\.whatsapp\..*" title="A URL deve ser de dominio do whatsapp" value="<?php echo htmlspecialchars( $equipe["urlwhatsapp"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  <span class="validity"></span>
              <h5><strong>Exemplo:</strong> https://api.whatsapp.com/send?phone=5521<mark>123456789</mark>&text=Deixe%20sua%20mensagem!</h5>
            </div>

            <div class="form-group">
              <label for="file">Foto</label>
              <input type="file" class="form-control" id="file" name="file" value="<?php echo htmlspecialchars( $equipe["desphotoequipes"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              <div class="box box-widget">
                <div class="box-body">
                  <img class="img-responsive" id="image-preview" src="<?php echo htmlspecialchars( $equipe["desphotoequipes"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Photo" style="height: 300px">
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-success">Salvar</button>

          <a href="/admin/equipes" class="btn btn-primary">
            <i class="fa fa-undo"></i> Voltar
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
  document.querySelector('#file').addEventListener('change', function(){

    var file = new FileReader();

    file.onload = function() {

      document.querySelector('#image-preview').src = file.result;

    }

    file.readAsDataURL(this.files[0]);

  });
</script>
<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Videos
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
     <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Videos</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/videos/<?php echo htmlspecialchars( $video["idvideo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">
          <div class="box-body">

            <div class="form-group">
              <label for="urlvideo">URL Video</label>
              <input type="url" class="form-control" id="urlvideo" name="urlvideo" placeholder="Exemplo: https://www.youtube.com/embed/IONhts0TdR4" value="<?php echo htmlspecialchars( $video["urlvideo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required pattern=".*\.youtube\..*" title="A URL deve ser de dominio do youtube">
            </div>

            <div class="form-group">
              <label for="titulovideo">Titulo</label>
              <input type="text" class="form-control" id="titulovideo" name="titulovideo" placeholder="Digite o titulo" value="<?php echo htmlspecialchars( $video["titulovideo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="33">
            </div>

            <div class="form-group">
              <label for="descvideo">Descrição</label>
              <input type="text" class="form-control" id="descvideo" name="descvideo" placeholder="Descrição" value="<?php echo htmlspecialchars( $video["descvideo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="43">
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-success">Salvar</button>
          <a href="/admin/videos" class="btn btn-primary">
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
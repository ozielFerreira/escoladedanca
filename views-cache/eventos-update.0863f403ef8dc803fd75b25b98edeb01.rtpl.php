<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Eventos
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
     <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Eventos</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/eventos/<?php echo htmlspecialchars( $evento["idevento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="tituloevento">Titulo</label>
              <input type="text" class="form-control" id="tituloevento" name="tituloevento" placeholder="Digite o titulo" value="<?php echo htmlspecialchars( $evento["tituloevento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

            <div class="form-group">
              <label for="desurl">URL</label>
              <input type="text" class="form-control" id="desurl" name="desurl" placeholder="Digite a url amigável" value="<?php echo htmlspecialchars( $evento["desurl"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

            <div class="form-group">
              <label for="descevento">Descrição</label>
              <textarea class="form-control" id="descevento" name="descevento" placeholder="Descrição" style="resize:none; height:150px;" maxlength="1000"><?php echo htmlspecialchars( $evento["descevento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
            </div>

            <div class="form-group">
              <label for="file">Foto</label>
              <input type="file" class="form-control" id="file" name="file" value="<?php echo htmlspecialchars( $evento["desphotoeventos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              <div class="box box-widget">
                <div class="box-body">
                  <img class="img-responsive" id="image-preview" src="<?php echo htmlspecialchars( $evento["desphotoeventos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Photo" style="height: 300px">
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-success">Salvar</button>

          <a href="/admin/eventos" class="btn btn-primary">
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
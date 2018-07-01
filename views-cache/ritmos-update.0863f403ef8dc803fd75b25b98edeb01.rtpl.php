<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Ritmos
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
     <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Ritmos</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/ritmos/<?php echo htmlspecialchars( $ritmo["idritmo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="tituloritmo">Nome Ritmo</label>
              <input type="text" class="form-control" id="tituloritmo" name="tituloritmo" placeholder="Digite o titulo" value="<?php echo htmlspecialchars( $ritmo["tituloritmo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

            <div class="form-group">
              <label for="descritmo">Descrição</label>
              <textarea class="form-control" id="descritmo" name="descritmo" placeholder="Descrição" style="resize:none; height:100px;" maxlength="500"><?php echo htmlspecialchars( $ritmo["descritmo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
            </div>

            <div class="form-group">
              <label for="desurlritmo">URL</label>
              <input type="text" class="form-control" id="desurlritmo" name="desurlritmo" placeholder="Digite a url amigável" value="<?php echo htmlspecialchars( $ritmo["desurlritmo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

            <div class="form-group">
              <label for="file">Foto</label>
              <input type="file" class="form-control" id="file" name="file" value="<?php echo htmlspecialchars( $ritmo["desphotoritmos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              <div class="box box-widget">
                <div class="box-body">
                  <img class="img-responsive" id="image-preview" src="<?php echo htmlspecialchars( $ritmo["desphotoritmos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Photo" style="height: 300px">
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-success">Salvar</button>

          <a href="/admin/ritmos" class="btn btn-primary">
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
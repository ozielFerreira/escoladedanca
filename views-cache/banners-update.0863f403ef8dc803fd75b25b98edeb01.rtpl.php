<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Banners
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
     <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Banners</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/banners/<?php echo htmlspecialchars( $banner["idbanner"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="titulobanner">Titulo</label>
              <input type="text" class="form-control" id="titulobanner" name="titulobanner" placeholder="Digite o titulo" value="<?php echo htmlspecialchars( $banner["titulobanner"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

            <div class="form-group">
              <label for="desurlbanner">URL</label>
              <input type="text" class="form-control" id="desurlbanner" name="desurlbanner" placeholder="Digite a url amigável" value="<?php echo htmlspecialchars( $banner["desurlbanner"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

            <div class="form-group">
              <label for="file">Foto</label>
              <input type="file" class="form-control" id="file" name="file" value="<?php echo htmlspecialchars( $banner["desphotobanners"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              <div class="box box-widget">
                <div class="box-body">
                  <img class="img-responsive" id="image-preview" src="<?php echo htmlspecialchars( $banner["desphotobanners"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Photo" style="height: 600px;width: 100%;">
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-success">Salvar</button>

          <a href="/admin/banners" class="btn btn-primary">
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
<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Horários
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
     <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Horários</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/horarios/<?php echo htmlspecialchars( $horario["idhorario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="dessemana">Dia da semana</label>
              <input type="text" class="form-control" id="dessemana" name="dessemana" placeholder="Digite o dia da semana" value="<?php echo htmlspecialchars( $horario["dessemana"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            
            <div class="form-group">
              <label for="desprofessor">Professor(a)</label>
              <input type="text" class="form-control" id="desprofessor" name="desprofessor" placeholder="Digite o nome do professor" value="<?php echo htmlspecialchars( $horario["desprofessor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

            <div class="form-group">
              <label for="desritmo">Ritmo</label>
              <input type="text" class="form-control" id="desritmo" name="desritmo" placeholder="Digite o ritmo" value="<?php echo htmlspecialchars( $horario["desritmo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

            <div class="form-group">
              <label for="desnivel">Nível</label>
              <input type="text" class="form-control" id="desnivel" name="desnivel" placeholder="Digite o nível da turma" value="<?php echo htmlspecialchars( $horario["desnivel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

            <div class="form-group">
              <label for="deshorario">Horário</label>
              <input type="text" class="form-control" id="deshorario" name="deshorario" placeholder="Digite o horário da aula" value="<?php echo htmlspecialchars( $horario["deshorario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

            <div class="form-group">
              <label for="deschorario">Descrição</label>
              <input type="text" class="form-control" id="deschorario" name="deschorario" placeholder="Descrição" value="<?php echo htmlspecialchars( $horario["deschorario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

            <div class="form-group">
              <label for="destitulohorario">Titulo</label>
              <input type="text" class="form-control" id="destitulohorario" name="destitulohorario" placeholder="Digite o titulo" value="<?php echo htmlspecialchars( $horario["destitulohorario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-success">Salvar</button>

          <a href="/admin/horarios" class="btn btn-primary">
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
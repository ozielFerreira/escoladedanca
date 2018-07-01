<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Ritmos
    </h1>
    <ol class="breadcrumb">
      <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="/admin/ritmos">Ritmos</a></li>
      <li class="active"><a href="/admin/ritmos/create">Cadastrar</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
     <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Novo Ritmo</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/ritmos/create" method="post">
          <div class="box-body">

            <div class="form-group">
              <label for="tituloritmo">Nome do Ritmo</label>
              <input type="text" class="form-control" id="tituloritmo" name="tituloritmo" placeholder="Digite o nome do Ritmo">
            </div>

            <div class="form-group">
              <label for="descritmo">Descrição</label>
              <textarea class="form-control" id="descritmo" name="descritmo" placeholder="Descrição" style="resize:none; height:100px;" maxlength="500"></textarea>
            </div>

            <div class="form-group">
              <label for="desurlritmo">URL</label>
              <input type="text" class="form-control" id="desurlritmo" name="desurlritmo" placeholder="Digite uma URL Amigável">
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-success">Cadastrar</button>
              <a href="/admin/ritmos" class="btn btn-primary">
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
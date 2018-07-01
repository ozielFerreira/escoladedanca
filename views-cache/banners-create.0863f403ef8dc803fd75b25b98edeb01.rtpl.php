<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Banners
    </h1>
    <ol class="breadcrumb">
      <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="/admin/banners">Banners</a></li>
      <li class="active"><a href="/admin/banners/create">Cadastrar</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
     <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Novo Banner</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/banners/create" method="post">
          <div class="box-body">

            <div class="form-group">
              <label for="titulobanner">Titulo</label>
              <input type="text" class="form-control" id="titulobanner" name="titulobanner" placeholder="Digite o titulo">
            </div>

            <div class="form-group">
              <label for="desurlbanner">URL</label>
              <input type="text" class="form-control" id="desurlbanner" name="desurlbanner" placeholder="URL Amigável">
            </div>

            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-success">Cadastrar</button>
              <a href="/admin/banners" class="btn btn-primary">
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
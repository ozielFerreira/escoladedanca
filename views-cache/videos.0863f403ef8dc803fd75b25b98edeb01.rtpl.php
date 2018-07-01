<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Videos
    </h1>
    <ol class="breadcrumb">
      <li>
        <a href="/admin">
          <i class="fa fa-dashboard"></i> Home
        </a>
      </li>
      <li class="active">
        <a href="/admin/videos">Videos</a>
      </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">

          <div class="box-header">
            <a href="/admin/videos/create" class="btn btn-success">
              <i class="fa fa-plus"></i> Cadastrar Videos
            </a>

            <div class="box-tools">
              <form action="/admin/videos">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="search" class="form-control pull-right" placeholder="Search" value="<?php echo htmlspecialchars( $search, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </form>
            </div>

          </div>

          <div class="box-body no-padding">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>URL Video</th>
                    <th>Titulo</th>
                    <th>Descrição</th>
                    <th style="width: 140px">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($videos) && ( is_array($videos) || $videos instanceof Traversable ) && sizeof($videos) ) foreach( $videos as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td><?php echo htmlspecialchars( $value1["idvideo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["urlvideo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["titulovideo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["descvideo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td>
                      <a href="/admin/videos/<?php echo htmlspecialchars( $value1["idvideo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs">
                        <i class="fa fa-edit"></i> Alterar
                      </a>
                      <a href="/admin/videos/<?php echo htmlspecialchars( $value1["idvideo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i> Excluir
                      </a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
              <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>
              <li><a href="<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
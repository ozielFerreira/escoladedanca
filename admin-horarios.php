<?php 
use \escoladedanca\PageAdmin;
use \escoladedanca\Model\User;
use \escoladedanca\Model\Horario;

$app->get("/admin/horarios", function (){
    User::verifyLogin();
    $search = (isset($_GET['search'])) ? $_GET['search'] : "";
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

    if ($search != '') {
        $pagination = Horario::getPageSearch($search, $page);
    } else {
        $pagination = Horario::getPage($page);
    }
    $pages = [];
    for ($x = 0; $x < $pagination['pages']; $x++)
    {
        array_push($pages, [
            'href'=>'/admin/horarios?'.http_build_query([
                'page'=>$x+1,
                'search'=>$search
            ]),
            'text'=>$x+1
        ]);
    }

    $page = new PageAdmin();
    $page->setTpl("horarios",[
        "horarios"=>$pagination['data'],
        "search"=>$search,
        "pages"=>$pages
    ]);
});
    # Rota para a página de criação do produto.
    $app->get( "/admin/horarios/create", function(){
        User::verifyLogin();
        $page = new PageAdmin();
        $page->setTpl( "horarios-create" );
    });
    # Rota para salvar o produto.
    $app->post( "/admin/horarios/create", function(){
        User::verifyLogin();
        $horario = new Horario();
        $horario->setData( $_POST );
        $horario->save();
        header( "location: /admin/horarios" );
        exit();
    });
    # Rota para a página de edição do produto.
    $app->get( "/admin/horarios/:idhorario", function( $idhorario ){
        User::verifyLogin();
        $horario = new Horario();
        $horario->get( (int)$idhorario );
        $page = new PageAdmin();
        $page->setTpl( "horarios-update", [ 'horario' => $horario->getValues() ] );
    });
    # Rota para salvar a edição do produto.
    $app->post( "/admin/horarios/:idhorario", function( $idhorario ){
        User::verifyLogin();
        $horario = new Horario();
        $horario->get( (int)$idhorario );
        $horario->setData( $_POST );
        $horario->save();
        // if ((int)$_FILES["file"]["size"] > 0) {
        //     $horario->setPhoto($_FILES["file"]);
        // }
        header( "location: /admin/horarios" );
        exit();
    });
    # Rota para excluir o produto.
    $app->get( "/admin/horarios/:idhorario/delete", function( $idhorario ){
        User::verifyLogin();
        $horario = new Horario();
        $horario->get( (int)$idhorario );
        $horario->delete();
        header( "location: /admin/horarios" );
        exit();
    });


?>
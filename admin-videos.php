<?php 
use \escoladedanca\PageAdmin;
use \escoladedanca\Model\User;
use \escoladedanca\Model\Video;

$app->get("/admin/videos", function (){
    User::verifyLogin();
    $search = (isset($_GET['search'])) ? $_GET['search'] : "";
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

    if ($search != '') {
        $pagination = Video::getPageSearch($search, $page);
    } else {
        $pagination = Video::getPage($page);
    }
    $pages = [];
    for ($x = 0; $x < $pagination['pages']; $x++)
    {
        array_push($pages, [
            'href'=>'/admin/videos?'.http_build_query([
                'page'=>$x+1,
                'search'=>$search
            ]),
            'text'=>$x+1
        ]);
    }

    $page = new PageAdmin();
    $page->setTpl("videos",[
        "videos"=>$pagination['data'],
        "search"=>$search,
        "pages"=>$pages
    ]);
});
    # Rota para a página de criação do Video.
$app->get( "/admin/videos/create", function(){
    User::verifyLogin();
    $page = new PageAdmin();
    $page->setTpl( "videos-create" );
});
    # Rota para salvar o Video.
$app->post( "/admin/videos/create", function(){
    User::verifyLogin();
    $video = new Video();
    $_POST['urlvideo'] = str_replace('watch?v=', 'embed/', $_POST['urlvideo']);
    $video->setData( $_POST );
    $video->save();

   header( "location: /admin/videos" );
   exit();
});
    # Rota para a página de edição do Video.
$app->get( "/admin/videos/:idvideo", function( $idvideo ){
    User::verifyLogin();
    $video = new Video();
    $video->get( (int)$idvideo );
    $page = new PageAdmin();
    $page->setTpl("videos-update", [
        'video'=>$video->getValues()
    ]);
});
    # Rota para salvar a edição do Video.
$app->post( "/admin/videos/:idvideo", function( $idvideo ){
    User::verifyLogin();
    $video = new Video();
    $video->get((int)$idvideo);
    $video->setData($_POST);
    $video->save();
        // if ((int)$_FILES["file"]["size"] > 0) {
        //     $video->setPhoto($_FILES["file"]);
        // }
    header( "location: /admin/videos" );
    exit();
});
    # Rota para excluir o Video.
$app->get( "/admin/videos/:idvideo/delete", function( $idvideo ){
    User::verifyLogin();
    $video = new Video();
    $video->get( (int)$idvideo );
    $video->delete();
    header( "location: /admin/videos" );
    exit();
});


?>
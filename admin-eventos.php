<?php 
use \escoladedanca\PageAdmin;
use \escoladedanca\Model\User;
use \escoladedanca\Model\Evento;

$app->get("/admin/eventos", function (){
    User::verifyLogin();
    $search = (isset($_GET['search'])) ? $_GET['search'] : "";
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

    if ($search != '') {
        $pagination = Evento::getPageSearch($search, $page);
    } else {
        $pagination = Evento::getPage($page);
    }
    $pages = [];
    for ($x = 0; $x < $pagination['pages']; $x++)
    {
        array_push($pages, [
            'href'=>'/admin/eventos?'.http_build_query([
                'page'=>$x+1,
                'search'=>$search
            ]),
            'text'=>$x+1
        ]);
    }

    $page = new PageAdmin();
    $page->setTpl("eventos",[
        "eventos"=>$pagination['data'],
        "search"=>$search,
        "pages"=>$pages
    ]);
});
$app->get("/admin/eventos/create",function(){
    User::verifyLogin();
    $page = new PageAdmin();
    $page->setTpl("eventos-create");
});
$app->post("/admin/eventos/create",function(){
    User::verifyLogin();
    $evento = new Evento();
    $evento->setData($_POST);
    $evento->save();
    header("Location: /admin/eventos");
    exit;
});
$app->get("/admin/eventos/:idevento",function($idevento){
    User::verifyLogin();
    $evento = new Evento();
    $evento->get((int)$idevento);
    $page = new PageAdmin();
    $page->setTpl("eventos-update",[
        'evento'=>$evento->getValues()
    ]);
});
$app->post("/admin/eventos/:idevento",function($idevento){
    User::verifyLogin();
    $evento = new Evento();
    $evento->get((int)$idevento);
    $evento->setData($_POST);
    $evento->save();
     if ((int)$_FILES["file"]["size"] > 0) {$evento->setPhoto($_FILES["file"]);
     }
    // if($_FILES["file"]["name"] !== "") $evento->setPhoto($_FILES["file"]);
     header('Location: /admin/eventos');
     exit;
});
$app->get("/admin/eventos/:idevento/delete",function($idevento){
    User::verifyLogin();
    $evento = new Evento();
    $evento->get((int)$idevento);
    $evento->delete();
    header('Location: /admin/eventos');
    exit;
});

?>
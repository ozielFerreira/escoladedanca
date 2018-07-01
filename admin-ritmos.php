<?php 
use \escoladedanca\PageAdmin;
use \escoladedanca\Model\User;
use \escoladedanca\Model\Ritmo;

$app->get("/admin/ritmos", function (){
    User::verifyLogin();
    $search = (isset($_GET['search'])) ? $_GET['search'] : "";
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

    if ($search != '') {
        $pagination = Ritmo::getPageSearch($search, $page);
    } else {
        $pagination = Ritmo::getPage($page);
    }
    $pages = [];
    for ($x = 0; $x < $pagination['pages']; $x++)
    {
        array_push($pages, [
            'href'=>'/admin/ritmos?'.http_build_query([
                'page'=>$x+1,
                'search'=>$search
            ]),
            'text'=>$x+1
        ]);
    }

    $page = new PageAdmin();
    $page->setTpl("ritmos",[
        "ritmos"=>$pagination['data'],
        "search"=>$search,
        "pages"=>$pages
    ]);
});
$app->get("/admin/ritmos/create",function(){
    User::verifyLogin();
    $page = new PageAdmin();
    $page->setTpl("ritmos-create");
});
$app->post("/admin/ritmos/create",function(){
    User::verifyLogin();
    $ritmo = new Ritmo();
    $ritmo->setData($_POST);
    $ritmo->save();
    header("Location: /admin/ritmos");
    exit;
});
$app->get("/admin/ritmos/:idritmo",function($idritmo){
    User::verifyLogin();
    $ritmo = new Ritmo();
    $ritmo->get((int)$idritmo);
    $page = new PageAdmin();
    $page->setTpl("ritmos-update",[
        'ritmo'=>$ritmo->getValues()
    ]);
});
$app->post("/admin/ritmos/:idritmo",function($idritmo){
    User::verifyLogin();
    $ritmo = new Ritmo();
    $ritmo->get((int)$idritmo);
    $ritmo->setData($_POST);
    $ritmo->save();
     if ((int)$_FILES["file"]["size"] > 0) {$ritmo->setPhoto($_FILES["file"]);
     }
    // if($_FILES["file"]["name"] !== "") $ritmo->setPhoto($_FILES["file"]);
     header('Location: /admin/ritmos');
     exit;
});
$app->get("/admin/ritmos/:idritmo/delete",function($idritmo){
    User::verifyLogin();
    $ritmo = new Ritmo();
    $ritmo->get((int)$idritmo);
    $ritmo->delete();
    header('Location: /admin/ritmos');
    exit;
});

?>
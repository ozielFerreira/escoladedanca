<?php 
use \escoladedanca\PageAdmin;
use \escoladedanca\Model\User;
use \escoladedanca\Model\Equipe;

$app->get("/admin/equipes", function (){
    User::verifyLogin();
    $search = (isset($_GET['search'])) ? $_GET['search'] : "";
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

    if ($search != '') {
        $pagination = Equipe::getPageSearch($search, $page);
    } else {
        $pagination = Equipe::getPage($page);
    }
    $pages = [];
    for ($x = 0; $x < $pagination['pages']; $x++)
    {
        array_push($pages, [
            'href'=>'/admin/equipes?'.http_build_query([
                'page'=>$x+1,
                'search'=>$search
            ]),
            'text'=>$x+1
        ]);
    }

    $page = new PageAdmin();
    $page->setTpl("equipes",[
        "equipes"=>$pagination['data'],
        "search"=>$search,
        "pages"=>$pages
    ]);
});
$app->get("/admin/equipes/create",function(){
    User::verifyLogin();
    $page = new PageAdmin();
    $page->setTpl("equipes-create");
});
$app->post("/admin/equipes/create",function(){
    User::verifyLogin();
    $equipe = new Equipe();
    $equipe->setData($_POST);
    $equipe->save();
    header("Location: /admin/equipes");
    exit;
});
$app->get("/admin/equipes/:idequipe",function($idequipe){
    User::verifyLogin();
    $equipe = new Equipe();
    $equipe->get((int)$idequipe);
    $page = new PageAdmin();
    $page->setTpl("equipes-update",[
        'equipe'=>$equipe->getValues()
    ]);
});
$app->post("/admin/equipes/:idequipe",function($idequipe){
    User::verifyLogin();
    $equipe = new Equipe();
    $equipe->get((int)$idequipe);
    $equipe->setData($_POST);
    $equipe->save();
     if ((int)$_FILES["file"]["size"] > 0) {$equipe->setPhoto($_FILES["file"]);
     }
    // if($_FILES["file"]["name"] !== "") $equipe->setPhoto($_FILES["file"]);
     header('Location: /admin/equipes');
     exit;
});
$app->get("/admin/equipes/:idequipe/delete",function($idequipe){
    User::verifyLogin();
    $equipe = new Equipe();
    $equipe->get((int)$idequipe);
    $equipe->delete();
    header('Location: /admin/equipes');
    exit;
});

?>
<?php 
use \escoladedanca\PageAdmin;
use \escoladedanca\Model\User;
use \escoladedanca\Model\Banner;

$app->get("/admin/banners", function (){
    User::verifyLogin();
    $search = (isset($_GET['search'])) ? $_GET['search'] : "";
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

    if ($search != '') {
        $pagination = Banner::getPageSearch($search, $page);
    } else {
        $pagination = Banner::getPage($page);
    }
    $pages = [];
    for ($x = 0; $x < $pagination['pages']; $x++)
    {
        array_push($pages, [
            'href'=>'/admin/banners?'.http_build_query([
                'page'=>$x+1,
                'search'=>$search
            ]),
            'text'=>$x+1
        ]);
    }

    $page = new PageAdmin();
    $page->setTpl("banners",[
        "banners"=>$pagination['data'],
        "search"=>$search,
        "pages"=>$pages
    ]);
});
$app->get("/admin/banners/create",function(){
    User::verifyLogin();
    $page = new PageAdmin();
    $page->setTpl("banners-create");
});
$app->post("/admin/banners/create",function(){
    User::verifyLogin();
    $banner = new Banner();
    $banner->setData($_POST);
    $banner->save();
    header("Location: /admin/banners");
    exit;
});
$app->get("/admin/banners/:idbanner",function($idbanner){
    User::verifyLogin();
    $banner = new Banner();
    $banner->get((int)$idbanner);
    $page = new PageAdmin();
    $page->setTpl("banners-update",[
        'banner'=>$banner->getValues()
    ]);
});
$app->post("/admin/banners/:idbanner",function($idbanner){
    User::verifyLogin();
    $banner = new Banner();
    $banner->get((int)$idbanner);
    $banner->setData($_POST);
    $banner->save();
     if ((int)$_FILES["file"]["size"] > 0) {$banner->setPhoto($_FILES["file"]);
     }
    // if($_FILES["file"]["name"] !== "") $banner->setPhoto($_FILES["file"]);
     header('Location: /admin/banners');
     exit;
});
$app->get("/admin/banners/:idbanner/delete",function($idbanner){
    User::verifyLogin();
    $banner = new Banner();
    $banner->get((int)$idbanner);
    $banner->delete();
    header('Location: /admin/banners');
    exit;
});

?>
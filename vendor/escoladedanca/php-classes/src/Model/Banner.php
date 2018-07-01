<?php 

namespace escoladedanca\Model;

use \escoladedanca\DB\Sql;
use \escoladedanca\Model;
use\escoladedanca\Mailer;

class Banner extends Model
{
    public static function listAll()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_banners ORDER BY desurlbanner");
    } // End function listAll

    public static function checkList($list)
    {
        foreach ($list as &$row) {
            $p = new Banner();
            $p->setData($row);
            $row = $p->getValues();
        }
        return $list;
    }

    public function save()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_banners_save(:idbanner, :titulobanner, :desurlbanner)", array(
            ":idbanner"=>$this->getidbanner(),
            ":titulobanner"=>$this->gettitulobanner(),
            ":desurlbanner"=>$this->getdesurlbanner()
        ));
        $this->setData($results[0]);
    }
    public function get($idbanner)
    {
        $sql = new Sql();
        $results = $sql->select( "select * from tb_banners where idbanner = :idbanner", [
            ':idbanner' => $idbanner
    ]);
        $this->setData($results[0]);
    }
    public function delete()
    {
        $sql = new Sql();
        $sql->query("delete from tb_banners where idbanner = :idbanner", 
                     [':idbanner'=>$this->getidbanner()
                 ]);
        $filename = $_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . 
                    "res" . DIRECTORY_SEPARATOR . 
                    "site" . DIRECTORY_SEPARATOR . 
                    "img" . DIRECTORY_SEPARATOR . 
                    "banners" . DIRECTORY_SEPARATOR . 
                    $this->getidbanner() . ".jpg";
        
        if ( file_exists( $filename ) ) {
            unlink( $filename );
        }
    }
    public function checkPhoto()
    {
        if ( file_exists( $_SERVER[ 'DOCUMENT_ROOT' ] .
                          DIRECTORY_SEPARATOR .
                          "res" . DIRECTORY_SEPARATOR .
                          "site" . DIRECTORY_SEPARATOR .
                          "img" . DIRECTORY_SEPARATOR .
                          "banners" . DIRECTORY_SEPARATOR .
                          $this->getidbanner() . ".jpg"
        ))
        {
            $url = "/res/site/img/banners/" . $this->getidbanner() . ".jpg";
        } else {
            $url = "/res/site/img/banner.jpg";
        }
        return $this->setdesphotobanners($url);
    }
    public function getValues()
    {
        $this->checkPhoto();
        $values = parent::getValues();
        return $values;
    }
    public function setPhoto( $file )
    {
        # Procurando pelo ponto e montando um array com a imagem.
        $extension = explode( '.', $file[ 'name' ] );
        # Informando que a extensão é a última posição do array.
        $extension = end( $extension );
        switch( $extension ) {
            case "jpg":
            case "jpeg":
            $image = imagecreatefromjpeg( $file[ "tmp_name" ] );
            break;
            case "gif":
            $image = imagecreatefromgif( $file[ "tmp_name" ] );
            break;
            case "png":
            $image = imagecreatefrompng( $file[ "tmp_name" ] );
            break;
        }
        $dst = $_SERVER[ 'DOCUMENT_ROOT' ] .
                   DIRECTORY_SEPARATOR .
                   "res" . DIRECTORY_SEPARATOR .
                   "site" . DIRECTORY_SEPARATOR .
                   "img" . DIRECTORY_SEPARATOR .
                   "banners" . DIRECTORY_SEPARATOR .
                   $this->getidbanner() . ".jpg";
        imagejpeg( $image, $dst );
        imagedestroy( $image );
        $this->checkPhoto();
    }


    public function getFromURL($desurlbanner)
    {
        $sql = new Sql();
        $rows = $sql->select("SELECT * FROM tb_banners WHERE desurlbanner = :desurlbanner LIMIT 1", [
            ':desurlbanner'=>$desurlbanner
        ]);
        $this->setData($rows[0]);
    }
    // public function getCategories()
    // {
    //     $sql = new Sql();
    //     return $sql->select("
    //         SELECT * FROM tb_categories a INNER JOIN tb_bannerscategories b ON a.idcategory = b.idcategory WHERE b.idbanner = :idbanner
    //     ", [
    //         ':idbanner'=>$this->getidbanner()
    //     ]);
    // }

    public static function getPage($page = 1, $itemsPerPage = 10)
    {
        $start = ($page - 1) * $itemsPerPage;
        $sql = new Sql();
        $results = $sql->select("
            SELECT SQL_CALC_FOUND_ROWS *
            FROM tb_banners 
            ORDER BY idbanner
            LIMIT $start, $itemsPerPage;
        ");
        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
        return [
            'data'=>$results,
            'total'=>(int)$resultTotal[0]["nrtotal"],
            'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
        ];
    }

    public static function getPageSearch($search, $page = 1, $itemsPerPage = 10)
    {
        $start = ($page - 1) * $itemsPerPage;
        $sql = new Sql();
        $results = $sql->select("
            SELECT SQL_CALC_FOUND_ROWS *
            FROM tb_banners 
            WHERE (idbanner LIKE :search OR (titulobanner LIKE :search) OR (desurlbanner LIKE :search))
            ORDER BY idbanner
            LIMIT $start, $itemsPerPage;
        ", [
            ':search'=>'%'.$search.'%'
        ]);
        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
        return [
            'data'=>$results,
            'total'=>(int)$resultTotal[0]["nrtotal"],
            'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
        ];
    }

} // End class User
?>
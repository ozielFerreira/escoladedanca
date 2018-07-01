<?php 

namespace escoladedanca\Model;

use \escoladedanca\DB\Sql;
use \escoladedanca\Model;
use\escoladedanca\Mailer;

class Ritmo extends Model
{
    public static function listAll()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_ritmos ORDER BY descritmo");
    } // End function listAll

    public static function checkList($list)
    {
        foreach ($list as &$row) {
            $p = new Ritmo();
            $p->setData($row);
            $row = $p->getValues();
        }
        return $list;
    }

    public function save()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_ritmos_save(:idritmo, :tituloritmo, :descritmo, :desurlritmo)", array(
            ":idritmo"=>$this->getidritmo(),
            ":tituloritmo"=>$this->gettituloritmo(),
            ":descritmo"=>$this->getdescritmo(),
            ":desurlritmo"=>$this->getdesurlritmo()
        ));
        $this->setData($results[0]);
    }
    public function get($idritmo)
    {
        $sql = new Sql();
        $results = $sql->select( "select * from tb_ritmos where idritmo = :idritmo", [':idritmo' => $idritmo
    ]);
        $this->setData($results[0]);
    }
    public function delete()
    {
        $sql = new Sql();
        $sql->query("delete from tb_ritmos where idritmo = :idritmo", 
                     [':idritmo'=>$this->getidritmo()
                 ]);
        $filename = $_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . 
                    "res" . DIRECTORY_SEPARATOR . 
                    "site" . DIRECTORY_SEPARATOR . 
                    "img" . DIRECTORY_SEPARATOR . 
                    "ritmos" . DIRECTORY_SEPARATOR . 
                    $this->getidritmo() . ".jpg";
        
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
                          "ritmos" . DIRECTORY_SEPARATOR .
                          $this->getidritmo() . ".jpg"
        ))
        {
            $url = "/res/site/img/ritmos/" . $this->getidritmo() . ".jpg";
        } else {
            $url = "/res/site/img/ritmo.jpg";
        }
        return $this->setdesphotoritmos($url);
    }
    public function getValues()
    {
        $this->checkPhoto();
        $values = parent::getValues();
        return $values;
    }
    public function setPhoto($file)
    {
        # Procurando pelo ponto e montando um array com a imagem.
        $extension = explode('.', $file['name']);
        # Informando que a extensão é a última posição do array.
        $extension = end($extension);
        switch($extension) {
            case "jpg":
            case "jpeg":
            $image = imagecreatefromjpeg($file["tmp_name"]);
            break;
            case "gif":
            $image = imagecreatefromgif($file["tmp_name"]);
            break;
            case "png":
            $image = imagecreatefrompng($file["tmp_name"]);
            break;
        }
        $dst = $_SERVER['DOCUMENT_ROOT'] .
                   DIRECTORY_SEPARATOR .
                   "res" . DIRECTORY_SEPARATOR .
                   "site" . DIRECTORY_SEPARATOR .
                   "img" . DIRECTORY_SEPARATOR .
                   "ritmos" . DIRECTORY_SEPARATOR .
                   $this->getidritmo() . ".jpg";
        imagejpeg($image, $dst);
        imagedestroy($image);
        $this->checkPhoto();
    }


    public function getFromURL($desurlritmo)
    {
        $sql = new Sql();
        $rows = $sql->select("SELECT * FROM tb_ritmos WHERE desurlritmo = :desurlritmo LIMIT 1", [
            ':desurlritmo'=>$desurlritmo
        ]);
        $this->setData($rows[0]);
    }
    // public function getCategories()
    // {
    //     $sql = new Sql();
    //     return $sql->select("
    //         SELECT * FROM tb_categories a INNER JOIN tb_ritmoscategories b ON a.idcategory = b.idcategory WHERE b.idritmo = :idritmo
    //     ", [
    //         ':idritmo'=>$this->getidritmo()
    //     ]);
    // }

    public static function getPage($page = 1, $itemsPerPage = 10)
    {
        $start = ($page - 1) * $itemsPerPage;
        $sql = new Sql();
        $results = $sql->select("
            SELECT SQL_CALC_FOUND_ROWS *
            FROM tb_ritmos 
            ORDER BY idritmo
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
            FROM tb_ritmos 
            WHERE (idritmo LIKE :search OR (tituloritmo LIKE :search) OR (descritmo LIKE :search))
            ORDER BY idritmo
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
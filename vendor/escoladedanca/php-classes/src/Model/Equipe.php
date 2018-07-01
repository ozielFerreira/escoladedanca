<?php 

namespace escoladedanca\Model;

use \escoladedanca\DB\Sql;
use \escoladedanca\Model;
use\escoladedanca\Mailer;

class Equipe extends Model
{
    public static function listAll()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_equipe ORDER BY descequipe");
    } // End function listAll

    public static function checkList($list)
    {
        foreach ($list as &$row) {
            $p = new Equipe();
            $p->setData($row);
            $row = $p->getValues();
        }
        return $list;
    }

    public function save()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_equipes_save(:idequipe, :tituloequipe, :descequipe, :urlequipe, :urlfacebook, :urlyoutube, :urlinstagram, :urlwhatsapp)", array(
            ":idequipe"=>$this->getidequipe(),
            ":tituloequipe"=>$this->gettituloequipe(),
            ":descequipe"=>$this->getdescequipe(),
            ":urlequipe"=>$this->geturlequipe(),
            ":urlfacebook"=>$this->geturlfacebook(), 
            ":urlyoutube"=>$this->geturlyoutube(), 
            ":urlinstagram"=>$this->geturlinstagram(), 
            ":urlwhatsapp"=>$this->geturlwhatsapp()
        ));
        $this->setData($results[0]);
    }
    public function get($idequipe)
    {
        $sql = new Sql();
        $results = $sql->select( "select * from tb_equipe where idequipe = :idequipe", [':idequipe' => $idequipe
    ]);
        $this->setData($results[0]);
    }
    public function delete()
    {
        $sql = new Sql();
        $sql->query("delete from tb_equipe where idequipe = :idequipe", 
           [':idequipe'=>$this->getidequipe()
       ]);
        $filename = $_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . 
        "res" . DIRECTORY_SEPARATOR . 
        "site" . DIRECTORY_SEPARATOR . 
        "img" . DIRECTORY_SEPARATOR . 
        "equipes" . DIRECTORY_SEPARATOR . 
        $this->getidequipe() . ".jpg";
        
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
          "equipes" . DIRECTORY_SEPARATOR .
          $this->getidequipe() . ".jpg"
      ))
        {
            $url = "/res/site/img/equipes/" . $this->getidequipe() . ".jpg";
        } else {
            $url = "/res/site/img/equipe.jpg";
        }
        return $this->setdesphotoequipes($url);
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
        "equipes" . DIRECTORY_SEPARATOR .
        $this->getidequipe() . ".jpg";
        imagejpeg( $image, $dst );
        imagedestroy( $image );
        $this->checkPhoto();
    }


    public function getFromURL($urlequipe)
    {
        $sql = new Sql();
        $rows = $sql->select("SELECT * FROM tb_equipe WHERE urlequipe = :urlequipe LIMIT 1", [
            ':urlequipe'=>$urlequipe
        ]);
        $this->setData($rows[0]);
    }
    // public function getCategories()
    // {
    //     $sql = new Sql();
    //     return $sql->select("
    //         SELECT * FROM tb_categories a INNER JOIN tb_equipescategories b ON a.idcategory = b.idcategory WHERE b.idequipe = :idequipe
    //     ", [
    //         ':idequipe'=>$this->getidequipe()
    //     ]);
    // }

    public static function getPage($page = 1, $itemsPerPage = 6)
    {
        $start = ($page - 1) * $itemsPerPage;
        $sql = new Sql();
        $results = $sql->select("
            SELECT SQL_CALC_FOUND_ROWS *
            FROM tb_equipe 
            ORDER BY idequipe
            LIMIT $start, $itemsPerPage;
            ");
        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
        return [
            'data'=>$results,
            'total'=>(int)$resultTotal[0]["nrtotal"],
            'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
        ];
    }

    public static function getPageSearch($search, $page = 1, $itemsPerPage = 6)
    {
        $start = ($page - 1) * $itemsPerPage;
        $sql = new Sql();
        $results = $sql->select("
            SELECT SQL_CALC_FOUND_ROWS *
            FROM tb_equipe 
            WHERE (idequipe LIKE :search OR (tituloequipe LIKE :search) OR (descequipe LIKE :search))
            ORDER BY idequipe
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
<?php 

namespace escoladedanca\Model;

use \escoladedanca\DB\Sql;
use \escoladedanca\Model;
use\escoladedanca\Mailer;

class Evento extends Model
{
    public static function listAll()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_eventos ORDER BY descevento");
    } // End function listAll

    public static function checkList($list)
    {
        foreach ($list as &$row) {
            $p = new Evento();
            $p->setData($row);
            $row = $p->getValues();
        }
        return $list;
    }

    public function save()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_eventos_save(:idevento, :tituloevento, :desurl, :descevento)", array(
            ":idevento"=>$this->getidevento(),
            ":tituloevento"=>$this->gettituloevento(),
            ":desurl"=>$this->getdesurl(),
            ":descevento"=>$this->getdescevento()
        ));
        $this->setData($results[0]);
    }
    public function get($idevento)
    {
        $sql = new Sql();
        $results = $sql->select( "select * from tb_eventos where idevento = :idevento", [':idevento' => $idevento
    ]);
        $this->setData($results[0]);
    }
    public function delete()
    {
        $sql = new Sql();
        $sql->query("delete from tb_eventos where idevento = :idevento", 
                     [':idevento'=>$this->getidevento()
                 ]);
        $filename = $_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . 
                    "res" . DIRECTORY_SEPARATOR . 
                    "site" . DIRECTORY_SEPARATOR . 
                    "img" . DIRECTORY_SEPARATOR . 
                    "eventos" . DIRECTORY_SEPARATOR . 
                    $this->getidevento() . ".jpg";
        
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
                          "eventos" . DIRECTORY_SEPARATOR .
                          $this->getidevento() . ".jpg"
        ))
        {
            $url = "/res/site/img/eventos/" . $this->getidevento() . ".jpg";
        } else {
            $url = "/res/site/img/evento.jpg";
        }
        return $this->setdesphotoeventos($url);
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
                   "eventos" . DIRECTORY_SEPARATOR .
                   $this->getidevento() . ".jpg";
        imagejpeg( $image, $dst );
        imagedestroy( $image );
        $this->checkPhoto();
    }


    public function getFromURL($desurl)
    {
        $sql = new Sql();
        $rows = $sql->select("SELECT * FROM tb_eventos WHERE desurl = :desurl LIMIT 1", [
            ':desurl'=>$desurl
        ]);
        $this->setData($rows[0]);
    }
    // public function getCategories()
    // {
    //     $sql = new Sql();
    //     return $sql->select("
    //         SELECT * FROM tb_categories a INNER JOIN tb_eventoscategories b ON a.idcategory = b.idcategory WHERE b.idevento = :idevento
    //     ", [
    //         ':idevento'=>$this->getidevento()
    //     ]);
    // }

    public static function getPage($page = 1, $itemsPerPage = 10)
    {
        $start = ($page - 1) * $itemsPerPage;
        $sql = new Sql();
        $results = $sql->select("
            SELECT SQL_CALC_FOUND_ROWS *
            FROM tb_eventos 
            ORDER BY idevento
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
            FROM tb_eventos 
            WHERE (idevento LIKE :search OR (tituloevento LIKE :search) OR (desurl LIKE :search)  OR (descevento LIKE :search))
            ORDER BY idevento
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
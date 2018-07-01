<?php 

namespace escoladedanca\Model;

use \escoladedanca\DB\Sql;
use \escoladedanca\Model;
use\escoladedanca\Mailer;

class Horario extends Model
{
    public static function listAll()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_horarios ORDER BY deshorario");
    } // End function listAll

    public static function checkList($list)
    {
        foreach ($list as &$row) {
            $p = new Horario();
            $p->setData($row);
            $row = $p->getValues();
        }
        return $list;
    }

    public function save()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_horarios_save(:idhorario, :dessemana, :desprofessor, :desritmo, :desnivel, :deshorario, :deschorario, :destitulohorario)", array(
            ":idhorario"=>$this->getidhorario(),
            ":dessemana"=>$this->getdessemana(),
            ":desprofessor"=>$this->getdesprofessor(),
            ":desritmo"=>$this->getdesritmo(),
            ":desnivel"=>$this->getdesnivel(),
            ":deshorario"=>$this->getdeshorario(),
            ":deschorario"=>$this->getdeschorario(),
            ":destitulohorario"=>$this->getdestitulohorario()
        ));
        $this->setData($results[0]);
    }
    public function get($idhorario)
    {
        $sql = new Sql();
        $results = $sql->select( "select * from tb_horarios where idhorario = :idhorario", [':idhorario' => $idhorario
    ]);
        $this->setData($results[0]);
    }
    public function delete()
    {
        $sql = new Sql();
        $sql->query("delete from tb_horarios where idhorario = :idhorario", 
                     [':idhorario'=>$this->getidhorario()
                 ]);
        // $filename = $_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . 
        //             "res" . DIRECTORY_SEPARATOR . 
        //             "site" . DIRECTORY_SEPARATOR . 
        //             "img" . DIRECTORY_SEPARATOR . 
        //             "horarios" . DIRECTORY_SEPARATOR . 
        //             $this->getidhorario() . ".jpg";
        
        // if ( file_exists( $filename ) ) {
        //     unlink( $filename );
        // }
    }
    // public function checkPhoto()
    // {
    //     if ( file_exists( $_SERVER[ 'DOCUMENT_ROOT' ] .
    //                       DIRECTORY_SEPARATOR .
    //                       "res" . DIRECTORY_SEPARATOR .
    //                       "site" . DIRECTORY_SEPARATOR .
    //                       "img" . DIRECTORY_SEPARATOR .
    //                       "horarios" . DIRECTORY_SEPARATOR .
    //                       $this->getidhorario() . ".jpg"
    //     ))
    //     {
    //         $url = "/res/site/img/horarios/" . $this->getidhorario() . ".jpg";
    //     } else {
    //         $url = "/res/site/img/horario.jpg";
    //     }
    //     return $this->setdesphoto( $url );
    // }
    // public function getValues()
    // {
    //     $this->checkPhoto();
    //     $values = parent::getValues();
    //     return $values;
    // }
    // public function setPhoto( $file )
    // {
    //     # Procurando pelo ponto e montando um array com a imagem.
    //     $extension = explode( '.', $file[ 'name' ] );
    //     # Informando que a extensão é a última posição do array.
    //     $extension = end( $extension );
    //     switch( $extension ) {
    //         case "jpg":
    //         case "jpeg":
    //         $image = imagecreatefromjpeg( $file[ "tmp_name" ] );
    //         break;
    //         case "gif":
    //         $image = imagecreatefromgif( $file[ "tmp_name" ] );
    //         break;
    //         case "png":
    //         $image = imagecreatefrompng( $file[ "tmp_name" ] );
    //         break;
    //     }
    //     $dst = $_SERVER[ 'DOCUMENT_ROOT' ] .
    //                DIRECTORY_SEPARATOR .
    //                "res" . DIRECTORY_SEPARATOR .
    //                "site" . DIRECTORY_SEPARATOR .
    //                "img" . DIRECTORY_SEPARATOR .
    //                "horarios" . DIRECTORY_SEPARATOR .
    //                $this->getidhorario() . ".jpg";
    //     imagejpeg( $image, $dst );
    //     imagedestroy( $image );
    //     $this->checkPhoto();
    // }


    // public function getFromURL($desurl)
    // {
    //     $sql = new Sql();
    //     $rows = $sql->select("SELECT * FROM tb_horarios WHERE desurl = :desurl LIMIT 1", [
    //         ':desurl'=>$desurl
    //     ]);
    //     $this->setData($rows[0]);
    // }
    // public function getCategories()
    // {
    //     $sql = new Sql();
    //     return $sql->select("
    //         SELECT * FROM tb_categories a INNER JOIN tb_horarioscategories b ON a.idcategory = b.idcategory WHERE b.idhorario = :idhorario
    //     ", [
    //         ':idhorario'=>$this->getidhorario()
    //     ]);
    // }

    public static function getPage($page = 1, $itemsPerPage = 10)
    {
        $start = ($page - 1) * $itemsPerPage;
        $sql = new Sql();
        $results = $sql->select("
            SELECT SQL_CALC_FOUND_ROWS *
            FROM tb_horarios 
            ORDER BY deshorario
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
            FROM tb_horarios 
            WHERE (idhorario LIKE :search OR (dessemana LIKE :search) OR (desprofessor LIKE :search) OR (desritmo LIKE :search) OR (desnivel LIKE :search) OR (deshorario LIKE :search))
            ORDER BY deshorario
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
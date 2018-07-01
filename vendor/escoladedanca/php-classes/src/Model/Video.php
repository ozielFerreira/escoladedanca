<?php 

namespace escoladedanca\Model;

use \escoladedanca\DB\Sql;
use \escoladedanca\Model;
use\escoladedanca\Mailer;

class Video extends Model
{
    public static function listAll()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_videos ORDER BY urlvideo");
    } // End function listAll

    public static function checkList($list)
    {
        foreach ($list as &$row) {
            $p = new Video();
            $p->setData($row);
            $row = $p->getValues();
        }
        return $list;
    }

    public function save()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_videos_save(:idvideo, :urlvideo, :titulovideo, :descvideo)", array(
            ":idvideo"=>$this->getidvideo(),
            ":urlvideo"=>$this->geturlvideo(),
            ":titulovideo"=>$this->gettitulovideo(),
            ":descvideo"=>$this->getdescvideo()
            
        ));
        $this->setData($results[0]);
    }
    public function get($idvideo)
    {
        $sql = new Sql();
        $results = $sql->select("select * from tb_videos where idvideo = :idvideo", [
            ':idvideo' => $idvideo
    ]);
        $this->setData($results[0]);
    }
    public function delete()
    {
        $sql = new Sql();
        $sql->query("delete from tb_videos where idvideo = :idvideo", [
            ':idvideo'=>$this->getidvideo()
        ]);
        // $filename = $_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . 
        //             "res" . DIRECTORY_SEPARATOR . 
        //             "site" . DIRECTORY_SEPARATOR . 
        //             "img" . DIRECTORY_SEPARATOR . 
        //             "videos" . DIRECTORY_SEPARATOR . 
        //             $this->getidvideo() . ".jpg";
        
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
    //                       "videos" . DIRECTORY_SEPARATOR .
    //                       $this->getidvideo() . ".jpg"
    //     ))
    //     {
    //         $url = "/res/site/img/videos/" . $this->getidvideo() . ".jpg";
    //     } else {
    //         $url = "/res/site/img/video.jpg";
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
    //                "videos" . DIRECTORY_SEPARATOR .
    //                $this->getidvideo() . ".jpg";
    //     imagejpeg( $image, $dst );
    //     imagedestroy( $image );
    //     $this->checkPhoto();
    // }


    // public function getFromURL($desurl)
    // {
    //     $sql = new Sql();
    //     $rows = $sql->select("SELECT * FROM tb_videos WHERE desurl = :desurl LIMIT 1", [
    //         ':desurl'=>$desurl
    //     ]);
    //     $this->setData($rows[0]);
    // }
    public function getVideos()
    {
        $sql = new Sql();
        return $sql->select("
            SELECT * FROM tb_videos WHERE a.idvideo = :idvideo
        ", [
            ':idvideo'=>$this->getidvideo()
        ]);
    }

    public static function getPage($page = 1, $itemsPerPage = 6)
    {
        $start = ($page - 1) * $itemsPerPage;
        $sql = new Sql();
        $results = $sql->select("
            SELECT SQL_CALC_FOUND_ROWS *
            FROM tb_videos 
            ORDER BY idvideo
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
            FROM tb_videos 
            WHERE (descvideo LIKE :search OR (idvideo LIKE :search) OR (titulovideo LIKE :search))
            ORDER BY descvideo
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
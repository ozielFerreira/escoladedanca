<?php 

namespace escoladedanca\Model;

use \escoladedanca\DB\Sql;
use \escoladedanca\Model;
use\escoladedanca\Mailer;

class User extends Model {
    const SESSION = "User";
    const SECRET = "EscolaDeDanca_Secret";
    const ERROR = "UserError";
    const ERROR_REGISTER = "UserErrorRegister";
    const SUCCESS = "UserSucesss";
    
    public static function getFromSession()
    {
        $user = new User();
        if (isset($_SESSION[User::SESSION]) && (int)$_SESSION[User::SESSION]['iduser'] > 0) {
            $user->setData($_SESSION[User::SESSION]);
        }
        return $user;
    }
    public static function checkLogin($inadmin = true)
    {
        if (
            // SESSÃO NÃO DEFINIDA
            !isset($_SESSION[User::SESSION])
            || //SESSÃO DEFINIDA PORÉM ESTÁ VAZIA
            !$_SESSION[User::SESSION]
            || // SESSÃO NÃO ESTÁ VAZIA E O IDUSER NÃO FOR MAIOR QUE ZERO, NÂO ESTÁ LOGADO
            !(int)$_SESSION[User::SESSION]["iduser"] > 0
        ) {
            //Não está logado
            return false;
        } else {
            if ($inadmin === true && (bool)$_SESSION[User::SESSION]['inadmin'] === true) {
                return true;
            } else if ($inadmin === false) {
                return true;
            } else {
                return false;
            }
        }
    }
    public static function login($login, $password)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_users a INNER JOIN tb_alunos b ON a.idaluno = b.idaluno WHERE a.deslogin = :LOGIN", array(
            ":LOGIN"=>$login
        )); 
        if (count($results) === 0)
        {
            throw new \Exception("Usuário inexistente ou senha inválida.");
        }
        $data = $results[0];
        if (password_verify($password, $data["despassword"]) === true)
        {
            $user = new User();
            $data['desaluno'] = $data['desaluno'];
            $user->setData($data);
            $_SESSION[User::SESSION] = $user->getValues();
            return $user;
        } else {
            throw new \Exception("Usuário inexistente ou senha inválida.");
        }
    }
    //VERIFICANDO UMA ROTA DA  ADMINISTRAÇÃO
    public static function verifyLogin($inadmin = true)
    {
        if (!User::checkLogin($inadmin)) {
            if ($inadmin) {
                header("Location: /admin/login");
            } else {
                header("Location: /login");
            }
            exit;
        }
    }
    public static function logout()
    {
        $_SESSION[User::SESSION] = NULL;
    }
    public static function listAll()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_users a INNER JOIN tb_alunos b USING(idaluno) ORDER BY b.desaluno");
    }
    public function save()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_users_save(:desaluno, :deslogin, :despassword, :desemail, :nrphone, :inadmin)", array(
            ":desaluno"=>$this->getdesaluno(),
            ":deslogin"=>$this->getdeslogin(),
            ":despassword"=>User::getPasswordHash($this->getdespassword()),
            ":desemail"=>$this->getdesemail(),
            ":nrphone"=>$this->getnrphone(),
            ":inadmin"=>$this->getinadmin()
        ));
        $this->setData($results[0]);
    }
    public function get($iduser)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_users a INNER JOIN tb_alunos b USING(idaluno) WHERE a.iduser = :iduser", array(
            ":iduser"=>$iduser
        ));
        $data = $results[0];
        $data['desaluno'] = $data['desaluno'];
        $this->setData($data);
    }
    public function update()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_usersupdate_save(:iduser, :desaluno, :deslogin, :despassword, :desemail, :nrphone, :inadmin)", array(
            ":iduser"=>$this->getiduser(),
            ":desaluno"=>$this->getdesaluno(),
            ":deslogin"=>$this->getdeslogin(),
            ":despassword"=>User::getPasswordHash($this->getdespassword()),
            ":desemail"=>$this->getdesemail(),
            ":nrphone"=>$this->getnrphone(),
            ":inadmin"=>$this->getinadmin()
        ));
        $this->setData($results[0]);        
    }
    public function delete()
    {
        $sql = new Sql();
        $sql->query("CALL sp_users_delete(:iduser)", array(
            ":iduser"=>$this->getiduser()
        ));
    }
    public static function getForgot($email, $inadmin = true) {
     $sql = new Sql();
     $results = $sql->select("
         SELECT *
         FROM tb_alunos a
         INNER JOIN tb_users b USING(idaluno)
         WHERE a.desemail = :email;
     ", array(
         ":email"=>$email
     ));
     if (count($results) === 0)
     {
         throw new \Exception("Não foi possível recuperar a senha.");
     }
     else
     {
         $data = $results[0];
         $results2 = $sql->select("CALL sp_userspasswordsrecoveries_create(:iduser, :desip)", array(
             ":iduser"=>$data['iduser'],
             ":desip"=>$_SERVER['REMOTE_ADDR']
         ));
         if (count($results2) === 0)
         {
             throw new \Exception("Não foi possível recuperar a senha.");
         }
         else
         {
             $dataRecovery = $results2[0];
             $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
             $code = openssl_encrypt($dataRecovery['idrecovery'], 'aes-256-cbc', User::SECRET, 0, $iv);
             $result = base64_encode($iv.$code);
             if ($inadmin === true) {
                 $link = "http://www.jaimearoxaniteroi.com.br/admin/forgot/reset?code=$result";
             } else {
                 $link = "http://www.jaimearoxaniteroi.com.br/forgot/reset?code=$result";
             } 
             $mailer = new Mailer($data['desemail'], $data['desaluno'], "Redefinir senha do perfil", "forgot", array(
                 "name"=>$data['desaluno'],
                 "link"=>$link
             )); 
             $mailer->send();
             return $link;
         }
     }
 }
    public static function validForgotDecrypt($result) {
         
         $result = base64_decode($result);
         
         $code = mb_substr($result, openssl_cipher_iv_length('aes-256-cbc'), null, '8bit');
         
         $iv = mb_substr($result, 0, openssl_cipher_iv_length('aes-256-cbc'), '8bit');;
         
         $idrecovery = openssl_decrypt($code, 'aes-256-cbc', User::SECRET, 0, $iv);
         
         $sql = new Sql();
         
         $results = $sql->select("
             SELECT *
             FROM tb_userspasswordsrecoveries a
             INNER JOIN tb_users b USING(iduser)
             INNER JOIN tb_alunos c USING(idaluno)
             WHERE
             a.idrecovery = :idrecovery
             AND
             a.dtrecovery IS NULL
             AND
             DATE_ADD(a.dtregister, INTERVAL 1 HOUR) >= NOW();
                ", array(
                ":idrecovery"=>$idrecovery
            ));
     
        if (count($results) === 0) {
         
             throw new \Exception("Não foi possível recuperar a senha.");
        } else {
         
            return $results[0];
        }
    }

    public static function setFogotUsed($idrecovery)
    {
        $sql = new Sql();
        $sql->query("UPDATE tb_userspasswordsrecoveries SET dtrecovery = NOW() WHERE idrecovery = :idrecovery", array(
            ":idrecovery"=>$idrecovery
        ));
    }
    public function setPassword($password)
    {
        $sql = new Sql();
        $sql->query("UPDATE tb_users SET despassword = :password WHERE iduser = :iduser", array(
            ":password"=>$password,
            ":iduser"=>$this->getiduser()
        ));
    }
    public static function setError($msg)
    {
        $_SESSION[User::ERROR] = $msg;
    }
    public static function getError()
    {
        $msg = (isset($_SESSION[User::ERROR]) && $_SESSION[User::ERROR]) ? $_SESSION[User::ERROR] : '';
        User::clearError();
        return $msg;
    }
    public static function clearError()
    {
        $_SESSION[User::ERROR] = NULL;
    }
    public static function setSuccess($msg)
    {
        $_SESSION[User::SUCCESS] = $msg;
    }
    public static function getSuccess()
    {
        $msg = (isset($_SESSION[User::SUCCESS]) && $_SESSION[User::SUCCESS]) ? $_SESSION[User::SUCCESS] : '';
        User::clearSuccess();
        return $msg;
    }
    public static function clearSuccess()
    {
        $_SESSION[User::SUCCESS] = NULL;
    }
    public static function setErrorRegister($msg)
    {
        $_SESSION[User::ERROR_REGISTER] = $msg;
    }
    public static function getErrorRegister()
    {
        $msg = (isset($_SESSION[User::ERROR_REGISTER]) && $_SESSION[User::ERROR_REGISTER]) ? $_SESSION[User::ERROR_REGISTER] : '';
        User::clearErrorRegister();
        return $msg;
    }
    public static function clearErrorRegister()
    {
        $_SESSION[User::ERROR_REGISTER] = NULL;
    }
    public static function checkLoginExist($login)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :deslogin", [
            ':deslogin'=>$login
        ]);
        return (count($results) > 0);
    }
    public static function getPasswordHash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT, [
            'cost'=>12
        ]);
    }
    // public function getOrders()
    // {
    //     $sql = new Sql();
    //     $results = $sql->select("
    //         SELECT * 
    //         FROM tb_orders a 
    //         INNER JOIN tb_ordersstatus b USING(idstatus) 
    //         INNER JOIN tb_carts c USING(idcart)
    //         INNER JOIN tb_users d ON d.iduser = a.iduser
    //         INNER JOIN tb_addresses e USING(idaddress)
    //         INNER JOIN tb_alunos f ON f.idaluno = d.idaluno
    //         WHERE a.iduser = :iduser
    //     ", [
    //         ':iduser'=>$this->getiduser()
    //     ]);
    //     return $results;
    // }
    public static function getPage($page = 1, $itemsPerPage = 10)
    {
        $start = ($page - 1) * $itemsPerPage;
        $sql = new Sql();
        $results = $sql->select("
            SELECT SQL_CALC_FOUND_ROWS *
            FROM tb_users a 
            INNER JOIN tb_alunos b USING(idaluno) 
            ORDER BY b.desaluno
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
            FROM tb_users a 
            INNER JOIN tb_alunos b USING(idaluno)
            WHERE b.desaluno LIKE :search OR b.desemail = :search OR a.deslogin LIKE :search
            ORDER BY b.desaluno
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
}
?>
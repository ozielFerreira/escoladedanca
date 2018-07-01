<?php

$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRING);
$ritmos = filter_input(INPUT_POST, "ritmo", FILTER_SANITIZE_STRING);
$assunt = filter_input(INPUT_POST, "assunto", FILTER_SANITIZE_STRING);
$msg = filter_input(INPUT_POST, "mensagem", FILTER_SANITIZE_STRING);


//echo "$nome <br> $email <br> $msg <br> $assunto ";


//for($i=0;$i<=10;$i++){
	
	//echo $ck[$i]."<br>";
	
//}

$to = "ozielcf@gmail.com";
$subject = "$assunt";
$message = 

"<div style='background-color:rgba(131,25,23,.95);width:650px;color:white;border-top:thick double #6b0202;text-align:left'>
      <div style='margin:10px'>
        <div align='center' style='height:140px;width:100%;background-color:#86201e;color:#fff;padding:1px 1px;font-family:Montserrat,sans-serif;margin-bottom:1px!important'><img src='https://paginateste-web.000webhostapp.com/img/logo-ja-niteroi-branco.png' alt='escola de dança jaime arôxa niterói' style='width:250px;margin:0 auto'>
          <p style='font-size:195%;font-family:'Oswald',sans-serif;letter-spacing:5px;text-align:center;color:white;font-weight:400;text-transform:uppercase;opacity:.9'>Existem dois dias importantes em sua vida!</p>
          <hr style='width:260px;opacity:.5;'>
        </div>
        <p style='text-align:center;'>
          <font face='Impact, Arial, sans-serif,' style='font-size:24pt;font-family:Impact;'>Fale conosco!</font>
          <br> 
        </p>
        <hr style='width:200px;opacity:.5;'>
        <p style='text-align:center;'>
        <font face='Impact, Arial, sans-serif,' style='font-size:13pt;font-family:Impact;'>Mensagem do Aluno!</font>
        </p>
        <br> <br>
        <p></p>
        <table style='width:100%;text-align:left;' border='0' cellspacing='0' cellpadding='2'>
          <tbody>
            <tr>
              <th>Nome: &nbsp;&nbsp;</th>
              <td style='padding: 1px;text-align: left;border-bottom: 1px solid #ddd;'>$nome</td>
            </tr>
            <tr>
              <th>Email: &nbsp;&nbsp;</th>
              <td style='padding: 1px;text-align: left;border-bottom: 1px solid #ddd;'><a href='mailto:' target='_blank' style='color:white;'>$email</a></td>
            </tr>
            <tr>
              <th>Telefone: &nbsp;&nbsp;</th>
              <td style='padding: 1px;text-align: left;border-bottom: 1px solid #ddd;'>$telefone</td>
            </tr>
            <tr>
              <th>Ritmos: &nbsp;&nbsp;</th>
              <td style='padding: 1px;text-align: left;border-bottom: 1px solid #ddd;'>$ritmos</td>
            </tr>
            <tr>
              <th>Assunto: &nbsp;&nbsp;</th>
              <td style='padding: 1px;text-align: left;border-bottom: 1px solid #ddd;'>$assunt</td>
            </tr>
            <tr>
              <th><u>Mensagem:</u> &nbsp;&nbsp;</th>
            </tr>
            <tr>
            <td colspan='2'>$msg</td>
            <tr>
            </tbody>
          </table>
                 
        <div align='center' style='background-color:rgba(131,25,23,0.95);height:90px;'>
        <hr style='opacity:.5;'>
          <p style='margin-top:20px'><a style='color:white;text-decoration:none' href='https://paginateste-web.000webhostapp.com/index.html/' title='Jaime Arôxa Niterói' target='_blank'>© 2017 Todos direitos reservados </a><br>| <br>Designed by Oziel Ferreira
          </p>
        </div>
        </div>
      </div>";

$header ="MIME-Version: 1.0\n";
$header .= "Content-type: text/html; charset=UTF-8\n";
$header .="From: $email";
$mail = mail($to, $subject, $message, $header);
if($mail){
	echo "<script>alert('Mensagem enviada com sucesso!');window.location.href='/';</script>";
}else {
	echo "<script>alert('Falha ao enviar mensagem. Tente novamente!');window.location.href='/';</script>";

}
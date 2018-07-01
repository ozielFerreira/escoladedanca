
        function validarContato(){
                    
            d = document.formContato;
            e = document.getElementById("e");
            var parte1 = d.email.value.indexOf("@");
            var parte2 = d.email.value.length;
            //VALIDAR O CAMPO NOME
                
                        
            if(d.nome.value === ""){
                //alert("O campo NOME deve ser preenchido!");
                e.innerHTML="<div class='alert alert-danger'>O campo <b style=font-size:11pt;>nome</b> deve ser preenchido!</div>";
                d.nome.style.backgroundColor = "#000000";
                d.nome.style.color = "#EFFBFB";
                d.nome.focus();
                return false;
            }
                //VALIDAR O CAMPO EMAIL
            if(d.email.value == ""){
                //alert("O campo EMAIL deve ser preenchido!");
                e.innerHTML="<div class='alert alert-danger'>O campo <b style=font-size:11pt;>email</b> deve ser preenchido!</div>";
                d.email.style.backgroundColor = "#000000";
                d.email.style.color = "#EFFBFB";
                d.email.focus();
                return false;
            }
            //VALIDAR EMAIL (VERIFICAR O ENDEREÇO ELETRÔNICO)
            if(!(parte1 >= 3 && parte2 >= 9)){
                //alert("");
                e.innerHTML="<div class='alert alert-danger'>Preencha o <b style=font-size:11pt;>email</b> corretamente!<br>Ex: exemplo@exemplo.com.br</div>";
                d.email.style.backgroundColor = "#000000";
                d.email.style.color = "#EFFBFB";
                d.email.focus();
                return false;
            }   

            //VALIDAR O CAMPO Telefone
            if(d.telefone.value == ""){
                //alert("O campo Telefone deve ser preenchido!");
                e.innerHTML="<div class='alert alert-danger'>Preencha o <b style=font-size:11pt;>telefone</b> corretamente!</div>";
                d.telefone.style.backgroundColor = "#000000";
                d.telefone.style.color = "#EFFBFB";
                d.telefone.focus();
                return false;
            }
            	//VALIDAR O CAMPO Telefone                
           if(d.mensagem.value == ""){
                e.innerHTML="<div class='alert alert-danger'>Preencha a <b style=font-size:11pt;>mensagem</b> corretamente!</div>";
                //alert("O campo Senha deve ser preenchido!");
                d.mensagem.style.backgroundColor = "#000000";
                d.mensagem.style.color = "#EFFBFB";
                d.mensagem.focus();
                return false;
            }

                document.formContato.submit(); 
                        
        }
           
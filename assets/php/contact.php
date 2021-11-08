<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "contato@praxisjr.com.br";
    $email_subject = "Contato via Site";
 
    function died($error) {
        // your error code can go here
        echo "Me desculpe, mas encontramos erros no preenchimento do formulário. ";
        echo "Esses são os erros abaixo.<br /><br />";
        echo $error."<br /><br />";
        echo "Por favor, volte e tente novamente! <br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['nome']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telefone']) ||
        !isset($_POST['empresa']) ||
        !isset($_POST['mensagem'])) {
        died('Desculpe, mas encontramos erros no preenchimento do formulário.');       
    }

    $info = '';
    if(isset($_POST['taskOption'])){
      $sector = $_POST['taskOption'];
      switch ($sector) {
        case 'cc':
          $info = "Construção Civil "."\n";
          echo 'this is value1<br/>';
          break;
        case 'ti':
          $info = "Tecnologia da Informação"."\n";
          echo 'value2<br/>';
          break;
  
          case 'cg':
            $info = "Consultoria em Gestão"."\n";
            echo 'value3<br/>';
            break;

            case 'se':
              $info = "Soluções em Engenharia"."\n";
              echo 'value4<br/>';
              break;

              case 's':
                $info = "Sustentabilidade"."\n";
                echo 'value5<br/>';
                break;
      
          default:
              # code...
              break;
      }
  }
 
	# Visualizando os dados
	var_dump($_POST);
 
    $first_name = $_POST['nome']; // required
    $email_from = $_POST['email']; // required
    $phone = $_POST['telefone']; // required
    $company = $_POST['empresa']; // required
    $comments = $_POST['mensagem']; // required
    $sector = $_POST['taskOption']; // required

 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'O endereço de email que preencheu não parece válido.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'O nome que preencheu não parece válido.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'A mensagem que preencheu não parece válido.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Detalhes da mensagem abaixo.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
    $email_message .= clean_string($sector)."\n";
    $email_message .= clean_string($info);
    $email_message .= "Nome: ".clean_string($first_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telefone: ".clean_string($phone)."\n";
    $email_message .= "Mensagem: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
echo "<script>alert("Obrigado! Em breve entraremos em contato");window.location.assign('http://www.solvum.com.br/');</script>";
 
<?php
 
}
?>
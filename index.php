<?php
  // conectando com banco de dados local
  $db = mysqli_connect("localhost", "root", "", "test");

  // validando mensagem de status de conecção
  $msg = "";

  // vefificar do uplod / tratativa do arquivo ...
  if (isset($_POST['upload'])) {
  	// Nome que vem do post
  	$pdf = $_FILES['pdf']['name'];
    $pdf2 = $_FILES['pdf2']['name'];

  	//  Post da lejenda descrição pdf_test
  	$pdf__text = mysqli_real_escape_string($db, $_POST['pdf__text']);

  	// caminho onde será salvo o arquivo
  	$caminho = "upload/".basename($pdf);
    $caminho2 = "upload/".basename($pdf2);

  	$sql = "INSERT INTO upload (pdf, pdf2, pdf__text) VALUES ('$pdf', '$pdf2', '$caminho')";
  	
    // execução da instrução.
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['pdf']['tmp_name'],$caminho)) {
        $msg = "Funcionou...";
  	}else{
  		$msg = "Algo deu errado no ubload";
  	}if (move_uploaded_file($_FILES['pdf2']['tmp_name'],$caminho)) {
        $msg = "Funcionou...";
      }else{
          $msg = "Algo deu errado no ubload";
      }
}
  $result = mysqli_query($db, "SELECT * FROM upload");
?>
<!DOCTYPE html>
<html>
<head>
<title>Upload de PDF</title>
<style type="text/css">
   #content{
   	width: 50%;
   	margin: 20px auto;
   	border: 1px solid #cbcbcb;
   }
   form{
   	width: 50%;
   	margin: 20px auto;
   }
   form div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 80%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
   }
   #img_div:after{
   	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	float: left;
   	margin: 5px;
   	width: 300px;
   	height: 140px;
   }
</style>
</head>
<body>
<div id="content">
  <?php
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
      	echo "<img src='upload/".$row['pdf']."' >";
          echo "<img src='upload/".$row['pdf2']."' >";
      	echo "<p>".$row['pdf__text']."</p>";
      echo "</div>";
    }
  ?>
  <form method="POST" action="index.php" enctype="multipart/form-data">
  	<input type="hidden" name="tamanho" value="1000000">
  	<div>
  	  <input type="file" name="pdf">
        <input type="file" name="pdf2">
  	</div>
  	<div>
      <textarea 
      	id="text" 
      	cols="40" 
      	rows="4" 
      	name="pdf__text" 
      	placeholder="descrição do Upload"></textarea>
  	</div>
  	<div>
  		<button type="submit" name="upload">Enviar</button>
  	</div>
  </form>
</div>
</body>
</html>
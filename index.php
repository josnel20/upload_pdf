<?php
error_reporting(0);
 // conectando com banco de dados local
 $db = mysqli_connect("localhost", "root", "", "test");

 // validando mensagem de status de conecção
 $msg = "";

foreach ($_FILES["pictures"]["error"] as $key => $error)
{
       $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
       if (!$tmp_name) continue;

       $name = basename($_FILES["pictures"]["name"][$key]);

    if ($error == UPLOAD_ERR_OK)
    {
        if ( move_uploaded_file($tmp_name, "upload/".$name) )
            $uploaded_array[] .= "Eviado com sucesso '".$name."'.<br/>\n";
            $sql = "INSERT INTO upload (pdf, pdf__text) VALUES ('$name', '$error')";
  	        mysqli_query($db, $sql);
            if ($sql) {
                echo'
                <script>swal("Good job!", "You clicked the button!", "success");</script>
                ';
            }
    }
    else $errormsg .= "Erro. [".$error."] on file '".$name."'<br/>\n";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Teste Capital</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script type="text/javascript" src="jquery-2.1.3.min.js"></script>
</head>
<body>
<div class="conteudo">
        <style>
            table{
                margin: 0 auto;
            }
            img{
                width: 200px;
                display: block;
                margin-left: auto;
                margin-right: auto
            }
            h1{
            text-align: center;
            }
            #enviar{
                background-color:#f5041b;
                color:white;
                padding:10px;
                border: none;
                border-radius: 10px;
           }
        </style>
        <div class="container">
            <div class="jumbotron">
            <h1>  <b>Upload PDF</b></h1>
           
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="pictures[]" accept="upload/*" ><br>
                <input type="file" name="pictures[]" accept="upload/*" ><br><br><br>
                <input type="submit" value="Enviar" name="enviar" id="enviar"/>
            </form>
            </div>
        </div>
    </div>
    <script src="jquery-2.1.3.min.js"></script>
</body>
</html>
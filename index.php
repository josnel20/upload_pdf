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
        <h1><b>Upload PDF</b></h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="pictures[]" accept="upload/*" ><br>
                <input type="file" name="pictures[]" accept="upload/*" ><br><br><br>
            <input type="submit" value="Enviar" name="enviar" id="enviar"/>
        </form>
    </div>
</div>

        <div class="container">
            <div class="jumbotron">
            <h2>Criar json</h2><br>
            <h5>A saída no formato Json será criada assim que enviar os arquivos</h5>
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
       
       $data_upload= date("y-m-d h:i:s");
       $endereco_fisico= "upload/".$name;

    if ($error == UPLOAD_ERR_OK)
    {
        if ( move_uploaded_file($tmp_name, "upload/".$name) )
            $uploaded_array[] .= "Eviado com sucesso '".$name."'.<br/>\n";
            $sql = "INSERT INTO upload (pdf, endereco_fisico, data_upload) VALUES ('$name', '$endereco_fisico', '$data_upload')";
  	        $certo = $sql;

            mysqli_query($db, $sql);
       
            //json monstrando dados do ubload
            $array=[
                'Instancia do Upload',
                'Nome do arquivo incluido no Banco: ' => $name,
                'Gerado com sucesso' => [
                    'Data do Upload'=> $data_upload,
                    'Posicao do arquivo no array' => $key,
                ]
            ];
            //exibição do Json
            $json= json_encode($array, JSON_PRETTY_PRINT);
            echo "<pre>";
            print_r($json);
            echo "<pre>";
            //clink do arquivo direto do diretório.
            echo 
                '<div>
                <p>Enderco local do arquivo <a href="'.$endereco_fisico.'">Endereco local do arquivo</a></p>
                </div>';
    }
            //validação do arquivo pdf
            else $errormsg .= "Erro. [".$error."] no ficheiro '".$name."'<br/>\n";
        }
?>     
            </div>
        
        </div>
    </div>
    <script src="jquery-2.1.3.min.js"></script>
</body>
</html>
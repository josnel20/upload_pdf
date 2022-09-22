<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Teste Capital</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<div class="conteudo">
        <style>
            table{
                margin: 0 auto;
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
           .swal-button{
            background:#f5041b;
           }
           .swal-button:hover {
            background-color:blue;
           }
        </style>
<div class="container">
        <div class="jumbotron">
        <h1><b>Upload PDF</b></h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="pdf[]" accept="upload/*" id="pdf"><br>
                <input type="file" name="pdf[]" accept="upload/*" id="pdf"><br><br><br>
            <input type="submit" value="Enviar" name="enviar" id="enviar"/>
        </form>
    </div>
</div>

<?php
include_once('insert.php');
?>

    <script src="jquery-2.1.3.min.js"></script>
</body>
</html>
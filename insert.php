<div class="container">
    <div class="jumbotron">
        <h2>Criar json</h2><br>
<?php

error_reporting(0);

 // conectando com banco de dados local
 $db = mysqli_connect("localhost", "root", "", "test");

 // validando mensagem de status de conecção
 $msg = "";



if (isset($_POST['enviar'])) {

foreach ($_FILES["pdf"]["error"] as $key => $error)
{       

       $tmp_name = $_FILES["pdf"]["tmp_name"][$key];
       
       if (!$tmp_name) continue;

 // adicionar números randômicos na frente do nome para não gerar conflitos no banco.
       $name = mt_rand().($_FILES["pdf"]["name"][$key]);
       $data_upload= date("y-m-d h:i:s");
       $endereco_fisico= "upload/".$name;
       $input = 'pdf';

    if ($error == UPLOAD_ERR_OK)
    {
        if ( move_uploaded_file($tmp_name, "upload/".$name) )
            $uploaded_array[] .= "Eviado com sucesso '".$name."'.<br/>\n";
            $sql = "INSERT INTO upload (pdf, endereco_fisico, data_upload) VALUES ('$name', '$endereco_fisico', '$data_upload')";

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

            //exibição do Json na tela
            $json = json_encode($array, JSON_PRETTY_PRINT);
            echo "<pre>";
            print_r($json);
            echo "<pre>";

            //link do arquivo direto do diretório.
            echo 
                '<div>
                    <p>Enderco local do arquivo <a href="'.$endereco_fisico.'">Endereco local do arquivo</a></p>
                </div>';
    }
    if ($name =="") 
    {
?>

<?php
    }
            //validação do arquivo pdf
        else $errormsg .= "Erro. [".$error."] no ficheiro '".$name."'<br/>\n";
        }
        if ($name == "") 
        {  
?>
            
<script>
    swal
        ({
        title: "Erro, campos vazios!",
        text: "Tente adicionar algun arquivo",
        icon: "warning",
        button: "Fechar",
        });
</script>
            
<?php
    
    
        }
                            }
        else{
        echo '<h5>A saída no formato Json será criada assim que enviar os arquivos</h5>';
    }

    if ($error == UPLOAD_ERR_OK)
    {
    
        if ($sql)
    {  
?> 

<script>
    swal({
        title: "Parabéns",
        text: "Arquivos incluídos no banco com sucesso!",
        icon: "success",
        button: "Fechar",
});
</script>

<?php
    } // ATENÇÃO ADICIONAR O ERRO AO ADICIONAR NO BANCO
}
?>
            </div>
        
        </div>
    </div>
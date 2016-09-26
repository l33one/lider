
<?php
    include 'cabecalho.php';
    include 'rodape.php';
    include 'conexao.php';
    $matricula = "";
    if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["matricula"])){
        $matricula = test_input($_POST["matricula"]);
        $dados_Aluno = consulta(
            "SELECT 
            Nome
            ,Matricula
            ,Data_Nasc
            ,Fone
            ,Fone_Responsavel
            ,email
            ,celular
            ,celular_responsavel
            ,data_cadastro
            ,Cancelado
            ,data_inicio_curso
            ,dt_cancelamento
            ,dt_conclusao
             FROM ALUNOS
             WHERE matricula = '". $matricula ."'");
        if($dados_Aluno){
            $nome = $dados_Aluno[0];
            $matricula = $dados_Aluno[1];
            $data_nasc = $dados_Aluno[2];
            $fone = $dados_Aluno[3];
            $fone_Responsavel = $dados_Aluno[4];
            $email = $dados_Aluno[5];
            $celular  = $dados_Aluno[6];
            $celular_responsavel = $dados_Aluno[7];
            $data_cadastro = $dados_Aluno[8];
            $cancelado = $dados_Aluno[9];
            $data_inicio_curso = $dados_Aluno[10];
            $dt_cancelamento = $dados_Aluno[11];
            $dt_conclusao =$dados_Aluno[12];
        } else {
            $nome = '<p><span class="label label-danger">Nenhum resultado encontrado!</span></p>';
            $matricula = $data_nasc = $fone = $fone_responsavel = $email = $celular = $celular_responsavel = $data_cadastro = $cancelado = $data_inicio_curso = $dt_cancelamento = $dt_conclusao = null;
        }
    
    }
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

function idade($data_nasc){
    $date1 = $data_nasc;
    $date2 = date_create(date('d-m-Y'));
$interval = date_diff($date1,$date2); 
return $interval->format(' %Y Anos');

}
 ?>
    <div class="container-fluid">
        <H1 >Situação Aluno</H1>
        <form class="form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <input type="text" name="matricula" class="form-control input-lg" id="matricula" placeholder="Matrícula" required>
                <input class="btn btn-default btn-lg" type="submit" value="Buscar">
            </div>
        </form>
    </div>
  
<div class="container">
    <h2>Consulta Aluno Lider</h2>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#ddPessoais">Dados Pessoais</a></li>
        <li><a data-toggle="tab" href="#ddCurso">Dados Curso</a></li>
        <li><a data-toggle="tab" href="#ddFinanceiro">Financeiro</a></li>
    </ul>
    
    <div class="tab-content">
        <div id="ddPessoais" class="tab-pane fade in active">
            
            <table class="table">
                
                <?php
                
                if (isset($nome) and $nome != null){  
                    echo "<p>".$nome."</p>";
                } 
                
                
                if (isset($matricula) and $matricula != null){  
                    echo "<tr><td>Matrícula</td><td>".$matricula."</td></tr>";
                } 
                
                if (isset($fone) and $fone != null){  
                    echo "<tr><td>Telefone</td><td>".$fone."</td></tr>";
                }
                
                if (isset($celular) and $celular != null){  
                    echo "<tr><td>Celular</td><td>".$celular."</td></tr>";
                }
                if (isset($email) and $email != null){  
                    echo "<tr><td>E-mail</td><td>".$email."</td></tr>";
                } 
                if (isset($data_nasc) and $data_nasc != null){  
                    echo "<tr><td>Data Nascimento</td><td>".date_format($data_nasc,'d-m-Y')."<strong>".idade($data_nasc)."</strong></td></tr>";
                }
                if (isset($data_cadastro) and $data_cadastro != null){  
                    echo "<tr><td>Data Matrícula</td><td>".date_format($data_cadastro,'d-m-Y')."</td></tr>";
                }
                
                if (isset($dt_cancelamento) and $dt_cancelamento != null){  
                    echo "<tr><td>Data Cancelamento</td><td>".date_format($dt_cancelamento,'d-m-Y')."</td></tr>";
                } 
                    
                if (isset($dtr_conclusao) and $dt_conclusao != null){  
                        echo "<tr><td>Data Conclusão</td><td>".date_format($dt_conclusao,'d-m-Y')."</td></tr>";
                    } 
                ?>

            </table>
            
            
        </div>
        <div id="ddCurso" class="tab-pane fade"></div>
        <div id="ddFinanceiro" class="tab-pane fade"></div>
    </div>
</div>
  
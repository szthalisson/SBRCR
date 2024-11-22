<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Emprestimos - SBRCR</title>
	<link rel="stylesheet" href="../css/consulta.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
	<header>
		<a href="livros.php" class="icon">
			<i class="bi bi-arrow-left"></i>
		</a>
		<h3>Sistema Bibliotecário da <span class="titulo-laranja">EEEP Raimundo Célio Rodrigues</span></h3>
		<nav>
			<a class="btn-laranja" href="livros.php">Livros</a>
		</nav>
	</header>
	<main>
		<h1>Empréstimos</h1>
		<div class="container">


			<div class="pesquisa">
				<form method="POST" action="" class="form-pesquisa"> 
					<button type="submit"><i class="bi bi-search"></i></button>
					<input type="text" name="pesquisa" id="">
				</form>
				<a class="btn-laranja" href=""><i class="bi bi-journal-text"></i> Cadastrar empréstimo</a>
			</div>

            
                    <div class="conteudo">
                <?php
                        require "conexaoBd.php";

                    if(isset($_POST['pesquisa'])){      //Caso algo seja pesquisado
                        $pQ = $_POST['pesquisa'];
                            if($pQ == ""){              //Caso algo seja pesquisado E o campo de texto esteja vazio
                                $sqlListar = mysqli_query($con, "select aluno.id_aluno as id_aluno, livro.nome_l as nome_livro, aluno.nome_a as nome_aluno, aluno.curso as curso, emprestimo.data as data from emprestimo join aluno on emprestimo.id_aluno=aluno.id_aluno join livro on emprestimo.id_livro=livro.id_livro");
                            }else{                      //Caso algo seja pesquisado E algo tenha sido digitado
                                $sqlListar = mysqli_query($con, "select aluno.id_aluno as id_aluno, livro.nome_l as nome_livro, aluno.nome_a as nome_aluno, aluno.curso as curso, emprestimo.data as data from emprestimo join aluno on emprestimo.id_aluno=aluno.id_aluno join livro on emprestimo.id_livro=livro.id_livro where aluno.nome_a like '%$pQ%' or livro.nome_l like '%$pQ%'");
                            }
                    }else{                              //Caso nada tenha sido pesquisado
                        $sqlListar = mysqli_query($con, "select aluno.id_aluno as id_aluno, livro.nome_l as nome_livro, aluno.nome_a as nome_aluno, aluno.curso as curso, emprestimo.data as data from emprestimo join aluno on emprestimo.id_aluno=aluno.id_aluno join livro on emprestimo.id_livro=livro.id_livro");
                    }
                    if(mysqli_num_rows($sqlListar) > 0){//Caso a pesquisa gere resultados
                        while($row = mysqli_fetch_assoc($sqlListar)){
                                echo "
                            <div class='item'>
                                <div class='info'> 
                                        <i class='bi bi-book'></i>
                                        <span>", $row['nome_livro'], "</span>
                                    </div>
                                    <div class='info'>
                                        <i class='bi bi-backpack2'></i>
                                        <span>", $row['nome_aluno'], "</span>
                                    </div>

                                    <div class='info'>
                                        <i class='bi bi-person-vcard-fill'></i>
                                        <span>", $row['curso'], "</span>
                                    </div>

                                    <div class='info'>
                                        <i class='bi bi-calendar-check'></i>
                                        <span>", $row['data'], "</span>
                                    </div>
                                    <div class='opcoes'>
                                        <a href='' class='excluir'><i class='bi bi-pencil-fill'></i></a>
                                        <a href='' class='editar'><i class='bi bi-trash3-fill'></i></a>
                                    </div>      
                            </div>                    
                                ";
                        }
                    }else{
                        echo "
                                <div class='item'>
                                    <div class='info'> 
                                        <span>Não encontramos nada... <a href='#' class='redirect'>Adicionar um novo.</a></span>
                                    </div>
                                </div>
                        ";
                    }
                ?>
		</div>
	</main>
	<footer>
		<img src="../imagens/brasao.png" alt="brasão da escola EEEP Raimundo Célio Rodrigues">
	</footer>
</body>
</html>
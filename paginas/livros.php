<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Livros - SBRCR</title>
	<link rel="stylesheet" href="../css/consulta.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
	<header>
		<a href="#" class="icon"> <!-- Este link vai ser o do INDEX -->
			<i class="bi bi-arrow-left"></i>
		</a>
		<h3>Sistema Bibliotecário da <span class="titulo-laranja">EEEP Raimundo Célio Rodrigues</span></h3>
		<nav>
			<a class="btn-laranja" href="emprestimos.html">Empréstimos</a>
		</nav>
	</header>
	<main>
		<h1>Livros</h1>
		<div class="container">
			<div class="pesquisa">
				<form method="POST" action="" class="form-pesquisa">
					<button type="submit"><i class="bi bi-search"></i></button>
					<input type="text" name="pesquisa" id="">
				</form>
				<a class="btn-laranja" href=""><i class="bi bi-journal-text"></i> Cadastrar livro</a>
			</div>
        <div class="conteudo">
                    <?php
                            require "conexaoBd.php";
                    
                        if(isset($_POST['pesquisa'])){
                            $pQ = $_POST['pesquisa'];
                                if($pQ == ""){
                                    $sqlListar = mysqli_query($con, "select nome_l, autor, quant from livro");
                                }else{
                                    $sqlListar = mysqli_query($con, "select nome_l, autor, quant from livro where nome_l like '%$pQ%' or id_livro='$pQ' or autor like '%$pQ%'");
                                }
                        }else{
                            $sqlListar = mysqli_query($con, "select nome_l, autor, quant from livro");
                        }

                        if(mysqli_num_rows($sqlListar) > 0){
                            while($row = mysqli_fetch_assoc($sqlListar)){
                            echo "
                                    <div class='item'>
                                        <div class='info'>
                                            <i class='bi bi-book'></i>
                                            <span>", $row['nome_l'],"</span>
                                        </div>
                                        <div class='info'>
                                            <i class='bi bi-person-lines-fill'></i>
                                            <span>", $row['autor'],"</span>
                                        </div>
                                        <div class='info'>
                                            <i class='bi bi-stack'></i>
                                            <span>", $row['quant'],"</span>
                                        </div>
                                        <div class='opcoes'>
                                            <a href='' class='excluir'><i class='bi bi-pencil-fill'></i></a>
                                            <a href='' class='editar'><i class='bi bi-trash3-fill'></i></a>
                                        </div>
                                    </div>

                            ";
                        }
                    }
                    ?>
		</div>
	</main>
	<footer>
		<img src="../imagens/brasao.png" alt="brasão da escola EEEP Raimundo Célio Rodrigues">
	</footer>
</body>
</html>
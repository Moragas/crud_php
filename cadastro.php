<?php
    include_once 'conectaBD.php';

    if (!empty($_POST)) {
        if ($_POST['cadUsuario'] == 'Cadastrar') { 
          try {
            
              $sql = "INSERT INTO tbcontatos
                        (nome, email, celular)
                      VALUES
                        (:nome, :email, :celular)";
      
              $stmt = $pdo->prepare($sql);
      
              $dados = array(
                ':nome' => $_POST['nome'],
                ':email' => $_POST['email'],
                ':celular' => $_POST['celular']
              );
      
              if ($stmt->execute($dados)) {
                header("Location: index.html?msgSucesso=Anúncio cadastrado com sucesso!");
              }
          } catch (PDOException $e) {
              die($e->getMessage());
              header("Location: index.html?msgErro=Falha ao cadastrar anúncio..");
          }
        }
        elseif ($_POST['cadUsuario'] == 'Editar') { // ALTERAR!!!
          /* Implementação do update aqui.. */
          // Construir SQL para update
          try {
            $sql = "UPDATE
                      tbContatos
                    SET
                      nome = :nome,
                      email = :email,
                      celular = :celular
                    WHERE
                      id = :id_contatos ";
      
            // Definir dados para SQL
            $dados = array(
              ':id_contatos' => $_POST['id_contatos'],
              ':nome' => $_POST['nome'],
              ':email' => $_POST['email'],
              ':celular' => $_POST['celular']
            );
      
            $stmt = $pdo->prepare($sql);
      
            // Executar SQL
            if ($stmt->execute($dados)) {
               echo 'Contato alterado com sucesso!';
            }
            else {
              echo 'Falha ao alterar contato!';
            }
          } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
          }
      
        }
        elseif ($_POST['cadUsuario'] == 'Deletar') { // EXCLUIR!!!
          /** Implementação do excluir aqui.. */
          // id_contatos ok
          // e-mail usuário logado ok
          try {
            $idToDelete = $_POST['id_contatos'];
        
            $sql = "DELETE FROM tbContatos WHERE id = :idToDelete";

            $dados = array(
              ':idToDelete' => $idToDelete
            );
           
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute($dados)) {
              echo 'Deletado com sucesso!';
            }
            else {
              echo 'Falha ao deletar!';
            }
          } catch (PDOException $e) {
            echo 'Falha ao deletar!' . $e->getMessage();
          }
        }
        else {
          echo '(1)Erro ao cadastrar!';
        }
      }
    else {
      echo '(2)Erro ao cadastrar!';
    }
    die();
?>
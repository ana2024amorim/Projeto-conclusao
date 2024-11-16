<?php
session_start();

// Incluir a conexão com o banco de dados
include('conector_db.php');

// Verificar se o usuário está logado e se a matrícula está na sessão
if (!isset($_SESSION['matricula'])) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Usuário não autenticado.']);
    exit;
}
// Depuração para verificar se a foto está sendo enviada corretamente
error_log(print_r($_FILES, true)); // Isso registra detalhes do arquivo no log de erros

// Usar a matrícula da sessão para garantir que é o usuário correto
$matricula = $_SESSION['matricula'];
$nova_senha = $_POST['novaSenha'] ?? null;
$confirmar_senha = $_POST['confirmaSenha'] ?? null;
$foto = $_FILES['foto'] ?? null;

// Variáveis de resposta
$resposta = ['sucesso' => false, 'mensagem' => 'Erro ao atualizar cadastro.'];


try {
    // Verificando a senha
    if ($nova_senha && $nova_senha === $confirmar_senha) {
        $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE tb_login SET password = ? WHERE matricula = ?");
        $stmt->bind_param("ss", $nova_senha_hash, $matricula);

        if ($stmt->execute()) {
            $resposta['mensagem'] = 'Senha alterada com sucesso.';
            $resposta['sucesso'] = true;
        } else {
            $resposta['mensagem'] = 'Erro ao atualizar a senha: ' . $conn->error;
            echo json_encode($resposta);
            exit;
        }
        $stmt->close();
    } elseif ($nova_senha) {
        $resposta['mensagem'] = 'As senhas não coincidem.';
        echo json_encode($resposta);
        exit;
    }

    // Verificando a foto
    if ($foto && $foto['error'] === 0) {
        // Depuração: Verificar detalhes do arquivo
        error_log('Arquivo foto: ' . print_r($foto, true)); // Registra detalhes do arquivo no log de erro
        
        // Validar extensão
        $extensao = pathinfo($foto['name'], PATHINFO_EXTENSION);
        $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array(strtolower($extensao), $extensoes_permitidas)) {
            $novo_nome_foto = 'perfil_' . $matricula . '.' . $extensao;
            $caminho_destino = '../uploads/' . $novo_nome_foto;

            // Depuração: Verificar se o arquivo foi movido corretamente
            if (move_uploaded_file($foto['tmp_name'], $caminho_destino)) {
                // Salvar o caminho completo no banco de dados (com 'uploads/' no caminho)
                $caminho_relativo_foto = 'uploads/' . $novo_nome_foto;

                // Atualizando o banco de dados com o caminho correto da foto
                $stmt = $conn->prepare("UPDATE tb_funcionario SET foto = ? WHERE matricula = ?");
                $stmt->bind_param("ss", $caminho_relativo_foto, $matricula);

                if ($stmt->execute()) {
                    $resposta['mensagem'] = 'Foto de perfil alterada com sucesso.';
                    $resposta['sucesso'] = true;
                } else {
                    $resposta['mensagem'] = 'Erro ao atualizar a foto no banco de dados: ' . $conn->error;
                    echo json_encode($resposta);
                    exit;
                }
                $stmt->close();
            } else {
                $resposta['mensagem'] = 'Erro ao mover a imagem para o diretório de uploads.';
                echo json_encode($resposta);
                exit;
            }
        } else {
            $resposta['mensagem'] = 'Extensão de imagem inválida. Permitidas: jpg, jpeg, png, gif.';
            echo json_encode($resposta);
            exit;
        }
    } elseif ($foto) {
        $resposta['mensagem'] = 'Erro no upload da imagem. Código de erro: ' . $foto['error'];
        echo json_encode($resposta);
        exit;
    }

    // Caso o código tenha chegado até aqui, isso significa que não houve falha nas operações
} catch (Exception $e) {
    $resposta['mensagem'] = 'Erro inesperado: ' . $e->getMessage();
    echo json_encode($resposta);
    exit;
}

// Retorna a resposta final
echo json_encode($resposta);
?>

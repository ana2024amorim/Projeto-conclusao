<?php
require('libs/fpdf.php');

// Criar o PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Texto pré-definido
$texto = "AUTORIZAÇÃO PARA A COLETA E O TRATAMENTO DE DADOS PESSOAIS DO SISTEMA PAROIKOS\n\n
Consentimento para processar informações pessoais nos termos da LEI N°. 13.709/18 – Lei Geral de Proteção de Dados Pessoais do Brasil (LGPD)\n\n
O objetivo da Política de Segurança da SISTEMA PAROIKOS é proteger as informações pessoais de indivíduos e organizações e dar efeito ao seu direito à privacidade, conforme previsto na Constituição Brasileira e na Lei do Brasil LGPD. Ao assinar este formulário,\n\n
Eu, na qualidade de titular dos dados, \"doravante designado por Titular dos Dados\" com documento de identificação ver abaixo, dou o meu consentimento a esta Organização e ao Centro Scalabriniano de Estudos Migratórios (CSEM), \"doravante designado por Responsável Parte\" para coletar, processar, proteger e tratar minhas informações pessoais quando esta Organização e o CSEM forem legalmente obrigados a fazê-lo.\n\n
Entendo que as finalidades para as quais minhas informações pessoais são necessárias são o cumprimento da Missão institucional e para a qual serão utilizadas e concordo de acordo com a Lei do País, utilizando minhas informações pessoais estritamente para fins de fornecimento de serviços a mim e para relatórios.\n\n
Compreendo o meu direito à privacidade e o direito de que as minhas informações pessoais sejam processadas de acordo com as condições para o processamento legal de informações pessoais.\n\n
Declaro que todas as minhas informações pessoais fornecidas são precisas, atualizadas, não enganosas e que estão completas em todos os aspectos e serão mantidas e/ou armazenadas de forma segura para a finalidade da qual foram coletadas.\n\n
Estou ciente de que posso utilizar o canal de atendimento ao cliente do Sistema Paroikos e desta Unidade que integra o Sistema Paroikos, através do endereço de e-mail paroikos@csem.org.br, para esclarecer dúvidas e/ou fazer solicitações relacionadas ao tratamento dos meus dados pessoais.\n\n
Eu, ___________________, documento de identificação ________________, dou meu consentimento, como parte co-responsável para processar minhas informações pessoais e consentimento com efeito imediato e permanecerá em vigor até que tal consentimento seja retirado. Estou ciente de que:\n\n
a) Os meus Dados Pessoais serão utilizados apenas para as funções e atividades desenvolvidas por estas organizações no cumprimento da sua missão institucional.\n\n
Data: " . date('d/m/Y');

// Converter para ISO-8859-1
$texto = utf8_decode($texto); // Converte o texto para ISO-8859-1

// Dividir o texto em linhas menores, com até 180 caracteres por linha
$textoFormatado = wordwrap($texto, 180, "\n", true);

// Adicionar o texto ao PDF
$pdf->MultiCell(0, 10, $textoFormatado);

// Salvar o PDF no servidor
$arquivo = 'documento.pdf';
$pdf->Output('F', $arquivo);

// Redirecionar para a página de aceite
header("Location: aceitar.php");
exit;
?>

// esse e o aceitar.php original
<?php
// Inicia a sessão
session_start();

// Armazena o nome na sessão
$_SESSION['nome'] = $nome;
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta charset="ISO-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aceitar Documento</title>
</head>
<body>
    <h1>Visualize o Documento e Aceite</h1>
    
    <!-- Visualizar o PDF -->
    <iframe src="documento_. '$nome'.pdf" width="100%" height="600px"></iframe>

    <!-- Formulário de aceite -->
    <form action="salvar_aceite.php" method="POST">
        <label>
            <input type="checkbox" name="aceite" value="1" required> Eu li e aceito os termos do documento.
        </label>
        <br><br>
        <button type="submit">Confirmar Aceite</button>
    </form>
</body>
</html>
<?php
require('libs/fpdf.php');

// Criar o PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Texto pré-definido
$texto = "AUTORIZAÇÃO PARA A COLETA E O TRATAMENTO DE DADOS PESSOAIS DO SISTEMA PAROIKOS

Consentimento para processar informações pessoais nos termos da LEI N°. 13.709/18 – Lei Geral de Proteção de Dados Pessoais do Brasil (LGPD)

O objetivo da Política de Segurança da SISTEMA PAROIKOS é proteger as informações pessoais de indivíduos e organizações e dar efeito ao seu direito à privacidade, conforme previsto na Constituição Governamental e na Lei do Brasil LGPD. Ao assinar este formulário,

    Eu, na qualidade de titular dos dados, “doravante designado por Titular dos Dados” com documento de identificação ver abaixo, dou o meu consentimento a esta Organização e ao Centro Scalabriniano de Estudos Migratórios (CSEM), “doravante designado por Responsável Parte” para coletar, processar, proteger e tratar minhas informações pessoais quando esta Organização e o CSEM forem legalmente obrigados a fazê-lo.

    Entendo que as finalidades para as quais minhas informações pessoais são necessárias é o cumprimento da Missão institucional e para a qual serão utilizadas e concordo de acordo com a Lei do País, utilizando minhas informações pessoais estritamente para fins de fornecimento de serviços a mim e para relatórios.

    Compreendo o meu direito à privacidade e o direito de que as minhas informações pessoais sejam processadas de acordo com as condições para o processamento legal de informações pessoais.

    Declaro que todas as minhas informações pessoais fornecidas são precisas, atualizadas, não enganosas e que estão completas em todos os aspectos e serão mantidas e/ou armazenadas de forma segura para a finalidade da qual foram coletadas.

Estou ciente de que posso utilizar o canal de atendimento ao cliente do Sistema Paroikos e desta Unidade que integra o Sistema Paroikos, através do endereço de e-mail paroikos@csem.org.br, para esclarecer dúvidas e/ou fazer solicitações relacionadas ao tratamento dos meus dados pessoais.

Eu, ___________________, documento de identificação ________________, dou meu consentimento, como parte co-responsável para processar minhas informações pessoais e consentimento com efeito imediato e permanecerá em vigor até que tal consentimento seja retirado. Estou ciente de que:

a) Os meus Dados Pessoais serão utilizados apenas para as funções e atividades desenvolvidas por estas organizações no cumprimento da sua missão institucional." . date('d/m/Y');


$pdf->MultiCell(0, 10, $texto);

// Salvar o PDF no servidor
$arquivo = 'documento.pdf';
$pdf->Output('F', $arquivo);

// Redirecionar para a página de aceite
header("Location: aceitar.php");
exit;
?>

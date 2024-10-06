<?php
// Arquivo de configuração do servidor SMTP

return [
    'host' => 'lrn.nextpoint.com.br',       // Endereço do servidor SMTP
    'username' => 'guardian@lrn.nextpoint.com.br', // Seu e-mail
    'password' => 'Guardian2024!',              // Sua senha de e-mail
    'smtp_secure' => 'TLS', // Segurança (TLS ou SSL)
    'port' => 587,                          // Porta do servidor SMTP (587 para TLS, 465 para SSL)
    'from_email' => 'guardian@lrn.nextpoint.com.br', // O e-mail do remetente
    'from_name' => 'Guardian',              // Nome que aparecerá no remetente
    'smtp_debug' => 0,                      // Nível de debug (0 = sem debug, 2 = debug detalhado)
];
?>

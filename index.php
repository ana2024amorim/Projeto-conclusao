<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css" />
    
</head>

<body>  
    
  <div class="wave-blue"></div>
  
  <form method="POST" action="conector/acesso.php">
      <div class="titulo">
          <h1>Faça o seu login</h1>
          <div class="barra-horizontal"></div>
      </div>
      <div class="campo-input">
          <label for="matricula">Sua matrícula*</label>
          <input type="number" id="matricula" name="matricula" required />
      </div>
      <div class="campo-input">
          <label for="password">Sua senha*</label>
          <input type="password" id="password" name="password" required />
      </div>  
      
      <button type="submit">Entrar</button>
      <!-- Para classe esqueceu a senha -->
      <p class="esqueceu-senha">
          Esqueceu sua senha?
          <a href="testes/recuperar_senha.php" target="_blank">Clique aqui!</a>
      </p>
  </form>

  
</body>
</html>
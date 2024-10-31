<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Painel de Controle - Meu Admin</title>
    <meta name="author" content="Seu Nome">
    <meta name="description" content="Este é um painel de controle para gerenciar suas tarefas e dados.">
    <meta name="keywords" content="painel, admin, controle, tarefas">

    <link rel="stylesheet" href="css/painel_admin.css">
    <link href="css/painel_admin.min.css" rel="stylesheet">
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
</head>
<style>
    html, body {
        height: 100vh; /* Garante que o html e o body ocupem 100% da altura da viewport */
        margin: 0;     /* Remove margens */
        overflow: hidden; /* Impede a rolagem vertical se não for necessária */
    }

    body {
        align-items: flex-start; /* Alinha os itens no topo da página */
        background-color: #FF7F50; /* Cor de fundo  */
        padding-left: 20px; /* Ajuste o padding conforme necessário */
        margin-left: -160px;
    }

    .content {
        padding: 20px; /* Adiciona espaço interno */
        max-width: 1200px; /* Define uma largura máxima */
        width: 100%;    /* Garante que o conteúdo ocupe toda a largura */
        margin: auto;   /* Centraliza o conteúdo horizontalmente */
    }
</style>

<body class="bg-orange-500 font-sans leading-normal tracking-normal mt-12">
  
    <!--Nav-->
    <nav class="bg-orange-500 pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">
        <div class="flex flex-wrap items-center">
            <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start text-white">
                <a href="#">
                    <span class="text-xl pl-2"><i class="em em-grinning"></i></span>
                </a>
            </div>

            <div class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
                <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block py-2 px-4 text-white no-underline" href="#">Ativo</a>
                    </li>
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline py-2 px-4" href="#">Link</a>
                    </li>
                    <li class="flex-1 md:flex-none md:mr-3">
                        <div class="relative inline-block">
                            <button onclick="toggleDD('myDropdown')" class="drop-button text-white focus:outline-none"> <span class="pr-2"><i class="em em-robot_face"></i></span> Olá, Usuário <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg></button>
                            <div id="myDropdown" class="dropdownlist absolute bg-orange-500 text-white right-0 mt-3 p-3 overflow-auto z-30 invisible">
                                <input type="text" class="drop-search p-2 text-gray-600" placeholder="Pesquisar.." id="myInput" onkeyup="filterDD('myDropdown','myInput')">
                                <a href="#" class="p-2 hover:bg-orange-500 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-user fa-fw"></i> Perfil</a>
                                <a href="#" class="p-2 hover:bg-orange-500 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-cog fa-fw"></i> Configurações</a>
                                <div class="border border-gray-800"></div>
                                <a href="#" class="p-2 hover:bg-orange-500 text-white text-sm no-underline hover:no-underline block"><i class="fas fa-sign-out-alt fa-fw"></i> Sair</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- menus-->
    <div class="flex flex-col md:flex-row">

        <div class="bg-orange-500 shadow-xl h-16 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48">

            <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
                <ul class="list-reset flex flex-row md:flex-col py-0 md:py-3 px-1 md:px-2 text-center md:text-left">
                    <li class="mr-3 flex-1">
                        <a href="#" onclick="document.getElementById('contentFrame').src='frame_admin.php';" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500">
                            <i class="fas fa-tasks pr-0 md:pr-3"></i>
                            <span class="pb-1 md:pb-0 text-xs md:text-base text-white block md:inline-block">Tarefas</span>
                        </a>
                    </li>
                    <li class="mr-3 flex-1">
                        <a href="#" onclick="document.getElementById('contentFrame').src='messages.html';" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500">
                            <i class="fa fa-envelope pr-0 md:pr-3"></i>
                            <span class="pb-1 md:pb-0 text-xs md:text-base text-white block md:inline-block">Mensagens</span>
                        </a>
                    </li>
                    <li class="mr-3 flex-1">
                        <a href="#" onclick="document.getElementById('contentFrame').src='analytics.html';" class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-red-500">
                            <i class="fas fa-chart-area pr-0 md:pr-3 "></i>
                            <span class="pb-1 md:pb-0 text-xs md:text-base text-white block md:inline-block">Análises</span>
                        </a>
                    </li>
                    <li class="mr-3 flex-1">
                        <a href="#" onclick="document.getElementById('contentFrame').src='payments.html';" class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-red-500">
                            <i class="fa fa-wallet pr-0 md:pr-3"></i>
                            <span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">Pagamentos</span>
                        </a>
                    </li>
                    <li class="mr-3 flex-1">
                        <a href="#" onclick="document.getElementById('contentFrame').src='cadastro_funcionario.php';" class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-red-500">
                            <i class="fas fa-chart-area pr-0 md:pr-3 "></i>
                            <span class="pb-1 md:pb-0 text-xs md:text-base text-white block md:inline-block">Cadastro Funcionario</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Iframe for content -->
        <iframe id="contentFrame" src="pagina_venda.php" class="w-full h-screen mt-12 md:mt-0 md:ml-48"></iframe>
        
    </div>
    
    <script>
        // Toggle the dropdown menu
        function toggleDD(dropdownId) {
            document.getElementById(dropdownId).classList.toggle("invisible");
        }

        // Filter dropdown menu
        function filterDD(dropdownId, inputId) {
            let input, filter, ul, li, a, i;
            input = document.getElementById(inputId);
            filter = input.value.toUpperCase();
            div = document.getElementById(dropdownId);
            a = div.getElementsByTagName("a");
            for (i = 0; i < a.length; i++) {
                txtValue = a[i].textContent || a[i].innerText;
                a[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
            }
        }
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
    html, body, button, input, select, textarea {
        font-family: 'Montserrat', sans-serif !important;
    }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel TV - Chamada Hospitalar</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>
    <meta http-equiv="refresh" content="10">
    <style>
        @keyframes pulse-custom {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.6;
            }
        }

        .piscar {
            animation: pulse-custom 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>

<body
    class="bg-[#edf6f9] text-slate-800 font-sans min-h-screen flex flex-col justify-between overflow-hidden select-none">

    <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">

        <div class="flex items-center space-x-2 text-cyan-600 font-bold text-xl">

            <img src="{{ asset('images/LogoOficial.svg') }}" alt="Logo Tria" class="w-8 h-8 object-contain">

            <span>Tria</span>

        </div>



        <nav class="flex items-center space-x-6 text-sm font-medium text-slate-600">


            <a href="#" class="hover:text-cyan-600 transition">Painel de Chamada</a>



            <a href="{{ route('login') }}"
                class="border text-white bg-[#01BED9] px-4 py-1.5 rounded-full flex items-center space-x-2 ">

                <i data-lucide="log-in" class="h-4 w-4"></i>


                <span>Login</span>

            </a>

        </nav>

    </header>


    <main class="flex-grow flex flex-col justify-center items-center px-12">
        <div class="w-full max-w-6xl bg-white p-12 rounded-3xl shadow-sm border border-slate-100">

            <h2 class="text-3xl font-bold text-slate-900 mb-8 tracking-tight">Painel de chamada</h2>

            <div
                class="w-full bg-gradient-to-br from-[#00658E] to-[#01BED9] text-white py-16 px-14 rounded-3xl shadow-md flex flex-col justify-between items-center relative min-h-[380px]">

                <p class="text-xl font-bold uppercase tracking-widest text-cyan-100/90 piscar">
                    CHAMANDO AGORA
                </p>

                <h1
                    class="text-7xl font-extrabold text-white tracking-tight uppercase text-center max-w-5xl break-words px-4 leading-tight my-auto">
                    {{ $paciente['nome'] ?? 'Sem chamadas ativas' }}
                </h1>

                <p class="text-3xl font-bold tracking-wide text-cyan-50/90">
                    {{ $paciente['destino'] ?? 'Aguarde na recepção' }}
                </p>



            </div>
        </div>
    </main>


    <script>
        lucide.createIcons();
    </script>
</body>

</html>

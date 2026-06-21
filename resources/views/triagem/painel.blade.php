<!DOCTYPE html>

<html lang="pt-BR">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tria - Painel de Triagem</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://unpkg.com/lucide@latest"></script>

</head>



<body class="bg-sky-50 text-slate-700 font-sans antialiased min-h-screen">



    <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">

        <div class="flex items-center space-x-2 text-cyan-600 font-bold text-xl">

            <div class="border-2 border-cyan-600 rounded-full p-1 flex items-center justify-center w-8 h-8">

                <i class="fa-solid fa-plus text-xs"></i>

            </div>

            <span>Tria</span>

        </div>



        <nav class="flex items-center space-x-6 text-sm font-medium text-slate-600">

            @if (isset($funcionario) && $funcionario->perfil === 'Recepcionista')
                <a href="{{ route('triagem.index') }}" class="hover:text-cyan-600 transition">Cadastro de Paciente</a>
            @else
                <a href="{{ route('triagem.index') }}" class="text-cyan-600 transition">Triagem</a>
            @endif



            <a href="#" class="hover:text-cyan-600 transition">Painel de Chamada</a>



            <a href="{{ route('funcionarios.perfil') }}"
                class="border border-cyan-500 text-cyan-600 px-4 py-1.5 rounded-full flex items-center space-x-2 bg-cyan-50 transition">

                <i class="fa-regular fa-user"></i>

                <span>Perfil</span>

            </a>



            <a href="#"
                class="bg-cyan-500 text-white px-4 py-1.5 rounded-lg flex items-center space-x-2 hover:bg-cyan-600 transition">

                <i class="fa-solid fa-arrow-right-from-bracket"></i>

                <span>Sair</span>

            </a>

        </nav>

    </header>



    <main class="max-w-7xl mx-auto p-6 md:p-10 space-y-6">



        <div>

            <h1 class="text-2xl font-bold text-slate-800">Avaliação e classificação de risco</h1>

        </div>



        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">



            <div class="md:col-span-5 space-y-6">

                <div class="grid grid-cols-2 gap-4">

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">

                        <span class="text-xs font-bold text-cyan-600 tracking-wider uppercase block mb-1">Aguardando
                            Triagem</span>

                        <span class="text-4xl font-extrabold text-slate-800">3</span>

                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">

                        <span class="text-xs font-bold text-cyan-600 tracking-wider uppercase block mb-1">Triados
                            Hoje</span>

                        <span class="text-4xl font-extrabold text-slate-800">22</span>

                    </div>

                </div>



                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">

                    @include('triagem.listar')

                </div>

            </div>



            <div class="md:col-span-7 bg-white p-8 rounded-2xl shadow-sm border border-slate-100">

                @include('triagem.cadastrar')

            </div>



        </div>

    </main>



    <script>
        lucide.createIcons();
    </script>

</body>



</html>

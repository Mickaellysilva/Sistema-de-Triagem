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
    <title>Tria - Perfil</title>
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
            @if(isset($funcionario) && $funcionario->perfil === 'Recepcionista')
                <a href="{{ route('triagem.index') }}" class="hover:text-cyan-600 transition">Cadastro de Paciente</a>
            @else
                <a href="{{ route('triagem.index') }}" class="hover:text-cyan-600 transition">Triagem</a>
            @endif
            
            <a href="#" class="hover:text-cyan-600 transition">Painel de Chamada</a>

            <a href="{{ route('funcionarios.perfil') }}"
                class="border border-cyan-500 text-cyan-600 px-4 py-1.5 rounded-full flex items-center space-x-2 bg-cyan-50 transition">
                <i class="fa-regular fa-user"></i>
                <span>Perfil</span>
            </a>

           <form action="{{ route('logout') }}" method="POST" class="flex items-center m-0 p-0">
                @csrf
                <button type="submit"
                    class="bg-cyan-500 text-white px-4 py-1.5 rounded-full flex items-center space-x-2 hover:bg-cyan-600 transition h-[34px] leading-none">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Sair</span>
                </button>
            </form>
        </nav>
    </header>

    <main class="max-w-6xl mx-auto p-6 md:p-10 space-y-6">
        
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Perfil</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
            
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 flex flex-col items-center justify-center text-center">
                <div class="relative w-32 h-32 flex items-center justify-center bg-sky-100 text-cyan-700 rounded-full font-bold text-3xl tracking-wider">
                    @if(isset($funcionario) && $funcionario->foto_perfil)
                        <img src="{{ asset('storage/' . $funcionario->foto_perfil) }}" alt="Foto de perfil" class="w-full h-full object-cover rounded-full">
                    @else
                        {{ isset($funcionario) ? mb_strtoupper(mb_substr($funcionario->nome, 0, 2)) : 'TR' }}
                    @endif
                    
                    <div class="absolute bottom-0 right-0 bg-cyan-500 text-white p-2 rounded-full shadow-md flex items-center justify-center pointer-events-none">
                        <i data-lucide="image" class="w-4 h-4"></i>
                    </div>
                </div>
                </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 md:col-span-2 space-y-6">
                <h2 class="text-xl font-bold text-slate-800 mb-4">Dados cadastrais</h2>

                <div class="space-y-5">
                    
                    <div>
                        <label for="nome" class="block text-sm font-semibold text-slate-700 mb-1.5">Nome completo</label>
                        <input type="text" id="nome" value="{{ $funcionario->nome ?? '' }}" disabled
                            class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-600 text-sm outline-none cursor-not-allowed">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="cpf" class="block text-sm font-semibold text-slate-700 mb-1.5">CPF</label>
                            <input type="text" id="cpf" value="{{ $funcionario->cpf ?? '' }}" disabled
                                class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-600 text-sm outline-none cursor-not-allowed">
                        </div>
                        
                        <div>
                            <label for="telefone" class="block text-sm font-semibold text-slate-700 mb-1.5">Telefone</label>
                            <input type="text" id="telefone" value="{{ $funcionario->contato ?? 'Não informado' }}" disabled
                                class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-600 text-sm outline-none cursor-not-allowed">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">E-mail de contato</label>
                        <input type="email" id="email" value="{{ $funcionario->email ?? '' }}" disabled
                            class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-600 text-sm outline-none cursor-not-allowed">
                    </div>

                    <div>
                        <label for="perfil" class="block text-sm font-semibold text-slate-700 mb-1.5">Cargo / Função</label>
                        <input type="text" id="perfil" value="{{ $funcionario->perfil ?? 'Enfermeiro' }}" disabled
                            class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-600 text-sm outline-none cursor-not-allowed">
                    </div>

                    <div class="border-t border-slate-100 pt-5 flex justify-end">
                        <a href="{{ isset($funcionario) ? route('funcionarios.edit', $funcionario->id) : '#' }}" 
                            class="px-6 py-2.5 bg-cyan-500 text-white font-semibold rounded-full hover:bg-cyan-600 transition text-sm shadow-sm text-center">
                            Editar informações
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tria - Editar Perfil</title>
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

            <a href="#"
                class="bg-cyan-500 text-white px-4 py-1.5 rounded-lg flex items-center space-x-2 hover:bg-cyan-600 transition">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Sair</span>
            </a>
        </nav>
    </header>

    <main class="max-w-6xl mx-auto p-6 md:p-10 space-y-6">
        
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Editar Perfil</h1>
            <p class="text-sm text-cyan-600 font-medium mt-1">Atualize seus dados cadastrais.</p>
        </div>

        <form action="#" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
            @csrf
            @method('PUT')
            
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 flex flex-col items-center justify-center text-center">
                <div class="relative w-32 h-32 flex items-center justify-center bg-sky-100 text-cyan-700 rounded-full font-bold text-3xl tracking-wider">
                    @if(isset($funcionario) && $funcionario->foto_perfil)
                        <img src="{{ asset('storage/' . $funcionario->foto_perfil) }}" alt="Foto de perfil" class="w-full h-full object-cover rounded-full">
                    @else
                        AC
                    @endif
                    
                    <label for="foto_perfil" class="absolute bottom-0 right-0 bg-cyan-500 text-white p-2 rounded-full shadow-md hover:bg-cyan-600 transition cursor-pointer flex items-center justify-center">
                        <i data-lucide="image" class="w-4 h-4"></i>
                    </label>
                    <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*" class="hidden">
                </div>
                
                <div class="mt-6 space-y-1">
                    <label for="foto_perfil" class="text-cyan-600 hover:text-cyan-700 font-semibold text-sm transition cursor-pointer">
                        Alterar foto &middot; Fazer upload
                    </label>
                    <p class="text-slate-400 text-xs">JPG, PNG ou WEBP - até 2 MB</p>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 md:col-span-2 space-y-6">
                <h2 class="text-xl font-bold text-slate-800 mb-4">Dados cadastrais</h2>

                <div class="space-y-5">
                    
                    <div>
                        <label for="nome" class="block text-sm font-semibold text-slate-700 mb-1.5">
                            Nome completo <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nome" name="nome" value="{{ $funcionario->nome ?? '' }}"
                            class="w-full px-3 py-2.5 border border-slate-200 rounded-lg focus:outline-none focus:border-cyan-500 transition text-sm">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="cpf" class="block text-sm font-semibold text-slate-700 mb-1.5">
                                CPF <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="cpf" name="cpf" maxlength="11" value="{{ $funcionario->cpf ?? '' }}" placeholder="Apenas os 11 números"
                                class="w-full px-3 py-2.5 border border-slate-200 rounded-lg focus:outline-none focus:border-cyan-500 transition text-sm">
                        </div>
                        
                        <div>
                            <label for="telefone" class="block text-sm font-semibold text-slate-700 mb-1.5">
                                Telefone <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="telefone" name="telefone" value="{{ $funcionario->telefone ?? '' }}" placeholder="(00) 00000-0000"
                                class="w-full px-3 py-2.5 border border-slate-200 rounded-lg focus:outline-none focus:border-cyan-500 transition text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">
                            E-mail de contato <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ $funcionario->email ?? '' }}"
                            class="w-full px-3 py-2.5 border border-slate-200 rounded-lg focus:outline-none focus:border-cyan-500 transition text-sm">
                    </div>

                    <div>
                        <label for="perfil" class="block text-sm font-semibold text-slate-700 mb-1.5">Cargo / Função</label>
                        <input type="text" id="perfil" name="perfil" value="{{ $funcionario->perfil ?? 'Enfermeiro' }}" readonly
                            class="w-full px-3 py-2.5 bg-sky-50 border border-transparent rounded-lg text-slate-600 font-medium text-sm outline-none cursor-not-allowed">
                        <p class="text-[11px] text-slate-400 mt-1">Sua função só pode ser alterada por um administrador.</p>
                    </div>

                    <div class="border-t border-slate-100 pt-5 flex flex-col sm:flex-row sm:justify-end space-y-2 sm:space-y-0 sm:space-x-3">
                        
                        <a href="{{ route('funcionarios.perfil') }}" 
                            class="px-8 py-2.5 border border-cyan-500 text-cyan-600 font-semibold rounded-full hover:bg-cyan-50 transition text-sm text-center order-2 sm:order-1">
                            Cancelar
                        </a>
                        
                        <button type="submit" 
                            class="px-8 py-2.5 bg-cyan-500 text-white font-semibold rounded-full hover:bg-cyan-600 transition text-sm shadow-sm order-1 sm:order-2">
                            Salvar alterações
                        </button>
                        
                    </div>

                </div>
            </div>

        </form>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
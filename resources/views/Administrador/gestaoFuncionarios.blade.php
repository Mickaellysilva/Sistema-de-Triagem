<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Funcionários - Tria</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#E6F4F8] font-sans antialiased min-h-screen flex flex-col justify-between" x-data="{ mostrarFormulario: false }">

    <div>
        <header class="bg-white shadow-sm border-b border-gray-100 px-8 py-3">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <div class="bg-[#0D749B] text-white p-2 rounded-full w-9 h-9 flex items-center justify-center font-bold text-lg">
                        <i class="fa-solid fa-plus-minus text-sm"></i>
                    </div>
                    <span class="text-xl font-bold text-[#0D749B]">Tria</span>
                </div>
                
                <nav class="flex items-center gap-6">
                    <a href="/triagem" class="text-gray-700 hover:text-gray-900 text-sm font-medium">Triagem</a>
                    <a href="/painel" class="text-gray-700 hover:text-gray-900 text-sm font-medium">Painel de Chamada</a>
                    <a href="/perfil" class="flex items-center gap-1.5 border border-[#00C1DE] text-[#00C1DE] bg-white px-4 py-1.5 rounded-full text-sm font-medium hover:bg-[#00C1DE]/5 transition">
                        <i class="fa-regular fa-user"></i> Perfil
                    </a>
                    <a href="/sair" class="flex items-center gap-1.5 bg-[#00C1DE] text-white px-4 py-1.5 rounded-full text-sm font-medium hover:bg-[#00A9C4] transition shadow-sm">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Sair
                    </a>
                </nav>
            </div>
        </header>

        <main class="max-w-7xl mx-auto w-full p-8">
            <h2 class="text-2xl font-bold text-[#1A2E35] mb-6">Gestão de Funcionários</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                
                <div class="bg-white rounded-3xl p-8 shadow-sm min-h-[500px]">
                    <h3 class="text-xl font-bold text-[#1A2E35] mb-6">Funcionários cadastrados</h3>
                    
                    <div class="space-y-6">
                        @foreach($funcionarios as $funcionario)
                            <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center font-bold text-lg text-gray-700 uppercase">
                                        {{ substr($funcionario->nome, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 text-sm">{{ $funcionario->nome }}</h4>
                                        <p class="text-xs text-gray-400">{{ $funcionario->email }}</p>
                                        {{-- Exibe o CPF --}}
                                        <p class="text-xs text-gray-500 mt-0.5">CPF: {{ $funcionario->cpf ?? 'Não informado' }}</p>
                                        {{-- Exibe o contato correto puxado da tabela --}}
                                        <p class="text-xs text-[#09738A] mt-0.5">
                                            <i class="fa-solid fa-phone text-[10px]"></i> {{ $funcionario->contato ?? 'Sem contato' }}
                                        </p>
                                    </div>
                                </div>
                                
                                {{-- BLOCO DAS AÇÕES (EDITAR E EXCLUIR ALINHADOS) --}}
                                <div class="flex items-center gap-3">
                                    <span class="bg-[#B9EBF2] text-[#09738A] text-xs font-semibold px-4 py-1 rounded-md capitalize mr-2">
                                        {{ $funcionario->perfil ?? 'Funcionário' }}
                                    </span>
                                    
                                    {{-- Botão de Editar (Redireciona para a rota de edição) --}}
                                    <a href="/gestaoFuncionarios/{{ $funcionario->id }}/editar" class="text-[#00C1DE] hover:text-[#00A9C4] transition">
                                        <i class="fa-regular fa-pen-to-square text-lg"></i>
                                    </a>
                                    
                                    {{-- Formulário de Exclusão (Invisível visualmente, ativa no clique) --}}
                                    <form action="/gestaoFuncionarios/{{ $funcionario->id }}" method="POST" onsubmit="return confirm('Tem certeza de que deseja excluir este funcionário?')\" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-[#E05353] hover:text-[#C94242] transition align-middle">
                                            <i class="fa-regular fa-trash-can text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        @if($funcionarios->isEmpty())
                            <p class="text-gray-400 text-sm text-center py-8">Nenhum funcionário cadastrado no momento.</p>
                        @endif
                    </div>
                </div>

                <div>
                    <div x-show="!mostrarFormulario" 
                         @click="mostrarFormulario = true" 
                         class="bg-white rounded-3xl p-6 shadow-sm flex items-center gap-3 cursor-pointer hover:bg-gray-50 transition border border-transparent active:scale-[0.99]">
                        <span class="text-2xl text-[#00C1DE] font-bold">+</span>
                        <h3 class="text-lg font-bold text-[#1A2E35]">Cadastro de funcionário</h3>
                    </div>

                    <div x-show="mostrarFormulario" x-transition 
                         class="bg-white rounded-3xl p-8 shadow-sm border border-[#00C1DE]">
                        
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-[#1A2E35] flex items-center gap-2">
                                <span class="text-[#00C1DE] text-2xl font-light">+</span> Cadastro de funcionário
                            </h3>
                            <button @click="mostrarFormulario = false" class="text-gray-400 hover:text-gray-600 text-sm">Cancelar</button>
                        </div>

                        <form action="/gestaoFuncionarios" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-semibold text-[#1A2E35] mb-1">Nome</label>
                                <input type="text" name="nome" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-[#00C1DE] text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-[#1A2E35] mb-1">E-mail</label>
                                <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-[#00C1DE] text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-[#1A2E35] mb-1">CPF</label>
                                <input type="text" name="cpf" required placeholder="000.000.000-00" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-[#00C1DE] text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-[#1A2E35] mb-1">Senha</label>
                                <input type="password" name="senha" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-[#00C1DE] text-sm">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-[#1A2E35] mb-1">Telefone</label>
                                <input type="text" name="contato" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-[#00C1DE] text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-[#1A2E35] mb-1">Perfil</label>
                                <select name="perfil" required class="w-full px-4 py-2.5 bg-[#B9EBF2]/40 border border-transparent rounded-xl focus:outline-none text-sm text-[#09738A] font-semibold cursor-pointer">
                                    <option value="Recepcionista">Recepcionista</option>
                                    <option value="Médico">Médico</option>
                                    <option value="Enfermeiro">Enfermeiro</option>
                                </select>
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="w-full bg-[#00C1DE] text-white py-2.5 rounded-full font-bold text-sm hover:bg-[#00A9C4] transition shadow-sm">
                                    Cadastrar funcionário
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <footer class="bg-[#DCEBF0] text-[#5C727D] py-3 text-center text-xs">
        Painel Administrator - Sistema Tria &copy; {{ date('Y') }}
    </footer>

</body>
</html>
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
    <title>Tria - Acessar o sistema</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/login.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-[#49c5e3] min-h-screen flex items-center justify-center p-4 sm:p-6 antialiased font-sans">

    <div class="w-full max-w-5xl flex flex-col md:flex-row items-center justify-center gap-8 md:gap-16">

        <div class="flex flex-col items-center justify-center text-center">
            <div class="w-36 h-36 md:w-60 md:h-60 bg-white rounded-full flex items-center justify-center p-4 shadow-md">
                <img src="{{ asset('images/LogoOficial.svg') }}" alt="Logo Tria"
                    class="w-full h-full object-cover rounded-full">
            </div>
            <h1 class="text-white text-4xl md:text-6xl font-light mt-4 tracking-wide text-[#1a5f7a]">
                Tria
            </h1>
        </div>

        <div class="w-full max-w-md bg-white rounded-2xl p-5 md:p-8 shadow-xl">

            <div class="flex items-center gap-3 md:gap-4 mb-6">
                <div
                    class="bg-[#00b4d8] text-white p-3 rounded-xl flex items-center justify-center text-lg md:text-xl shrink-0 w-12 h-12">
                    <i data-lucide="log-in"></i>
                </div>
                <div>
                    <h2 class="text-lg md:text-xl font-bold text-gray-800 leading-tight">Acessar o sistema</h2>
                    <p class="text-xs md:text-sm text-[#00b4d8] mt-0.5">Selecione o tipo de perfil para entrar</p>
                </div>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-5" novalidate>
                @csrf

                <div class="grid grid-cols-2 gap-2.5">
                    <label
                        class="border border-gray-200 rounded-xl p-2.5 flex items-center gap-2 cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-[#00b4d8] has-[:checked]:bg-cyan-50/30">
                        <input type="radio" name="perfil" value="administrador" class="hidden"
                            {{ old('perfil', 'administrador') == 'administrador' ? 'checked' : '' }}>
                        <span class="text-[#00b4d8] bg-cyan-50 p-2 rounded-lg text-xs md:text-sm shrink-0 w-8 h-8 flex items-center justify-center">
                            <i data-lucide="shield-check"></i>
                        </span>
                        <span class="text-xs md:text-sm font-semibold text-gray-700 truncate">Administrador</span>
                    </label>

                    <label
                        class="border border-gray-200 rounded-xl p-2.5 flex items-center gap-2 cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-[#00b4d8] has-[:checked]:bg-cyan-50/30">
                        <input type="radio" name="perfil" value="recepcionista" class="hidden"
                            {{ old('perfil') == 'recepcionista' ? 'checked' : '' }}>
                        <span class="text-[#00b4d8] bg-cyan-50 p-2 rounded-lg text-xs md:text-sm shrink-0 w-8 h-8 flex items-center justify-center">
                            <i data-lucide="clipboard-list"></i>
                        </span>
                        <span class="text-xs md:text-sm font-semibold text-gray-700 truncate">Recepcionista</span>
                    </label>

                    <label
                        class="border border-gray-200 rounded-xl p-2.5 flex items-center gap-2 cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-[#00b4d8] has-[:checked]:bg-cyan-50/30">
                        <input type="radio" name="perfil" value="enfermeiro" class="hidden"
                            {{ old('perfil') == 'enfermeiro' ? 'checked' : '' }}>
                        <span class="text-[#00b4d8] bg-cyan-50 p-2 rounded-lg text-xs md:text-sm shrink-0 w-8 h-8 flex items-center justify-center">
                            <i data-lucide="activity"></i>
                        </span>
                        <span class="text-xs md:text-sm font-semibold text-gray-700 truncate">Enfermeiro</span>
                    </label>

                    <label
                        class="border border-gray-200 rounded-xl p-2.5 flex items-center gap-2 cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-[#00b4d8] has-[:checked]:bg-cyan-50/30">
                        <input type="radio" name="perfil" value="medico" class="hidden"
                            {{ old('perfil') == 'medico' ? 'checked' : '' }}>
                        <span class="text-[#00b4d8] bg-cyan-50 p-2 rounded-lg text-xs md:text-sm shrink-0 w-8 h-8 flex items-center justify-center">
                            <i data-lucide="stethoscope"></i>
                        </span>
                        <span class="text-xs md:text-sm font-semibold text-gray-700 truncate">Médico</span>
                    </label>
                </div>

                <div class="flex flex-col gap-1">
                    <label for="email" class="text-xs md:text-sm font-semibold text-gray-700">E-mail</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 md:py-3 text-sm outline-none focus:border-[#00b4d8] focus:ring-1 focus:ring-[#00b4d8] transition-all @error('email') border-red-400 @enderror @error('login_error') border-red-400 @enderror">

                    <div id="error-email"
                        class="hidden bg-red-50 border border-red-100 text-red-600 text-xs px-3.5 py-2.5 rounded-xl flex items-center gap-2 mt-1.5 font-medium">
                        <i class="fa-solid fa-triangle-exclamation text-sm shrink-0"></i>
                        <span class="error-text"></span>
                    </div>

                    @error('email')
                        <div
                            class="bg-red-50 border border-red-100 text-red-600 text-xs px-3.5 py-2.5 rounded-xl flex items-center gap-2 mt-1.5 font-medium">
                            <i class="fa-solid fa-triangle-exclamation text-sm shrink-0"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror

                    @error('login_error')
                        <div
                            class="bg-red-50 border border-red-100 text-red-600 text-xs px-3.5 py-2.5 rounded-xl flex items-center gap-2 mt-1.5 font-medium">
                            <i class="fa-solid fa-triangle-exclamation text-sm shrink-0"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="password" class="text-xs md:text-sm font-semibold text-gray-700">Senha</label>
                    <input type="password" id="password" name="senha" required
                        class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 md:py-3 text-sm outline-none focus:border-[#00b4d8] focus:ring-1 focus:ring-[#00b4d8] transition-all @error('senha') border-red-400 @enderror">

                    <div id="error-password"
                        class="hidden bg-red-50 border border-red-100 text-red-600 text-xs px-3.5 py-2.5 rounded-xl flex items-center gap-2 mt-1.5 font-medium">
                        <i class="fa-solid fa-triangle-exclamation text-sm shrink-0"></i>
                        <span class="error-text"></span>
                    </div>

                    @error('senha')
                        <div
                            class="bg-red-50 border border-red-100 text-red-600 text-xs px-3.5 py-2.5 rounded-xl flex items-center gap-2 mt-1.5 font-medium">
                            <i class="fa-solid fa-triangle-exclamation text-sm shrink-0"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-[#00b4d8] hover:bg-[#0096b4] text-white text-sm md:text-base font-semibold py-3 rounded-full transition-colors shadow-md shadow-cyan-100 mt-2 active:scale-[0.98]">
                    Entrar
                </button>
            </form>

        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
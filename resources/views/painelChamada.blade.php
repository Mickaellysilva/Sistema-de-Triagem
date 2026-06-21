<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel TV - Chamada Hospitalar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta http-equiv="refresh" content="5">
    <style>
        @keyframes pulse-custom {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .piscar {
            animation: pulse-custom 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>

<body
    class="bg-slate-950 text-slate-100 font-sans min-h-screen p-12 flex flex-col justify-between overflow-hidden select-none">

    <div class="flex justify-between items-center border-b-4 border-slate-900 pb-6">
        <div class="flex items-center space-x-4 text-cyan-500 font-black text-4xl tracking-wider">
            <span class="border-4 border-cyan-500 rounded-2xl px-3 py-1 bg-cyan-950/30">+</span>
            <span>SENHA / CHAMADA</span>
        </div>
        <div class="text-right text-slate-500 font-mono text-3xl font-bold">
            {{ now()->format('H:i:s') }}
        </div>
    </div>

    <div class="flex-grow flex flex-col justify-center items-center my-auto">
        @if ($paciente)
            <div class="w-full text-center space-y-12">
                <p class="text-2xl font-black uppercase tracking-widest text-cyan-500 piscar">
                    ● ATENÇÃO: PRÓXIMO PACIENTE
                </p>

                <h1
                    class="text-8xl font-black text-white tracking-tight uppercase leading-none max-w-6xl mx-auto break-words px-4">
                    {{ $paciente['nome'] }}
                </h1>

                <div class="pt-6">
                    <p class="text-2xl font-bold uppercase tracking-widest text-slate-400 mb-4">DIRIJA-SE PARA:</p>
                    <span
                        class="inline-block bg-gradient-to-r {{ $paciente['classe_cor'] }} text-white font-black text-6xl px-16 py-6 rounded-3xl shadow-2xl tracking-widest border-2 border-white/10">
                        {{ $paciente['destino'] }}
                    </span>
                </div>
            </div>
        @else
            <div class="text-center space-y-4">
                <div class="text-slate-700 text-9xl">
                    ⚠️
                </div>
                <h2 class="text-4xl font-black text-slate-600 uppercase tracking-wider">
                    Aguardando chamada de paciente...
                </h2>
                <p class="text-xl text-slate-500 font-medium">
                    O painel atualizará automaticamente assim que a triagem ou o consultório chamar.
                </p>
            </div>
        @endif
    </div>

    <div class="border-t-4 border-slate-900 pt-6 text-center">
        <p class="text-xl font-bold text-slate-600 tracking-widest uppercase">
            Por favor, preste atenção ao painel e mantenha o silêncio na recepção
        </p>
    </div>

</body>

</html>

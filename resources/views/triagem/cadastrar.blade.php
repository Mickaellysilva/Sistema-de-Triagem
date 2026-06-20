<h2 class="text-xl font-bold text-slate-800 mb-6">
    Triagem{{ $pacienteSelecionado ? ' - ' . $pacienteSelecionado->nome_completo : '' }}
</h2>

<form action="{{ route('triagem.store') }}" method="POST" class="space-y-5">
    @csrf
    <input type="hidden" name="paciente_id" value="{{ $pacienteSelecionado->id ?? '' }}">

    <div>
        <label for="sintomas" class="block text-sm font-semibold text-slate-700 mb-1.5">SINTOMAS / QUEIXA PRINCIPAL</label>
        <textarea id="sintomas" name="sintomas" rows="5" required
            class="w-full px-3 py-2.5 border border-slate-200 rounded-lg focus:outline-none focus:border-cyan-500 transition text-sm resize-none"></textarea>
    </div>

    <div class="grid grid-cols-3 gap-4 w-full">
        <div>
            <label for="pressao" class="block text-sm font-semibold text-slate-700 mb-1.5 text-center">PA</label>
            <input type="text" id="pressao" name="pressao" required
                class="w-full px-3 py-2 text-center border border-slate-200 rounded-lg focus:outline-none focus:border-cyan-500 transition text-sm">
        </div>
        
        <div>
            <label for="fc" class="block text-sm font-semibold text-slate-700 mb-1.5 text-center">FC</label>
            <input type="text" id="fc" name="frequencia_cardiaca" required
                class="w-full px-3 py-2 text-center border border-slate-200 rounded-lg focus:outline-none focus:border-cyan-500 transition text-sm">
        </div>

        <div>
            <label for="temp" class="block text-sm font-semibold text-slate-700 mb-1.5 text-center">T°</label>
            <input type="text" id="temp" name="temperatura" required
                class="w-full px-3 py-2 text-center border border-slate-200 rounded-lg focus:outline-none focus:border-cyan-500 transition text-sm">
        </div>
    </div>

    <div class="space-y-3">
        <label class="block text-sm font-semibold text-slate-700">NÍVEL DE URGÊNCIA</label>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <label class="flex items-center justify-between p-3 border border-slate-200 rounded-lg bg-white cursor-pointer hover:bg-slate-50 transition">
                <div class="flex items-center space-x-2 text-sm font-medium text-slate-700">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-600"></span>
                    <span>Emergência</span>
                </div>
                <input type="radio" name="classificacao" value="emergencia" required class="w-4 h-4 text-cyan-500 focus:ring-0 border-slate-300">
            </label>

            <label class="flex items-center justify-between p-3 border border-slate-200 rounded-lg bg-white cursor-pointer hover:bg-slate-50 transition">
                <div class="flex items-center space-x-2 text-sm font-medium text-slate-700">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                    <span>Muito urgente</span>
                </div>
                <input type="radio" name="classificacao" value="muito_urgente" class="w-4 h-4 text-cyan-500 focus:ring-0 border-slate-300">
            </label>

            <label class="flex items-center justify-between p-3 border border-slate-200 rounded-lg bg-white cursor-pointer hover:bg-slate-50 transition">
                <div class="flex items-center space-x-2 text-sm font-medium text-slate-700">
                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-600"></span>
                    <span>Urgente</span>
                </div>
                <input type="radio" name="classificacao" value="urgente" class="w-4 h-4 text-cyan-500 focus:ring-0 border-slate-300">
            </label>

            <label class="flex items-center justify-between p-3 border border-slate-200 rounded-lg bg-white cursor-pointer hover:bg-slate-50 transition">
                <div class="flex items-center space-x-2 text-sm font-medium text-slate-700">
                    <span class="w-2.5 h-2.5 rounded-full bg-cyan-400"></span>
                    <span>Pouco urgente</span>
                </div>
                <input type="radio" name="classificacao" value="pouco_urgente" class="w-4 h-4 text-cyan-500 focus:ring-0 border-slate-300">
            </label>

            <label class="flex items-center justify-between p-3 border border-slate-200 rounded-lg bg-white cursor-pointer hover:bg-slate-50 transition">
                <div class="flex items-center space-x-2 text-sm font-medium text-slate-700">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                    <span>Não urgente</span>
                </div>
                <input type="radio" name="classificacao" value="nao_urgente" class="w-4 h-4 text-cyan-500 focus:ring-0 border-slate-300">
            </label>
        </div>
    </div>

    <div class="pt-4 flex justify-center">
        <button type="submit" 
            class="w-full max-w-xs py-2.5 bg-cyan-500 text-white font-semibold rounded-full hover:bg-cyan-600 transition text-sm shadow-sm text-center cursor-pointer">
            Concluir triagem
        </button>
    </div>
</form>
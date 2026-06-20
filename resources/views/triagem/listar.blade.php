<h2 class="text-xl font-bold text-slate-800 mb-4">Pacientes para triar</h2>

<div class="space-y-1">
    @if(count($pacientes) > 0)
        @foreach($pacientes as $index => $paciente)
            @php
                $is_selected = isset($pacienteSelecionado) && $pacienteSelecionado->id == $paciente->id;
            @endphp
            
            <a href="{{ route('triagem.index', ['paciente_id' => $paciente->id]) }}" 
               class="flex items-center justify-between p-4 rounded-xl transition
               {{ $is_selected ? 'bg-cyan-100/70' : 'bg-white hover:bg-slate-50' }}">
                
                <div class="flex items-center space-x-4">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-sm bg-sky-100 text-cyan-700">
                        {{ $index + 1 }}
                    </div>
                    
                    <div>
                    @if($is_selected)
                        <p class="font-bold text-slate-800 text-sm">{{ $paciente->nome_completo }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">P-00{{ $paciente->id }} &middot; 51 anos &middot; desde 08:30</p>
                    @else
                        <p class="font-bold text-slate-800 text-sm">{{ $paciente->nome_completo }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">P-00{{ $paciente->id }} &middot; 51 anos &middot; desde 08:30</p>
                    @endif
                </div>
                </div>

                <div class="flex items-center space-x-3 text-cyan-500">
                    <span class="hover:text-cyan-600 transition">
                        <i class="fa-solid fa-volume-high text-sm"></i>
                    </span>
                    <span class="text-red-500 hover:text-red-600 transition">
                        <i class="fa-regular fa-circle-xmark text-base"></i>
                    </span>
                </div>
            </a>
            
            @if(!$is_selected && !$loop->last)
                <div class="border-t border-slate-100 my-1"></div>
            @endif
        @endforeach
    @else
        <p class="text-sm text-slate-400 text-center py-4">Nenhum paciente aguardando.</p>
    @endif
</div>

<div class="mt-4">
    {{ $pacientes->appends(request()->query())->links() }}
</div>
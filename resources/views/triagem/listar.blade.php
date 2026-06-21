<div class="space-y-3">
    @forelse($fila as $key => $item)
        @php
            $is_atual = $key === 0;
        @endphp

        <div
            class="flex items-center justify-between p-3 rounded-xl border {{ $is_atual ? 'bg-cyan-50/80 border-cyan-300 ring-1 ring-cyan-300' : 'border-slate-100 bg-white' }}">
            <div class="flex items-center space-x-3">
                <span
                    class="bg-cyan-100 text-cyan-700 font-bold w-6 h-6 flex items-center justify-center rounded text-xs">
                    {{ $key + 1 }}
                </span>
                <div>
                    <h4 class="text-xs font-semibold text-slate-700">
                        {{ $item->paciente->nome_completo }}
                        @if ($is_atual && $item->status === 'em_triagem')
                            <span
                                class="text-[10px] text-cyan-600 font-bold ml-1 border border-cyan-400 px-1 rounded-md bg-white">
                                Em Triagem
                            </span>
                        @endif
                    </h4>
                    <p class="text-[10px] text-slate-400 mt-0.5">
                        CPF: {{ $item->paciente->cpf ?? 'Não informado' }} &bull; desde
                        {{ $item->created_at->format('H:i') }}
                    </p>
                </div>
            </div>

            <div class="flex items-center space-x-2 text-slate-400 text-xs">
                @if ($is_atual && $item->status === 'aguardando')
                    <form action="{{ route('triagem.chamar', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-cyan-500 hover:text-cyan-600 transition p-1"
                            title="Chamar paciente no Painel">
                            <i class="fa-solid fa-volume-high text-sm"></i>
                        </button>
                    </form>
                @else
                    <i class="fa-solid fa-volume-high opacity-30"></i>
                @endif
            </div>
        </div>
    @empty
        <p class="text-xs text-slate-400 italic text-center py-4">Nenhum paciente na fila de triagem.</p>
    @endforelse
</div>

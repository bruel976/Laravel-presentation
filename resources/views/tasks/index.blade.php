@extends('layouts.app')

@section('title', 'Mes tâches')

@section('content')
    @php
        $total = $tasks->count();
        $done = $tasks->where('is_done', true)->count();
        $remaining = $total - $done;
        $percent = $total > 0 ? (int) round($done / $total * 100) : 0;
    @endphp

    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Mes tâches</h1>
            <p class="mt-1 text-gray-500">{{ $remaining }} tâche(s) restante(s) sur {{ $total }}</p>
        </div>
        @if ($total > 0)
            <span class="rounded-full bg-indigo-50 px-3 py-1 text-sm font-medium text-indigo-600">
                {{ $percent }}% terminées
            </span>
        @endif
    </div>

    @if ($total > 0)
        <div class="mb-8 h-2 overflow-hidden rounded-full bg-gray-100">
            <div class="h-full rounded-full bg-indigo-500 transition-all" style="width: {{ $percent }}%"></div>
        </div>
    @endif

    <form method="POST" action="{{ route('tasks.store') }}" class="mb-6 flex flex-col gap-2 sm:flex-row">
        @csrf
        <input type="text" name="title" value="{{ old('title') }}" required placeholder="Ajouter une tâche…"
               class="flex-1 rounded-xl border px-4 py-2.5 shadow-sm transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 {{ $errors->has('title') ? 'border-red-400' : 'border-gray-300' }}">
        <button type="submit"
                class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-indigo-500">
            Ajouter
        </button>
    </form>
    @error('title')
        <p class="-mt-4 mb-6 text-sm text-red-600">{{ $message }}</p>
    @enderror

    @if ($tasks->isEmpty())
        <div class="rounded-2xl border-2 border-dashed border-gray-200 bg-white py-16 text-center">
            <p class="text-gray-400">Aucune tâche. Ajoutez-en une ci-dessus.</p>
        </div>
    @else
        <ul class="divide-y divide-gray-100 overflow-hidden rounded-2xl border border-gray-200 bg-white">
            @foreach ($tasks->sortBy('is_done') as $task)
                <li class="flex items-center gap-3 px-4 py-3">
                    <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                class="flex h-6 w-6 items-center justify-center rounded-full border-2 transition {{ $task->is_done ? 'border-emerald-500 bg-emerald-500 text-white' : 'border-gray-300 hover:border-emerald-400' }}"
                                title="{{ $task->is_done ? 'Marquer comme à faire' : 'Marquer comme terminée' }}">
                            @if ($task->is_done)
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            @endif
                        </button>
                    </form>

                    <span class="flex-1 {{ $task->is_done ? 'text-gray-400 line-through' : '' }}">
                        {{ $task->title }}
                    </span>

                    <a href="{{ route('tasks.edit', $task) }}" class="text-gray-300 transition hover:text-indigo-500" title="Modifier">
                        <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </a>

                    <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                          onsubmit="return confirm('Supprimer cette tâche ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-300 transition hover:text-red-500" title="Supprimer">
                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
@endsection

@extends('layouts.app')

@section('title', 'Nouvelle tâche')

@section('content')
    <div class="mx-auto max-w-lg">
        <a href="{{ route('tasks.index') }}" class="text-sm text-indigo-600 hover:underline">← Retour à la liste</a>

        <h1 class="mt-2 text-2xl font-semibold tracking-tight">Nouvelle tâche</h1>

        <form method="POST" action="{{ route('tasks.store') }}"
              class="mt-6 space-y-5 rounded-2xl border border-gray-200 bg-white p-6">
            @csrf
            @include('tasks._form')

            <div class="flex items-center gap-3 pt-1">
                <button type="submit"
                        class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-indigo-500">
                    Créer la tâche
                </button>
                <a href="{{ route('tasks.index') }}" class="text-sm text-gray-500 hover:text-gray-700">
                    Annuler
                </a>
            </div>
        </form>
    </div>
@endsection

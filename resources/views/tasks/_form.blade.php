<div>
    <label for="title" class="mb-1 block text-sm font-medium text-gray-700">Titre de la tâche</label>
    <input type="text" name="title" id="title" value="{{ old('title', $task->title ?? '') }}" required autofocus
           class="w-full rounded-xl border px-4 py-2.5 shadow-sm transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 {{ $errors->has('title') ? 'border-red-400' : 'border-gray-300' }}">
    @error('title')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<label class="flex items-center gap-2.5">
    <input type="hidden" name="is_done" value="0">
    <input type="checkbox" name="is_done" value="1" @checked(old('is_done', $task->is_done ?? false))
           class="h-5 w-5 accent-indigo-600">
    <span class="text-sm text-gray-700">Marquer comme terminée</span>
</label>

<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Modifier le commentaire</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('comments.update', $comment->id) }}" method="POST"
            class="p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')
            <!-- Champ de texte pour le commentaire -->
            <div class="mb-4">
                <x-textarea label="Commentaire" name="content" :value="old('content', $comment->content)" required />
            </div>

            <!-- Bouton de soumission -->
            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
            </div>
        </form>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Modifier l'article</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire de modification -->
        <form action="{{ route('articles.update', $article->id) }}" method="POST" class="p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <!-- Champ Titre -->
            <div class="mb-4">
                <x-text label="Titre" type="text" name="title" id="title" class="w-full p-2 border rounded"
                    value="{{ old('title', $article->title) }}" required />
            </div>

            <!-- Champ Contenu -->
            <div class="m-4 h-[50vh]">
                <x-textarea label="Contenu" name="content" id="content" class="w-full p-2 border rounded"
                    value="{{ old('content', $article->content) }}" required />
            </div>

            <!-- Bouton de soumission -->
            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
            </div>
        </form>
    </div>
</x-app-layout>


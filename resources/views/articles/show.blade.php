<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="mb-6 flex items-center space-x-4">
            <a href="{{ route('articles.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                Retour à la liste
            </a>

            @can('update', $article)
                <a href="{{ route('articles.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                    Modifier
                </a>
            @endcan

            @can('delete', $article)
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                        Supprimer
                    </button>
                </form>
            @endcan
        </div>

        <h1 class="text-3xl font-bold mb-4">{{ $article->title }}</h1>

        <p class="text-sm text-gray-500 mb-4">
            Publié par <span class="font-semibold">{{ $article->user->name }}</span> le
            {{ $article->created_at->format('d/m/Y à H:i') }}
        </p>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <p class="text-gray-800 leading-relaxed">
                {{ $article->content }}
            </p>
        </div>

        <!-- Section des commentaires -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Commentaires</h2>

            @forelse ($article->comments as $comment)
                <div class="flex justify-between items-center mb-4 p-4 bg-gray-100 rounded-lg">
                    <div class="">
                        <p class="text-gray-800">{{ $comment->content }}</p>
                        <p class="text-sm text-gray-500">Par {{ $comment->user->name ?? 'Utilisateur' }},
                            le {{ $comment->created_at->format('d/m/Y à H:i') }}</p>
                    </div>

                    <!-- Actions pour modifier/supprimer le commentaire -->
                    <div class="flex items-center space-x-4 mt-2">
                        @can('update', $comment)
                            <a href="{{ route('comments.edit', $comment->id) }}"
                                class="text-yellow-500 hover:text-yellow-700">
                                <x-heroicon-o-pencil class="w-5 h-5 inline" /> Modifier
                            </a>
                        @endcan

                        @can('delete', $comment)
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <x-heroicon-o-trash class="w-5 h-5 inline" /> Supprimer
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            @empty
                <p class="text-gray-600">Aucun commentaire pour le moment.</p>
            @endforelse
        </div>

        <!-- Formulaire pour ajouter un commentaire -->
        @can('create', App\Models\Comment::class)
            <div class="mt-6">
                <form action="{{ route('articles.comments.store', $article->id) }}" method="POST">
                    @csrf
                    <x-textarea label="Commentez :" name="content" required />
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Publier le commentaire</button>
                </form>
            </div>
        @endcan
    </div>
</x-app-layout>

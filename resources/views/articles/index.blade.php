<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Liste des articles</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @can('create', App\Models\Article::class)
            <a href="{{ route('articles.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-6 inline-block">Créer
                un nouvel article</a>
        @endcan

        @if ($articles->isEmpty())
            <p class="text-stone-600">Aucun article pour le moment.</p>
        @else
            <div class="flex flex-col gap-6">
                @foreach ($articles as $article)
                    <div
                        class="flex justify-between items-center bg-white dark:bg-stone-800 rounded-lg shadow-lg hover:bg-stone-100  dark:hover:bg-stone-700 dark:focus-visible:bg-stone-700 hover:scale-[1.02] active:scale-100 focus-visible:scale-[1.02] transition duration-200">
                        <!-- Section principale cliquable de la carte -->
                        <a href="{{ route('articles.show', $article->id) }}" class="flex-1 p-6">
                            <h2 class="text-xl font-bold mb-2">{{ $article->title }}</h2>
                            <p class="text-stone-700 dark:text-stone-300 mb-4">{{ Str::limit($article->content, 100) }}
                            </p>
                            <p class="text-sm text-stone-500 dark:text-stone-400">Par {{ $article->user->name }} -
                                {{ $article->created_at->format('d/m/Y') }}</p>
                            <p class="mt-4 text-sm text-stone-500 dark:text-stone-200">{{ $article->comments->count() }}
                                commentaire(s)</p>
                        </a>

                        <!-- Icônes pour modifier/supprimer en dehors du lien principal -->
                        <div class="flex items-center space-x-4 mr-4">
                            @can('update', $article)
                                <a href="{{ route('articles.edit', $article->id) }}"
                                    class="flex gap-1 items-center text-yellow-500 hover:text-yellow-700">
                                    <x-heroicon-o-pencil class="w-5 h-5" /> Modifier
                                </a>
                            @endcan

                            @can('delete', $article)
                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex gap-1 items-center text-red-500 hover:text-red-700">
                                        <x-heroicon-o-trash class="w-5 h-5" /> Supprimer
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>

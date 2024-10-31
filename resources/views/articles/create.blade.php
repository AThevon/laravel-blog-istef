<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Créer un nouvel article</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <a href="{{ route('articles.index') }}" class="mb-4 px-10 inline-block bg-stone-800 text-white rounded p-2">Retour</a>

        <form action="{{ route('articles.store') }}" method="POST" class="p-6 rounded-lg shadow-md">
            @csrf

            <x-text label="Titre de l'article" name="title" required />

            <div class="m-4 h-[50vh]">
                <x-textarea label="Contenu" name="content" required />
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="px-10 bg-blue-500 text-white py-2 rounded">Publier</button>
            </div>
        </form>
    </div>
</x-app-layout>

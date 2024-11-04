<x-app-layout>
    <div class="p-12">

        <h2 class="text-3xl font-bold mb-4">Bienvenue sur Skyblog</h2>
        <p class="mb-8">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
        
        @auth
        <form action="{{ route('send.user.stats') }}" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Recevoir mes statistiques</button>
        </form>
        @endauth
        
        @if (session('status'))
        <p class="mt-4 text-green-500">{{ session('status') }}</p>
        @endif
    </div>
</x-app-layout>

<x-base title="{{ config('app.name') }}">
    <div class="flex flex-wrap mt-0">
        <div class="w-full md:w-9/12">
            {{-- Début du post --}}
            @foreach ($posts as $post)
                <x-post :post="$post" list />
            @endforeach
            {{-- Fin du post --}}
            <div class="container mt-2">
                <span class="mt-2 mb-2">{{ $posts->links() }}</span>
            </div>
        </div>
        <div class="w-full md:w-3/12"></div>
    </div>
</x-base>

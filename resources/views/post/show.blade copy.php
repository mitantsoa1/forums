@props(['post', 'list' => false])
<x-base title="{{ $post->topic->slug }} | {{ $post->slug }}">
    <div class="flex flex-wrap mt-0">
        <div class="w-full md:w-12/12">
            {{-- Début du post --}}
            <x-post :post="$post" />
            {{-- Fin du post --}}
            <div class="comment">
                @if ($post->comments->isEmpty())
                    <p>No comments yet.</p>
                @else
                    <span class=" text-red-500">{{ count($post->comments) }} @if (count($post->comments) > 1)
                            Answers
                        @else
                            Answer
                        @endif </span>
                    {{-- @foreach ($post->comments as $comment) --}}
                    @foreach ($comments as $comment)
                        <div>
                            <p class="text-sm italic"><strong>{{ $comment->user->name }}</strong> </p>
                            <p class="ml-3 leading-normal">{{ $comment->content }}</p>
                            <time class="text-xs text-slate-500 italic"
                                datetime="{{ $comment->created_at }}">{{ $comment->created_at->format('Y-m-d H:i') }}</time>
                        </div>
                        <div class="flex flex-col items-end">
                            <p class="text-sm italic mr-4"><strong>{{ $comment->user->name }}</strong></p>
                            <p class="">{{ $comment->content }}</p>
                            <time class="text-xs text-slate-500 italic"
                                datetime="{{ $comment->created_at }}">{{ $comment->created_at->format('Y-m-d H:i') }}</time>
                        </div>
                    @endforeach
                    <!-- Lien de pagination -->
                    <div class="pagination">
                        {{ $comments->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-base>

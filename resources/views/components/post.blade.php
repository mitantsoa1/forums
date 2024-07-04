@props(['post', 'list' => false])

<article
    class="flex flex-col lg:flex-row bg-white mt-0 pr-2 items-stretch border-b @if ($list) border-r @endif">
    <div class="bg-white md:w-20 italic text-sm">{{ $post->user->name }}</div>
    <div class="flex flex-col items-start my-3 space-y-2 lg:w-12/12 lg:mt-0 lg:ml-12">
        <a href="{{ route('posts.showByTopic', ['topic' => $post->topic->slug]) }}" class="mt-2"><span
                class="border text-indigo-600 font-semibold hover:bg-indigo-100 px-2 py-0.5 rounded-md  ">{{ $post->topic->title }}</span></a>
        <a href="{{ route('posts.show', ['post' => $post]) }}">
            <h5 class="italic underline text-slate-900 text-lg leading-tight">
                {{ $post->title }}
            </h5>
        </a>

        <p class="text-md lg:text-md text-slate-700">
            @if ($list)
                <a href="{{ route('posts.show', ['post' => $post]) }}">
                    {{ $post->excerpt }}
                </a>
            @else
                {!! nl2br(e($post->content)) !!}
            @endif
        </p>
        <div class="flex justify-between items-center w-full">

            @if ($list)
                <a href="{{ route('posts.show', ['post' => $post]) }}">
                    <span class="text-xs text-slate-500">
                        {{ $post->comments_count }}{{ $post->comments_count > 1 ? ' comments' : ' comment' }}</span></a>
            @else
                <span class="text-xs text-slate-500">&nbsp;</span>
            @endif

            <time class="text-sm text-slate-400 "
                datetime="{{ $post->created_at }}">{{ $post->created_at->format('Y-m-d H:i') }}</time>
        </div>
        {{-- @endif --}}
    </div>
</article>

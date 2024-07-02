@props(['post', 'list' => false])

<article
    class="flex flex-col lg:flex-row bg-white mt-0 pr-2 items-stretch @if ($list) border-b border-r @else border-b @endif">
    <div class="bg-white md:w-20">{{ $post->user->name }}</div>
    <div class="flex flex-col items-start my-3 space-y-2 lg:w-12/12 lg:mt-0 lg:ml-12">
        <span
            class="border text-indigo-600 font-semibold hover:bg-indigo-100 hover:cursor-pointer px-2 py-0.5 rounded-md  mt-2">{{ $post->topic->title }}</span>
        <a href="{{ route('posts.show', ['post' => $post]) }}">
            <h5 class="font-bold text-slate-900 text-2xl leading-tight">
                {{ $post->title }}
            </h5>
        </a>

        <p class="text-md lg:text-md text-slate-600">
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

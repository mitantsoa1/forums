@props(['post', 'list' => false])
<x-base title="{{ $post->topic->slug }} | {{ $post->slug }}">
    <div class="flex flex-wrap mt-0">
        <div class="w-full md:w-12/12">
            @dd($comments)
            {{-- Début du post --}}
            <x-post :post="$post" />
            {{-- Fin du post --}}
            {{-- formlaire de commentaire --}}

            @auth
                <form action="{{ route('posts.comment', ['post' => $post]) }}" method="post" class="mt-2 mb-3">
                    @csrf
                    <div class="flex h-12">
                        <input
                            class="w-full bg-slate-50 rounded-lg px-5 text-slate-900 focus:outline focus:outline-1 focus:outline-indigo-500"
                            type="text" name="comment" placeholder="Your comment 🎉" autocomplete="off" required>
                        <button
                            class="ml-2 w-12 flex justify-center items-center shrink-0 bg-indigo-700 rounded-full text-indigo-50">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                            </svg>
                        </button>
                    </div>
                </form>
            @endauth
            {{-- fin formlaire de commentaire --}}
            <div class="comment mb-5" id="comments-container">
                @if ($post->comments->isEmpty())
                    <p>No comments yet.</p>
                    <button id="show-more" data-offset="2"
                        class="bg-blue-500 text-white py-2 mb-8 px-4 rounded hidden">Show
                        More</button>
                @else
                    <span class=" text-red-500">{{ count($post->comments) }} @if (count($post->comments) > 1)
                            Answers
                        @else
                            Answer
                        @endif </span>
                    {{-- @foreach ($post->comments as $comment) --}}
                    @foreach ($comments as $comment)
                        @auth
                            @php
                                $commentUser = $comment->user->id == Auth::user()->id ? 1 : 0;
                            @endphp
                        @endauth
                        @guest
                            @php
                                $commentUser = 0;
                            @endphp
                        @endguest

                        <div @class([
                            'mt-6' => !$commentUser,
                            'mt-6 flex flex-col items-end' => $commentUser,
                        ])>
                            <p @class([
                                'text-sm italic underline' => !$commentUser,
                                'text-sm italic mr-4' => $commentUser,
                            ])><strong>{{ $comment->user->name }}</strong> </p>
                            <p @class([
                                'ml-3 leading-normal' => !$commentUser,
                                '' => $commentUser,
                            ])>{{ $comment->content }}</p>
                            <time class="text-xs text-slate-500 italic"
                                datetime="{{ $comment->created_at }}">{{ $comment->created_at->format('Y-m-d H:i') }}</time>
                            <div @class([
                                'comment-response flex w-full space-x-2 text-sm',
                                'items-center' => !$commentUser,
                                'justify-end' => $commentUser,
                            ])>
                                <span
                                    class="text-indigo-500 flex items-center space-x-1 px-2 cursor-pointer btn-jm">{{ $comment->reactionsCount->first()->total_jm ?? 0 }}&nbsp;<svg
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6">
                                        <path
                                            d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                                    </svg></span>
                                <span
                                    class="flex text-red-500 items-center space-x-1 px-2 cursor-pointer btn-jmp">{{ $comment->reactionsCount->first()->total_jmp ?? 0 }}&nbsp;<svg
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6">
                                        <path
                                            d="M15.73 5.5h1.035A7.465 7.465 0 0 1 18 9.625a7.465 7.465 0 0 1-1.235 4.125h-.148c-.806 0-1.534.446-2.031 1.08a9.04 9.04 0 0 1-2.861 2.4c-.723.384-1.35.956-1.653 1.715a4.499 4.499 0 0 0-.322 1.672v.633A.75.75 0 0 1 9 22a2.25 2.25 0 0 1-2.25-2.25c0-1.152.26-2.243.723-3.218.266-.558-.107-1.282-.725-1.282H3.622c-1.026 0-1.945-.694-2.054-1.715A12.137 12.137 0 0 1 1.5 12.25c0-2.848.992-5.464 2.649-7.521C4.537 4.247 5.136 4 5.754 4H9.77a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23ZM21.669 14.023c.536-1.362.831-2.845.831-4.398 0-1.22-.182-2.398-.52-3.507-.26-.85-1.084-1.368-1.973-1.368H19.1c-.445 0-.72.498-.523.898.591 1.2.924 2.55.924 3.977a8.958 8.958 0 0 1-1.302 4.666c-.245.403.028.959.5.959h1.053c.832 0 1.612-.453 1.918-1.227Z" />
                                    </svg></span>
                                <span class=" text-sm text-slate-500 cursor-pointer btn-response"> Répondre </span>

                            </div>
                        </div>

                        {{-- <div class="mt-6">
                            <p class="text-sm italic underline"><strong>{{ $comment->user->name }}</strong> </p>
                            <p class="ml-3 leading-normal">{{ $comment->content }}</p>
                            <time class="text-xs text-slate-500 italic"
                                datetime="{{ $comment->created_at }}">{{ $comment->created_at->format('Y-m-d H:i') }}</time>
                        </div> --}}


                        {{-- <div class="flex flex-col items-end">
                            <p class="text-sm italic mr-4"><strong>{{ $comment->user->name }}</strong></p>
                            <p class="">{{ $comment->content }}</p>
                            <time class="text-xs text-slate-500 italic"
                                datetime="{{ $comment->created_at }}">{{ $comment->created_at->format('Y-m-d H:i') }}</time>
                        </div> --}}
                    @endforeach
                    <div id="comments-load"></div>
                    <div class="flex items-center justify-center mb-4">
                        <div class="border-t border-gray-300 flex-grow mr-2"></div>
                        <span id="show-more" data-offset="5" class="px-3 py-2  text-gray-500 hover:cursor-pointer">show
                            more</span>
                        <div class="border-t border-gray-300 flex-grow ml-2"></div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {


            document.getElementById('show-more').addEventListener('click', function() {
                    let button = this;
                    let offset = button.getAttribute('data-offset');
                    let postId = {{ $post->id }};

                    fetch(`/questions/${postId}/comment?offset=${offset}`)
                        .then(response => response.json())
                        .then(data => {
                                if (data.length > 0) {

                                    let commentsContainer = document.getElementById('comments-load');
                                    data.forEach(comment => {

                                            let commentUser = 0;
                                            @auth
                                            commentUser = (comment.user.id == {{ Auth::user()->id }}) ?
                                                1 : 0;
                                        @endauth


                                        let totalJM = comment.reactions_count[0].total_jm <= 0 ? 0 :
                                            comment.reactions_count[0].total_jm;
                                        let totalJMP = comment.reactions_count[0].total_jmp <= 0 ? 0 :
                                            comment.reactions_count[0].total_jmp;

                                        /*******************  Create the response div  ******************/
                                        let responseDiv = document.createElement('div'); responseDiv
                                        .classList.add('comment-response', 'flex', 'w-full',
                                            'space-x-2',
                                            'text-sm');

                                        if (commentUser) {
                                            responseDiv.classList.add('justify-end');
                                        } else {
                                            responseDiv.classList.add('items-center');
                                        }
                                        responseDiv.innerHTML = `
                                        <span class="text-indigo-500 flex items-center space-x-1 px-2 cursor-pointer btn-jm" >${totalJMP}&nbsp;
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                <path d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                                            </svg>
                                        </span>
                                        <span class="flex text-red-500 items-center space-x-1 px-2 cursor-pointer btn-jmp" >${totalJMP}&nbsp;
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                <path d="M15.73 5.5h1.035A7.465 7.465 0 0 1 18 9.625a7.465 7.465 0 0 1-1.235 4.125h-.148c-.806 0-1.534.446-2.031 1.08a9.04 9.04 0 0 1-2.861 2.4c-.723.384-1.35.956-1.653 1.715a4.499 4.499 0 0 0-.322 1.672v.633A.75.75 0 0 1 9 22a2.25 2.25 0 0 1-2.25-2.25c0-1.152.26-2.243.723-3.218.266-.558-.107-1.282-.725-1.282H3.622c-1.026 0-1.945-.694-2.054-1.715A12.137 12.137 0 0 1 1.5 12.25c0-2.848.992-5.464 2.649-7.521C4.537 4.247 5.136 4 5.754 4H9.77a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23ZM21.669 14.023c.536-1.362.831-2.845.831-4.398 0-1.22-.182-2.398-.52-3.507-.26-.85-1.084-1.368-1.973-1.368H19.1c-.445 0-.72.498-.523.898.591 1.2.924 2.55.924 3.977a8.958 8.958 0 0 1-1.302 4.666c-.245.403.028.959.5.959h1.053c.832 0 1.612-.453 1.918-1.227Z" />
                                            </svg>
                                        </span>
                                        <span class=" text-sm text-slate-500 cursor-pointer btn-response" > Répondre </span>
                                    `;
                                        /*******************  Create the comment div  ******************/
                                        let commentDiv = document.createElement('div'); commentDiv.classList
                                        .add('mt-6');

                                        let createdAt = new Date(comment.created_at);
                                        let formattedDate = createdAt.getFullYear() + '-' +
                                            ('0' + (createdAt.getMonth() + 1)).slice(-2) + '-' +
                                            ('0' + createdAt.getDate()).slice(-2) + ' ' +
                                            ('0' + createdAt.getHours()).slice(-2) + ':' +
                                            ('0' + createdAt.getMinutes()).slice(-2);


                                        commentDiv.innerHTML =
                                        `<p class="text-sm italic underline"><strong>${comment.user.name}</strong> </p>
                                    <p class="ml-3 leading-normal">${comment.content}</p>
                                    <time class="text-xs text-slate-500 italic"
                                        datetime="${comment.created_at}">${formattedDate}</time>`

                                        commentsContainer.appendChild(commentDiv); commentsContainer
                                        .appendChild(responseDiv);
                                    });
                                if (data.length < offset) {
                                    button.disabled = true;
                                    button.innerText = 'No more';
                                }
                                button.setAttribute('data-offset', parseInt(offset) + data.length);
                            } else {
                                button.disabled = true;
                                button.innerText = 'No more';
                            }
                        });
            });

        /****** J'aime *******/

        let buttons = document.getElementsByClassName('btn-jm');

        Array.from(buttons).forEach(button => {
            button.addEventListener('click', function() {
                let button_react = this;
                let postId = {{ $post->id }};

                fetch(`/questions/${postId}/react?react=jm`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            // Handle the response data
                        }
                    });

            });
        });


        });
    </script>
</x-base>

@props(['post', 'list' => false])
<x-base title="{{ $post->topic->slug }} | {{ $post->slug }}">
    <div class="flex flex-wrap mt-0">
        <div class="w-full md:w-12/12">
            {{-- Début du post --}}
            <x-post :post="$post" />
            {{-- Fin du post --}}
            <div class="comment" id="comments-container">
                @if ($post->comments->isEmpty())
                    <p>No comments yet.</p>
                    <button id="show-more" data-offset="2" class="bg-blue-500 text-white py-2 px-4 rounded hidden">Show
                        More</button>
                @else
                    <span class=" text-red-500">{{ count($post->comments) }} @if (count($post->comments) > 1)
                            Answers
                        @else
                            Answer
                        @endif </span>
                    {{-- @foreach ($post->comments as $comment) --}}
                    @foreach ($comments as $comment)
                        <div class="mt-6">
                            <p class="text-sm italic underline"><strong>{{ $comment->user->name }}</strong> </p>
                            <p class="ml-3 leading-normal">{{ $comment->content }}</p>
                            <time class="text-xs text-slate-500 italic"
                                datetime="{{ $comment->created_at }}">{{ $comment->created_at->format('Y-m-d H:i') }}</time>
                        </div>
                        {{-- <div class="flex flex-col items-end">
                            <p class="text-sm italic mr-4"><strong>{{ $comment->user->name }}</strong></p>
                            <p class="">{{ $comment->content }}</p>
                            <time class="text-xs text-slate-500 italic"
                                datetime="{{ $comment->created_at }}">{{ $comment->created_at->format('Y-m-d H:i') }}</time>
                        </div> --}}
                    @endforeach
                    <div id="comments-load"></div>
                    <button id="show-more" data-offset="5" class="mt-2 bg-blue-500 text-white py-1 px-2 rounded">Show
                        More</button>
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
                                let commentDiv = document.createElement('div');
                                commentDiv.classList.add('mt-6');

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


                                commentsContainer.appendChild(commentDiv);
                            });
                            if (data.length < 3) {
                                button.disabled = true;
                                button.innerText = 'No more comments';
                            }
                            button.setAttribute('data-offset', parseInt(offset) + data.length);
                        } else {
                            button.disabled = true;
                            button.innerText = 'No more comments';
                        }
                    });
            });
        });
    </script>
</x-base>

<div>
    @foreach ($posts as $post)
        @can('view', $post)    
        <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 mb-4">
            <article class="mb-2 flex justify-between">
                <div>
                    <p>{{$post->text}}</p>
                    <div>
                        {{$post->user->name}} Created at: {{$post->updated_at}}
                    </div>
                </div>
                <div>
                @can('update', $post)   
                    @if($post->is_private == 0)
                        <button wire:click="makePrivate({{ $post->id }})" type="button" class="ml-auto table text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">Make Private</button>
                    @else
                        <button wire:click="makePublic({{ $post->id }})" type="button" class="ml-auto table text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Make Public</button>
                    @endif 
                @endcan
                </div>
            </article>
            <form class="border-t-2 py-2 " wire:submit.prevent="comment({{$post->id}})">
                <label class="sr-only">Your comment</label>
                <div class="flex items-center py-2 rounded-lg dark:bg-gray-700">
                    <textarea wire:model.defer="comment.{{$post->id}}" rows="1" class="block mx-4  w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your commnet..."></textarea>
                    <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                        <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                        <span class="sr-only">Send message</span>
                    </button>
                </div>
                @error('comment.'.$post->id) <span class="error">{{ $message }}</span> @enderror
            </form>
            <div>
                @foreach ($post->comments as $comment)
                    <div>
                        <p class="text-xs font-bold text-gray-500 dark:text-gray-400">{{$comment->user->name}}</p>
                        <p class="mb-2 text-sm font-light text-gray-500 dark:text-gray-400">{{$comment->comment}}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @endcan
    @endforeach
 
    {{ $posts->links() }}
</div>

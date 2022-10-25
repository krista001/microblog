<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if($updateMode)
        @include('livewire.update')
    @else
        @include('livewire.create')
    @endif

    @foreach ($posts as $post)
        <div class="flex justify-between p-4 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 mb-4">
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$post->text}}</p>
            <div>
            <button wire:click="edit({{ $post->id }})" type="button" class="ml-auto mb-2 table text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button>
            @if($post->is_private == 0)
                <button wire:click="makePrivate({{ $post->id }})" type="button" class="ml-auto table text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">Make Private</button>
            @else
                <button wire:click="makePublic({{ $post->id }})" type="button" class="ml-auto table text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Make Public</button>
            @endif 
            </div>
        </div>
    @endforeach
 
    {{ $posts->links() }}
</div>

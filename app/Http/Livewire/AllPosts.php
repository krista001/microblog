<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Collection;

use Livewire\WithPagination;

class AllPosts extends Component
{
    use WithPagination;

    public $user;
    public $comment;

    protected $rules = [
        'comment.*' => 'required|string|max:5',
    ];

    // // public function mount()
    // // {
    // //     $this->fill([
    // //         'comments' => collect([['comment' => '']]),
    // //     ]);
    // // }

    public function render()
    {
        return view('livewire.all-posts', [
            'posts' => Post::orderBy('created_at', 'desc')->paginate(10),
        ]);
    }

    public function comment($post_id)
    {
        $validatedData = $this->validate();
      
        if($validatedData && isset($validatedData['comment'][$post_id]))
        {
            $validatedData['comment'] = $validatedData['comment'][$post_id];
            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['post_id'] = $post_id;

            $res = Comment::create($validatedData);
        
            session()->flash('success', 'Comment is added successfuly');
        }

    }

    public function makePrivate($post_id)
    {
        $post = Post::find($post_id);
        $post->update([
            'is_private' => 1,
        ]);
    }

}

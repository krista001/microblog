<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Post;

class Posts extends Component
{
    public $user;
    // public $posts;
    public $text;
    public $post_id;
    public $updateMode = false;
 
    protected $rules = [
        'text' => 'required|string|max:500',
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        $posts = $this->user->posts()->orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.posts', ['posts' => $posts]);
    }

    private function resetInputFields(){
        $this->text = '';
    }

    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['user_id'] = $this->user->id;

        Post::create($validatedData);

        session()->flash('success', 'Post is added successfuly');
  
        $this->resetInputFields();
    }
  
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->text = $post->text;
  
        $this->updateMode = true;
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'text' => 'required',
        ]);
  
        $post = Post::find($this->post_id);
        $post->update([
            'text' => $this->text,
        ]);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Post Updated Successfully.');
        $this->resetInputFields();
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function makePrivate($post_id)
    {
        $post = Post::find($post_id);
        $post->update([
            'is_private' => 1,
        ]);
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ChatPreview extends Component
{
    public $id;
    public $active;
    public $title;
    public $createdAt;
    /**
     * Create a new ChatPreview component instance.
     *
     * @param bool $active Whether the chat preview is active or not.
     */
    public function __construct($active, $id, $title, $createdAt)
    {
        $this->active = $active;
        $this->id = $id;
        $this->title = $title;
        $this->createdAt = $createdAt;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.chat-preview');
    }
}

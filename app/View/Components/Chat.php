<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Chat extends Component
{
    public $chatId;
    public $messages;
    /**
     * Create a new component instance.
     */
    public function __construct($chatId, $messages)
    {
        $this->chatId = $chatId;
        $this->messages = $messages;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.chat');
    }
}

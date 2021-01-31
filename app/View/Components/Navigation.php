<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navigation extends Component
{
    protected string $template;
    protected array $links;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $links = [], $template = 'components.navigation')
    {
        $this->template = $template;
        $this->links = $links;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view($this->template, ['links' => $this->links]);
    }
}

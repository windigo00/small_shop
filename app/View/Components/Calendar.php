<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Repositories\AbstractRepository;

class Calendar extends Component
{

    protected string $name;
    protected AbstractRepository $repository;
    protected array $time;
    protected array $routes;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, AbstractRepository $repository, array $time, array $routes)
    {
        $this->name = $name;
        $this->repository = $repository;
        $this->time = $time;
        $this->routes = $routes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.calendar', [
            'name'  => $this->name,
            'repository' => $this->repository,
            'time'=> $this->time,
            'routes'=> $this->routes,
        ]);
    }
}

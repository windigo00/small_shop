<?php
namespace App\Providers\Navigation;

/**
 * Description of Navigation
 *
 * @author windigo
 */
class Navigation
{
    
    protected string $name;
    protected string $uri;
    protected string $title;
    protected int $priority = 900;
    protected array $children = [];

    public function __construct(string $uri, string $title, int $priority = 900)
    {
        $this->uri = $uri;
        $this->title = $title;
        $this->priority = $priority;
    }
    
    public function addItem(string $name, string $uri, string $title, int $priority = 900): self
    {
        if (!isset($this->children[$name])) {
            $this->children[$name] = new self($uri, $title, $priority);
            $this->children[$name]->setName($name);
        } else {
            $this->children[$name]->setUri($uri);
            $this->children[$name]->setTitle($title);
            $this->children[$name]->setPriority($priority);
        }
        uasort($this->children, function(Navigation $a, Navigation $b):int { return $a->getPriority() > $b->getPriority() ? 1 : -1; });
        return $this->children[$name];
    }

    public function getItems(): array
    {
        return $this->children;
    }
    
    public function getItem(string $name): ?self
    {
        if (!isset($this->children[$name])) {
            $this->addItem($name, '', '');
        }
        return $this->children[$name];
    }
    
    public function hasChildren()
    {
        return count($this->children) > 0;
    }
    
    public function getUri()
    {      
        return $this->uri;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function getPriority()
    {
        return $this->priority;
    }
    
    public function setUri(string $uri): self
    {      
        $this->uri = $uri;
        return $this;
    }
    
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }
    
    public function setPriority(string $priority): self
    {
        $this->priority = $priority;
        return $this;
    }
}

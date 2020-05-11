<?php
namespace App\Providers\Navigation;

/**
 * Description of Navigation
 *
 * @author windigo
 */
class Navigation
{
    protected array $struc = [];

    public function addItem(array $params): void
    {
        $this->struc[] = $params;
    }

    public function getItems(): array
    {
        return $this->struc;
    }
}

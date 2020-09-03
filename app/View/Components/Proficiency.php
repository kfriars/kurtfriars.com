<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Proficiency extends Component
{
    /**
     * The label of the proficiency
     *
     * @var string
     */
    public $label;

    /**
     * The percentage of the bar that is covered
     *
     * @var int
     */
    public $pct;

    /**
     * Create a links.
     *
     * @param null|string $currentUrl
     *
     * @return void
     */
    public function __construct(
        string $label,
        int $pct
    ) {
        $this->label = $label;
        $this->pct = $pct;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.proficiency');
    }
}

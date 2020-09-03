<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProgressBar extends Component
{
    /**
     * The percentage of the bar that is covered
     *
     * @var int
     */
    public $pct;

    /**
     * The color of the progress bar
     *
     * @var string
     */
    public $color;

    /**
     * The background color of the progress bar
     *
     * @var string
     */
    public $bgColor;

    /**
     * Create a links.
     *
     * @param null|string $currentUrl
     *
     * @return void
     */
    public function __construct(
        int $pct,
        string $color = 'bg-blue-400',
        string $bgColor = 'bg-gray-300'
    ) {
        $this->pct = $pct;
        $this->color = $color;
        $this->bgColor = $bgColor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.progress-bar');
    }
}

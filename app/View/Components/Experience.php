<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Experience extends Component
{
    /**
     * The logo of the company your experience is at
     *
     * @var string
     */
    public $logo;

    /**
     * The title of your job for the experience
     *
     * @var string
     */
    public $jobTitle;

    /**
     * The name of the company your experience was at
     *
     * @var string
     */
    public $company;

    /**
     * The date you started at the company
     *
     * @var string
     */
    public $start;

    /**
     * The date you finished at the company
     *
     * @var string
     */
    public $end;

    /**
     * Create a links.
     *
     * @param null|string $currentUrl
     *
     * @return void
     */
    public function __construct(
        string $logo,
        string $jobTitle,
        string $company,
        string $start,
        string $end
    ) {
        $this->logo = $logo;
        $this->jobTitle = $jobTitle;
        $this->company = $company;
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.experience');
    }
}

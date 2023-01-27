<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminLayout extends Component
{
    public function __construct(public ?string $title = null, public ?string $heading = null)
    {
    }

    public function render()
    {
        return view('layouts.admin');
    }
}

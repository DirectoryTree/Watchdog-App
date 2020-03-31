<?php

namespace App\Http\Livewire;

use DirectoryTree\Watchdog\LdapScan;
use Livewire\Component;

class Scan extends Component
{
    public $scan;

    public function mount(LdapScan $scan)
    {
        $this->scan = $scan;
    }

    public function render()
    {
        return view('livewire.scan');
    }
}

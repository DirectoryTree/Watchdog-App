<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DirectoryTree\Watchdog\LdapScan;

class Scan extends Component
{
    /**
     * @var LdapScan
     */
    public $scan;

    /**
     * The scan states and their name.
     *
     * @var array
     */
    public $states = [
        LdapScan::STATE_CREATED          => 'Created',
        LdapScan::STATE_IMPORTING        => 'Importing...',
        LdapScan::STATE_IMPORTED         => 'Imported',
        LdapScan::STATE_PROCESSING       => 'Processing...',
        LdapScan::STATE_PROCESSED        => 'Processed',
        LdapScan::STATE_DELETING_MISSING => 'Deleting...',
        LdapScan::STATE_DELETED_MISSING  => 'Deleted',
        LdapScan::STATE_PURGING          => 'Purging...',
        LdapScan::STATE_PURGED           => 'Purged',
    ];

    public function mount(LdapScan $scan)
    {
        $this->scan = $scan;
    }

    public function render()
    {
        return view('livewire.scan');
    }
}

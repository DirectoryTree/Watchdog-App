<?php

namespace App\Observers;

use App\Cache\CountCache;
use DirectoryTree\Watchdog\LdapScan;
use DirectoryTree\Watchdog\LdapScanProgress;

class LdapScanProgressObserver
{
    /**
     * Handle the ldap scan progress "created" event.
     *
     * @param LdapScanProgress $progress
     *
     * @return void
     */
    public function created(LdapScanProgress $progress)
    {
        if ($progress->state == LdapScan::STATE_PROCESSED) {
            app(CountCache::class)->flush($progress->scan->watcher);
        }
    }
}

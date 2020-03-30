<?php

namespace App;

use DirectoryTree\Watchdog\Watchdog;
use DirectoryTree\Watchdog\LdapWatcher;

class WatchdogRepository
{
    /**
     * The configured watchdogs for the given watcher.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $dogs;

    public function __construct(LdapWatcher $watcher)
    {
        $this->dogs = collect(
            array_keys(config("watchdog.watch.{$watcher->model}", []))
        )->transform(function ($watchdog) {
            return app($watchdog);
        });
    }

    /**
     * Get all of the watchdogs for the watcher.
     *
     * @return \Illuminate\Support\Collection
     */
    public function get()
    {
        return $this->dogs;
    }

    /**
     * Find a watchdog by its name.
     *
     * @param string $key
     *
     * @return Watchdog|null
     */
    public function find($key)
    {
        return $this->dogs->first(function (Watchdog $watchdog) use ($key) {
            return $watchdog->getKey() == $key;
        });
    }
}

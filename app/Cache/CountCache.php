<?php

namespace App\Cache;

use Closure;
use App\WatchdogRepository;
use Illuminate\Cache\CacheManager;
use DirectoryTree\Watchdog\Watchdog;
use DirectoryTree\Watchdog\LdapWatcher;

class CountCache
{
    /**
     * The cache store.
     *
     * @var CacheManager
     */
    protected $cache;

    /**
     * Constructor.
     *
     * @param CacheManager $cache
     */
    public function __construct(CacheManager $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Flush the count cache.
     *
     * @param LdapWatcher $watcher
     *
     * @return void
     */
    public function flush(LdapWatcher $watcher)
    {
        $relations = ['changes', 'objects', 'scans'];

        foreach ($relations as $relation) {
            $this->cache->delete($this->key($watcher, $relation));
        }

        foreach ((new WatchdogRepository($watcher))->get() as $watchdog) {
            $this->cache->delete($this->notificationKey($watcher, $watchdog));
        }
    }

    /**
     * Get a cached count of all LDAP changes.
     *
     * @param LdapWatcher $watcher
     *
     * @return int
     */
    public function changes(LdapWatcher $watcher)
    {
        return $this->cache($this->key($watcher, 'changes'), function () use ($watcher) {
            return $watcher->changes()->count();
        });
    }

    /**
     * Get a cached count of all LDAP objects.
     *
     * @param LdapWatcher $watcher
     *
     * @return int
     */
    public function objects(LdapWatcher $watcher)
    {
        return $this->cache($this->key($watcher, 'objects'), function () use ($watcher) {
            return $watcher->objects()->count();
        });
    }

    /**
     * Get a cached count of all LDAP scans.
     *
     * @param LdapWatcher $watcher
     *
     * @return int
     */
    public function scans(LdapWatcher $watcher)
    {
        return $this->cache($this->key($watcher, 'scans'), function () use ($watcher) {
            return $watcher->scans()->count();
        });
    }

    /**
     * Get the notification count for the given watchdog.
     *
     * @param LdapWatcher $watcher
     * @param Watchdog    $watchdog
     *
     * @return int
     */
    public function notifications(LdapWatcher $watcher, Watchdog $watchdog)
    {
        return $this->cache($this->notificationKey($watcher, $watchdog), function () use ($watchdog) {
            return $watchdog->notifications()->whereDate('created_at', today())->count();
        });
    }

    /**
     * Get the notification cache key for the given watchdog.
     *
     * @param LdapWatcher $watcher
     * @param Watchdog    $watchdog
     *
     * @return string
     */
    protected function notificationKey(LdapWatcher $watcher, Watchdog $watchdog)
    {
        return $this->key($watcher, "notifications.{$watchdog->getKey()}");
    }

    /**
     * Get the cache key for the watcher and relation.
     *
     * @param LdapWatcher $watcher
     * @param string      $relation
     *
     * @return string
     */
    protected function key(LdapWatcher $watcher, $relation)
    {
        return "ldap.watcher.{$watcher->id}.$relation.count";
    }

    /**
     * Cache the result of the closure forever.
     *
     * @param string  $key
     * @param Closure $closure
     *
     * @return mixed
     */
    protected function cache($key, Closure $closure)
    {
        return $this->cache->rememberForever($key, $closure);
    }
}

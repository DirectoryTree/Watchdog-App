<?php

namespace Tests;

use App\Ldap\Entry;
use DirectoryTree\Watchdog\LdapWatcher;

class WatcherTest extends TestCase
{
    public function test_setup_picks_up_default_watcher()
    {
        $this->assertEmpty(LdapWatcher::get());

        $this->artisan('watchdog:setup');

        $watchers = LdapWatcher::get();

        $this->assertCount(1, $watchers);
        $this->assertEquals(Entry::class, $watchers->first()->model);
    }

    public function test_watcher_can_be_seen_on_home_page()
    {
        $this->signIn();

        $this->artisan('watchdog:setup');

        $watcher = LdapWatcher::first();

        $this->get('/')
            ->assertSee($watcher->name)
            ->assertSee('View');
    }

    public function test_watcher_dashboard_works()
    {
        $this->signIn();

        $this->artisan('watchdog:setup');

        $this->get(route('watchers.show', LdapWatcher::first()))
            ->assertOk()
            ->assertSee('Dashboard')
            ->assertSee('Objects')
            ->assertSee('Changes')
            ->assertSee('Scans');
    }
}

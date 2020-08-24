<?php

namespace App\View\Components;

use Illuminate\View\Component;
use DirectoryTree\Watchdog\LdapObject;
use DirectoryTree\Watchdog\LdapWatcher;

class WatcherObject extends Component
{
    /**
     * @var LdapWatcher
     */
    public $watcher;

    /**
     * @var LdapObject
     */
    public $object;

    /**
     * Whether the tree is opened.
     *
     * @var bool
     */
    public $opened;

    /**
     * @var \Illuminate\Support\Collection
     */
    public $children;

    /**
     * Create a new component instance.
     *
     * @param LdapWatcher $watcher
     * @param LdapObject  $object
     * @param bool        $opened
     *
     * @return void
     */
    public function __construct(LdapWatcher $watcher, LdapObject $object, $opened = false)
    {
        $this->watcher = $watcher;
        $this->object = $object;
        $this->opened = $opened;
        $this->children = $opened ? $object->children()->get() : collect();
    }

    /**
     * Invoke the blade component via route.
     *
     * @param LdapWatcher $watcher
     * @param LdapObject $object
     *
     * @return \Illuminate\View\View|string
     */
    public function __invoke(LdapWatcher $watcher, LdapObject $object)
    {
        $this->watcher = $watcher;
        $this->object = $object;
        $this->opened = request('opened', false);
        $this->children = $this->opened ? $object->children()->get() : collect();

        return $this->render();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.watcher-object', [
            'watcher' => $this->watcher,
            'object' => $this->object,
            'opened' => $this->opened,
            'children' => $this->children,
        ]);
    }
}

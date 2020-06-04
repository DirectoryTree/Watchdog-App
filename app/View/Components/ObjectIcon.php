<?php

namespace App\View\Components;

use Illuminate\View\Component;
use DirectoryTree\Watchdog\LdapObject;
use DirectoryTree\Watchdog\Ldap\TypeResolver;

class ObjectIcon extends Component
{
    /**
     * @var LdapObject
     */
    protected $object;

    /**
     * Create a new component instance.
     *
     * @param LdapObject $object
     */
    public function __construct(LdapObject $object)
    {
        $this->object = $object;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        switch ($this->object->type) {
            case TypeResolver::TYPE_USER:
                $icon = 'user';
                break;
            case TypeResolver::TYPE_GROUP:
                $icon = 'users';
                break;
            case TypeResolver::TYPE_COMPUTER:
                $icon = 'desktop';
                break;
            case TypeResolver::TYPE_CONTAINER:
                // Fallthrough.
            case TypeResolver::TYPE_DOMAIN:
                $icon = 'folder';
                break;
            default:
                $icon = 'question-circle';
                break;
        }

        return view('components.object-icon', ['icon' => $icon]);
    }
}

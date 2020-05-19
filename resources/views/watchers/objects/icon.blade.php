@switch($object->type)
    @case(\DirectoryTree\Watchdog\Ldap\TypeResolver::TYPE_USER)
        <i data-feather="user"></i>
        @break
    @case(\DirectoryTree\Watchdog\Ldap\TypeResolver::TYPE_CONTAINER)
        <i data-feather="folder"></i>
        @break
    @case(\DirectoryTree\Watchdog\Ldap\TypeResolver::TYPE_GROUP)
        <i data-feather="users"></i>
        @break
    @case(\DirectoryTree\Watchdog\Ldap\TypeResolver::TYPE_DOMAIN)
        @break
    @default
        <i data-feather="help-circle"></i>
        @break
@endswitch

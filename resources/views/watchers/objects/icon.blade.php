@switch($object->type)
    @case(\DirectoryTree\Watchdog\Ldap\TypeResolver::TYPE_USER)
        <i class="far fa-user"></i>
        @break
    @case(\DirectoryTree\Watchdog\Ldap\TypeResolver::TYPE_CONTAINER)
        <i class="far fa-folder"></i>
        @break
    @case(\DirectoryTree\Watchdog\Ldap\TypeResolver::TYPE_GROUP)
        <i class="far fa-users"></i>
        @break
    @case(\DirectoryTree\Watchdog\Ldap\TypeResolver::TYPE_DOMAIN)
        @break
    @default
        <i class="far fa-question-circle"></i>
        @break
@endswitch

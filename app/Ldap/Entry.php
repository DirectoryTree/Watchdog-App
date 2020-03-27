<?php

namespace App\Ldap;

use LdapRecord\Models\ActiveDirectory\Entry as BaseModel;

class Entry extends BaseModel
{
    /**
     * The object classes of the LDAP model.
     *
     * @var array
     */
    public static $objectClasses = [];
}

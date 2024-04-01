<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Role extends Model
{
    use HasFactory;

    // OneToMany relationship with users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Retrieve a role by its name and validate against a list of allowed roles.
     *
     * @param string $rolename The name of the role to retrieve.
     * @param array $allowedRoles An array containing the names of allowed roles.
     * @return Role An instance of the Role model representing the retrieved role.
     * @throws \InvalidArgumentException If the provided role name is not allowed.
     * @throws ModelNotFoundException If the role is not found.
     */
    public static function getRoleByName($rolename, array $allowedRoles): Role
    {
        $role = self::where('name', $rolename)->firstOrFail();

        if (!in_array($role->name, $allowedRoles)) {
            throw new \InvalidArgumentException("Invalid role name!");
        }

        return $role;
    }
}

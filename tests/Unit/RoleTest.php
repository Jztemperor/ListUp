<?php

namespace Tests\Unit;

use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use InvalidArgumentException;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_getRoleByName_return_correct_role_instance()
    {
        $role = Role::factory()->create(['name' => 'test_role']);
        $allowedRoles = ['test_role'];

        $retrievedRole = Role::getRoleByName('test_role', $allowedRoles);

        $this->assertEquals($role->id, $retrievedRole->id);
        $this->assertEquals($role->name, $retrievedRole->name);
    }

    public function test_getRoleByName_throws_ModelNotFoundException_for_invalid_role_name()
    {
        $this->expectException(ModelNotFoundException::class);
        $allowedRoles = ['test_role'];

        Role::getRoleByName('invalid_role', $allowedRoles);
    }

    public function test_getRoleByName_throws_InvalidArgumentException_for_invalid_role()
    {
        $this->expectException(InvalidArgumentException::class);
        $role = Role::factory()->create(['name' => 'test_role']);
        $allowedRoles = ['another_role'];

        Role::getRoleByName('test_role', $allowedRoles);
    }
}

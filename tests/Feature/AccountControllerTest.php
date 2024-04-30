<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use InvalidArgumentException;
use Tests\TestCase;

class AccountControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_store_method_successfully_stores_user()
    {
        // setup
        $role = Role::factory()->create(['name' => 'valid_role']);
        Config::set('roles.allowed_roles_at_registration', ['valid_role']);

        $request = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'phone_number' => '(231)-231-2312',
            'role' => 'valid_role',
            'password' => 'validPassword20!',
            'password_confirmation' => 'validPassword20!'
        ];

        $response = $this->post(route('account.store'), $request);

        // Assert
        $response->assertRedirect(route('login'));

        $this->assertDatabaseHas('users', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'phone_number' => '(231)-231-2312',
            'role_id' => $role->id,
        ]);

        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'name' => 'valid_role'
        ]);
    }

    public function test_store_method_redirects_with_error_message_when_validation_fails()
    {
        $request = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoexample.com', // Invalid email
            'phone_number' => '(-2312', // Invalid phone nr
            // Missing role
        ];

        $response = $this->post(route('account.store'), $request);

        $response->assertRedirect(route('index.index'))
            ->assertSessionHasErrors();
    }

    public function test_store_method_handles_exception_when_role_not_found()
    {
        $this->mock(Role::class, function ($mock) {
            $mock->shouldReceive('getRoleByName')->andThrow(ModelNotFoundException::class);
        });

        $request = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'phone_number' => '(231)-231-2312',
            'role' => 'valid_role',
            'password' => 'validPassword20!',
            'password_confirmation' => 'validPassword20!'
        ];

        $response = $this->post(route('account.store'), $request);

        
        $response->assertSessionHas('message', function ($message) {
            return $message['type'] === 'error';
        });
    }

    public function test_store_method_handles_exception_when_role_is_not_allowed()
    {
        $this->mock(Role::class, function ($mock) {
            $mock->shouldReceive('getRoleByName')->andThrow(InvalidArgumentException::class);
        });

        $request = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'phone_number' => '(231)-231-2312',
            'role' => 'valid_role',
            'password' => 'validPassword20!',
            'password_confirmation' => 'validPassword20!'
        ];

        $response = $this->post(route('account.store'), $request);

        $response->assertSessionHas('message', function ($message) {
            return $message['type'] === 'error';
        });
    }
}

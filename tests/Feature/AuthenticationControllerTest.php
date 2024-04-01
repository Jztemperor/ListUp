<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthenticationControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_login_form_is_displayed()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(Response::HTTP_OK)
            ->assertInertia(
                fn ($assert) => $assert
                    ->component('Authentication/Login')
            );
    }

    public function test_valid_login_redirects_to_home()
    {
        Role::factory()->create(['name' => 'customer']);
        $user = User::factory()->role('Customer')->create();
        $request = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $response = $this->post(route('login'), $request);

        $response->assertRedirect(route('index.index'));
    }

    public function test_invalid_login_displays_error_message()
    {
        $request = [
            'email' => 'jd@example.com',
            'password' => 'pwd',
        ];

        $response = $this->post(route('login'), $request);
        $response->assertSessionHasErrors(['email' => 'Invalid credentials!']);
    }
}

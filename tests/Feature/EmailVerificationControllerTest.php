<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;
use Illuminate\Http\Response;
use App\Models\User;

class EmailVerificationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        
        Role::insert([
            ['name' => 'Admin'],
            ['name' => 'Customer'],
        ]);
    }

    public function test_fulfills_email_verification_request_for_authenticated_user()
    {
        Notification::fake();
        $user = User::factory()->role('Customer')->create(['email_verified_at' => null]);
        $this->actingAs($user);
        $url = URL::signedRoute('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]);
        
        $response = $this->get($url);
    
        $response->assertRedirect('/');
        $this->assertNotNull($user->fresh()->email_verified_at);
    }

    public function test_resends_verification_email_for_authenticated_user()
    {
        Notification::fake();
        $user = User::factory()->role('Customer')->create(['email_verified_at' => null]);
        $this->actingAs($user);
        
        $response = $this->post('/email/verification-notification');

        $response->assertRedirect('/')->assertSessionHas([
            'message' => [
                'type' => 'success',
                'message' => "Verification email sent!"
            ]
        ]);
        Notification::assertSentTo($user, VerifyEmail::class);
    }

}

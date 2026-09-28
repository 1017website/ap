<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\CompanyPage;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        app(CompanyPage::class)->import();
        $this->seed(ProductSeeder::class);

        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Connected by chemistry.')
            ->assertSee('Citric Acid Anhydrous')
            ->assertSee('/assets/api-logo-navbar.png', false);
    }

    public function test_admin_can_open_the_content_editor(): void
    {
        app(CompanyPage::class)->import();
        $user = User::factory()->create(['role' => 'developer', 'is_active' => true]);
        $user->forceFill(['is_admin' => true])->save();

        $this->actingAs($user)
            ->get('/admin?section=home')
            ->assertOk()
            ->assertSee('AP Indonesia')
            ->assertSee('Live preview');
    }
}

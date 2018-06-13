<?php

namespace Tests\Feature;

use EmployeeDirectory\Entity\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AccessTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function guestCanBrowseMainPage(): void
    {
        $this->get('/')
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function guestCanNotBrowseDetailsPage(): void
    {
        $this->get('/admin/employees')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function userCanBrowseDetailsPage(): void
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/admin/employees');
        $response->assertStatus(200);
    }
}

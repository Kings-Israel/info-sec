<?php

namespace Tests\Feature;

use App\Models\Visitor;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VisitorsTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->getUser();
        $this->admin = $this->getUser(true);
    }

    public function test_guests_page_contains_no_guests_found()
    {
        $response = $this->actingAs($this->user)->get('/guest');

        $response->assertStatus(200);
        $response->assertSee((__('No Guests Found')));
    }

    public function test_guests_page_does_not_contain_no_guests_found()
    {
        $visitors = Visitor::factory(1)->create();

        $visitor = $visitors->first();

        $response = $this->actingAs($this->user)->get('/guest');

        $response->assertStatus(200);

        $response->assertDontSee((__('No Guests Found')));

        $response->assertViewHas('guests', function($collection) use ($visitor) {
            return $collection->contains($visitor);
        });
    }

    public function test_paginated_guests_page_does_not_contain_11th_guest()
    {
        $visitors = Visitor::factory(11)->create();

        $visitor = $visitors->last();

        $response = $this->actingAs($this->user)->get('/guest');

        $response->assertStatus(200);

        $response->assertDontSee((__('No Guests Found')));

        $response->assertViewHas('guests', function($collection) use ($visitor) {
            return !$collection->contains($visitor);
        });
    }

    public function test_admin_can_see_add_guest_button()
    {
        $response = $this->actingAs($this->admin)->get('/guest');

        $response->assertStatus(200);

        $response->assertSee('Add Guest');
    }

    public function test_non_admin_cannot_see_add_guest_button()
    {
        $response = $this->actingAs($this->user)->get('/guest');

        $response->assertStatus(200);

        $response->assertDontSee('Add Guest');
    }

    public function test_admin_can_see_add_guest_page()
    {
        $response = $this->actingAs($this->admin)->get('/add-guest');

        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_see_add_guest_page()
    {
        $response = $this->actingAs($this->user)->get('/add-guest');

        $response->assertStatus(403);
    }

    public function test_create_guest_successful()
    {
        $guest = [
            'name' => 'New Guest',
            'category' => 'Delegate',
            'Role' => 'Director',
            'Country' => 'Kenya',
            'Company' => 'UNIDO',
        ];
        $response = $this->actingAs($this->admin)->post('/add-guest', $guest);

        $response->assertStatus(302);
        $response->assertRedirect('/guest');

// TODO: Check issue with assertDatabaseHas
//        $this->assertDatabaseHas((new Visitor())->getTable(), $guest);

        $last_guest = Visitor::latest()->first();
        $this->assertEquals($guest['name'], $last_guest->name);
    }

    /**
     * @return User|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    private function getUser(bool $isAdmin = false)
    {
        return User::factory()->create([
            'is_admin' => $isAdmin,
        ]);
    }
}

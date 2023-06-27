<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Tests\TestCase;

class PotControllerTest extends TestCase
{
    /** @test */
    public function authenticated_users_can_create_pots()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->actingAs($user)->post('/pots', [
            'user_id' => $user->id,
            'name' => 'authenticated_users_can_create_pots',
            'is_private' => 'public',
            'description' => 'this is an example of a pot!',
            'amount' => 0,
            'goal' => 500.00,
            'status' => 'open',
            'cover_photo_path' => null,
            'accent_colour' => null,
        ]);

        $this->assertDatabaseHas('pots', ['name' => 'authenticated_users_can_create_pots']);
    }

        /** @test */
        public function authenticated_users_can_create_admins()
        {
            $this->withoutExceptionHandling();

            $user = User::factory()->create();

            $this->actingAs($user)->post('/pots', [
                'user_id' => $user->id,
                'name' => 'authenticated_users_can_create_pots',
                'is_private' => 'public',
                'description' => 'this is an example of a pot!',
                'amount' => 0,
                'goal' => 500.00,
                'status' => 'open',
                'cover_photo_path' => null,
                'accent_colour' => null,
            ]);

            $this->assertDatabaseHas('pots', ['name' => 'authenticated_users_can_create_pots']);
        }
}

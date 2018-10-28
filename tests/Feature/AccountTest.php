<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    public function testGetSettingsPage()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('account.edit'));

        $response->assertOk();
    }

    public function testAccountDelete()
    {
        $user = factory(User::class)->create([
            'name' => 'testName'
        ]);
        $this->assertDatabaseHas('users', ['name' => 'testName']);
        $response = $this->actingAs($user)->call('DELETE', route('account.delete'));
        $this->assertDatabaseMissing('users', ['name' => 'testName']);
    }

    public function testAccountUpdate()
    {
        $user = factory(User::class)->create([
            'name' => 'testName',
            'email' => 'test@domain.com'
        ]);
        $this->assertDatabaseHas('users', ['name' => 'testName', 'email' => 'test@domain.com']);
        $this->actingAs($user)->call('PUT',
            route('account.update'),
            ['name' => 'newName', 'email' => 'newEmail@domain.com']);
        $this->assertDatabaseHas('users', ['name' => 'newName', 'email' => 'newEmail@domain.com']);
    }
}
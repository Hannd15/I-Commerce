<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use RefreshDatabase; // Resets the database for each test

    /** @test */
    public function it_creates_a_user_successfully()
    {
        $response = $this->post(route('users.create'), [
            'username' => 'new_user',
            'password' => Hash::make('password123'),
        ]);

        $response->assertRedirect(); // Check redirection
        $this->assertDatabaseHas('users', ['username' => 'new_user']); // Verify the user exists in the database
    }

    /** @test */
    public function it_does_not_create_a_user_if_username_already_exists()
    {
        // Arrange: Create a user with the username already
        User::create([
            'username' => 'existing_user',
            'password' => Hash::make('password123'),
            'id_type' => 2,
        ]);

        // Act: Attempt to create a user with the same username
        $response = $this->post(route('users.create'), [
            'username' => 'existing_user',
            'password' => Hash::make('password123'),
        ]);

        $response->assertSessionHasErrors(['username' => 'This username already exists']);
        $this->assertCount(1, User::where('username', 'existing_user')->get()); // Ensure no duplicate
    }

    /** @test */
    public function it_deletes_a_user_successfully()
    {
        // Arrange: Create a user in the database
        $user = User::create([
            'username' => 'user_to_delete',
            'password' => Hash::make('password123'),
            'id_type' => 2,
        ]);

        // Act: Attempt to delete the user
        $response = $this->post(route('users.delete'), ['id' => $user->id]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'User deleted successfully');
        $this->assertDatabaseMissing('users', ['id' => $user->id]); // Verify user is deleted
    }

    /** @test */
    public function it_returns_an_error_if_the_user_to_delete_does_not_exist()
    {
        $response = $this->post(route('users.delete'), ['id' => 9999]); // Non-existent ID

        $response->assertRedirect();
        $response->assertSessionHas('error', 'User not found');
    }

    /** @test */
    public function it_updates_an_existing_user_successfully()
    {
        // Arrange: Create a user in the database
        $user = User::create([
            'username' => 'old_username',
            'password' => Hash::make('old_password'),
            'id_type' => 2,
        ]);

        // Act: Attempt to update the user's username and password
        $response = $this->post(route('users.update'), [
            'id' => $user->id,
            'username' => 'updated_username',
            'password' => 'new_password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'User updated successfully');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'username' => 'updated_username',
        ]); // Check updated username
        $this->assertTrue(Hash::check('new_password', User::find($user->id)->password)); // Check updated password
    }

    /** @test */
    public function it_returns_an_error_if_the_user_to_update_does_not_exist()
    {
        // Act: Attempt to update a non-existing user
        $response = $this->post(route('users.update'), [
            'id' => 9999, // Non-existent ID
            'username' => 'username_does_not_exist',
            'password' => Hash::make('password_does_not_exist'),
        ]);

        // Assert: Check for redirection and error message
        $response->assertRedirect();
        $response->assertSessionHas('error', 'User not found');
    }

    /** @test */
    public function it_returns_validation_errors_if_required_fields_are_missing()
    {
        // Act: Attempt to create a user with missing fields
        $response = $this->post(route('users.create'), [
            'username' => '', // Missing required fields
            'password' => '',
        ]);

        // Assert: Check for validation errors
        $response->assertSessionHasErrors(['username', 'password']);
    }
}

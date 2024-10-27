<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Item;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase; // Reset the database for each test

    /** @test */
    public function it_creates_an_item_successfully()
    {
        $response = $this->post(route('items.create'), [
            'name' => 'Test Item',
            'description' => 'Test Description',
            'price' => 100,
            'available_amount' => 10,
        ]);

        $response->assertRedirect(); // Check redirection
        $response->assertSessionHas('success', 'Item created successfully'); // Check success message
        $this->assertDatabaseHas('items', ['name' => 'Test Item']); // Check database for the item
    }

    /** @test */
    public function it_displays_an_error_if_name_already_exists()
    {
        Item::create([
            'name' => 'Duplicate Name',
            'description' => 'Some Description',
            'price' => 50,
            'available_amount' => 5,
        ]);

        $response = $this->post(route('items.create'), [
            'name' => 'Duplicate Name',
            'description' => 'Another Description',
            'price' => 60,
            'available_amount' => 6,
        ]);

        $response->assertSessionHasErrors(['name' => 'This name already exists']);
    }

    /** @test */
    public function it_displays_validation_errors_if_required_fields_are_missing()
    {
        $response = $this->post(route('items.create'), [
            'name' => '', // Missing required fields
            'price' => '',
            'available_amount' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'price', 'available_amount']);
    }

    /** @test */
    public function it_deletes_an_existing_item_successfully()
    {
        // Arrange: Create an item in the database
        $item = Item::create([
            'name' => 'Test Item',
            'description' => 'Test Description',
            'price' => 100,
            'available_amount' => 10,
        ]);

        // Act: Attempt to delete the item
        $response = $this->post(route('items.delete'), [
            'id' => $item->id,
        ]);

        // Assert: Check for redirection and success message
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Item deleted successfully');
        $this->assertDatabaseMissing('items', ['id' => $item->id]); // Verify item is deleted
    }

    /** @test */
    public function it_returns_an_error_if_the_item_does_not_exist()
    {
        // Act: Attempt to delete a non-existing item
        $response = $this->post(route('items.delete'), [
            'id' => 9999, // Non-existent ID
        ]);

        // Assert: Check for redirection and error message
        $response->assertRedirect();
        $response->assertSessionHas('error', 'Item not found');
    }
    /** @test */
    public function it_updates_an_existing_item_successfully()
    {
        // Arrange: Create an item in the database
        $item = Item::create([
            'name' => 'Original Name',
            'description' => 'Original Description',
            'price' => 100,
            'available_amount' => 10,
        ]);

        // Act: Attempt to update the item
        $response = $this->post(route('items.update'), [
            'id' => $item->id,
            'name' => 'Updated Name',
            'description' => 'Updated Description',
            'price' => 150,
            'available_amount' => 5,
        ]);

        // Assert: Check for redirection and success message
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Item updated successfully');

        // Verify that the item was updated in the database
        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'name' => 'Updated Name',
            'description' => 'Updated Description',
            'price' => 150,
            'available_amount' => 5,
        ]);
    }

    /** @test */
    public function it_returns_an_error_if_the_item_does_not_exist_in_update()
    {
        // Act: Attempt to update a non-existing item
        $response = $this->post(route('items.update'), [
            'id' => 9999, // Non-existent ID
            'name' => 'Updated Name',
            'description' => 'Updated Description',
            'price' => 150,
            'available_amount' => 5,
        ]);

        // Assert: Check for redirection and error message
        $response->assertRedirect();
        $response->assertSessionHas('error', 'Item not found');
    }

    /** @test */
    public function it_returns_validation_errors_if_required_fields_are_missing()
    {
        // Act: Attempt to update an item without required fields
        $response = $this->post(route('items.update'), [
            'id' => '',  // Missing 'id'
            'name' => '',  // Missing 'name'
            'price' => '',  // Missing 'price'
            'available_amount' => '',  // Missing 'available_amount'
        ]);

        // Assert: Check for validation errors
        $response->assertSessionHasErrors(['id', 'name', 'price', 'available_amount']);
    }
}

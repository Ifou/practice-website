<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    protected $model = \App\Models\Room::class;

    public function definition()
    {
        return [
            'room_title' => $this->faker->sentence,
            'room_description' => $this->faker->paragraph,
            'room_image' => $this->faker->imageUrl,
            'room_price' => $this->faker->randomNumber(2),
            'room_type' => $this->faker->word,
            'room_status' => $this->faker->randomElement(['Vacant', 'Booked']),
            'room_capacity' => $this->faker->randomNumber(1),
            'room_wifi' => $this->faker->boolean,
        ];
    }
}

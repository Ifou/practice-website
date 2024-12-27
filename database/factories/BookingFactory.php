<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_id' => Room::factory(),
            'full_name' => $this->faker->name,
            'number' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
        ];
    }
}

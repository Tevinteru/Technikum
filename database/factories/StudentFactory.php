<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'group' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
            'height' => $this->faker->numberBetween(150, 200),
            'birth_date' => $this->faker->date,
            'average_score' => $this->faker->randomFloat(2, 2.0, 5.0),
            'library_member' => $this->faker->boolean,
        ];
    }
}
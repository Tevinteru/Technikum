<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Teacher;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'middle_name' => $this->faker->firstName,
            'birth_date' => $this->faker->date,
            'subject' => $this->faker->randomElement(['Математика', 'Физика', 'Химия', 'Биология', 'Информатика']),
            'education' => $this->faker->randomElement(['Высшее', 'Среднее специальное']),
            'experience' => $this->faker->numberBetween(1, 40),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
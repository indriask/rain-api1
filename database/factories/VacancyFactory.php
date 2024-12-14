<?php

namespace Database\Factories;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacancy>
 */
class VacancyFactory extends Factory
{
    // model yang digunakan untuk proses factory
    protected $model = Vacancy::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nib' => '4342401034',
            'applied' => fake()->numberBetween(5, 30),
            'status' => 'unverified',
            'title' => fake()->sentence(rand(1, 3)),
            'salary' => fake()->numberBetween(1000000, 6000000),
            'time_type' => 'full time',
            'type' => 'offline',
            'duration' => fake()->numberBetween(3, 6),
            'major' => 'Teknik Informatika',
            'location' => fake()->streetAddress(),
            'description' => fake()->paragraph(rand(3, 6)),
            'quota' => fake()->numberBetween(5, 30),
            'date_created' => date('Y-m-d', time()),
            'date_ended' => date('Y-m-d', time() + 86400)
        ];
    }

    public function randStatus() {
        return $this->state(function (array $attribute) {
            return [
                'status' => ['verified', 'unverified'][rand(0, 1)]
            ];
        });
    }

    public function randSalary() {
        return $this->state(function (array $attribute) {
            return [
                'salary' => rand(1, 20) === 13 ? 0 : $attribute['salary']
            ];
        });
    }

    public function randTimeTypeAndType() {
        return $this->state(function (array $attribute) {
            return [
                'time_type' => rand(1, 20) === 13 ? 'part time' : $attribute['time_type'],
                'type' => rand(1, 20) === 14 ? 'online' : $attribute['type']
            ];
        });
    }

    public function randMajor() {
        return $this->state(function (array $attribute) {
            return [
                'major' => ['Teknik Informatika', 'Teknik Elektro', 'Manajemen Bisnis', 'Teknik Mesin'][rand(0, 3)]
            ];
        });
    }
}

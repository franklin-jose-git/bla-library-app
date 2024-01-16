<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Book;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrowing>
 */
class BorrowingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $unique_user_id = User::inRandomOrder()
            ->where('name', '!=','admin')
            ->pluck('id')
            ->first();

        $unique_book_id = Book::inRandomOrder()
            ->pluck('id')
            ->first();

        $useTodayForDueDate = fake()->randomfloat(0,0,1) <= 0.3;

        if ($useTodayForDueDate) {
            $faker_date = Carbon::now()->addDays(-21);
        }
        else {
            $faker_date =  fake()->dateTimeBetween(Carbon::now()->subDays(100),Carbon::now());
        }

        $faker_due_date =  Carbon::parse($faker_date)->addDays(20)->startOfDay();

        $faker_delivered = fake()->randomfloat(0,0,1) <= 0.4;

        $faker_delivered_date =  $faker_delivered ? $faker_due_date :null;

        return [
            'book_id' => $unique_book_id,
            'user_id' => $unique_user_id,
            'borrowing_date' => $faker_date,
            'due_date' => $faker_due_date,
            'delivered_date' => $faker_delivered_date,
            'delivered' => $faker_delivered ,
        ];
    }
}

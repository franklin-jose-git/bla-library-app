<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'genre',
        'isbn',
        'total_copies',
    ];

    public function scopeTotal($query)
    {
        return $query->count();
    }

    public function borrowed()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function scopeTotalBorrowed($query)
    {
        return $query->whereHas('borrowed', function ($subQuery)
        {
            $subQuery->where('delivered', false);
        });
    }

    public function scopeHasDueToday($query)
    {
        return $query->whereHas('borrowed', function ($subQuery)
        {
            $subQuery->where('delivered', false)
                     ->where('due_date', Carbon::now());
        });
    }
}

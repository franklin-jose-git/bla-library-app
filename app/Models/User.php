<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Carbon\Carbon;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'usertype',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'email'=> $this->email,
            'name'=> $this->name,
        ];
    }

    public function isLibrarian()
    {
        return $this->usertype == 'Librarian';
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function scopeHasOverdueBooks($query)
    {
        return $query->whereHas('borrowings', function ($subQuery) {
            $subQuery->where('delivered', false)
                ->whereDate('due_date', '<', Carbon::now()->startOfDay());
        });
    }

    public function scopeListOverdueBooks($query)
    {
        //dd($this->id);
        return $query->whereHas('borrowings', function ($subQuery)
        {
            $subQuery->where('due_date', '<', Carbon::now())
                     ->where('delivered', false)
                     ->where('user_id',$this->id);
        });
    }

    public function scopeBorrowedBooks($query) 
    {
        return $query->whereHas('borrowings', function($subQuery) {
            $subQuery->where('delivered', true);
        });
    }
}

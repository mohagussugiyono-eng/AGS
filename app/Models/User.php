<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Atribut yang boleh diisi secara massal
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'points', // poin user
    ];

    /**
     * Atribut yang disembunyikan saat serialization
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data atribut
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * =====================================
     * MENENTUKAN KELAS USER BERDASARKAN POIN
     * =====================================
     */
    public function getPointClassAttribute(): string
    {
        if ($this->points <= 10000) {
            return 'Bronze';
        } elseif ($this->points <= 50000) {
            return 'Silver';
        } elseif ($this->points <= 100000) {
            return 'Gold';
        } else {
            return 'Platinum';
        }
    }

    /**
     * =====================================
     * WARNA BADGE (BOOTSTRAP) SESUAI KELAS
     * =====================================
     */
    public function getPointBadgeAttribute(): string
    {
        return match ($this->point_class) {
            'Bronze'   => 'secondary',
            'Silver'   => 'info',
            'Gold'     => 'warning',
            'Platinum' => 'primary',
            default    => 'dark',
        };
    }
    public function getLevelAttribute()
    {
        $points = $this->points;

        if ($points > 100000) {
            return 'Platinum';
        } elseif ($points > 50000) {
            return 'Gold';
        } elseif ($points > 10000) {
            return 'Silver';
        } else {
            return 'Bronze';
        }
    }
}

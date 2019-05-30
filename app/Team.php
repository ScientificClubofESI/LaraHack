<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        "id",
        "name",
        "code"
    ];

    public function hackers()
    {
        return $this->hasMany(Hacker::class);
    }
}

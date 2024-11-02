<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThematicArea extends Model
{
    use HasFactory;

    protected $fillable = ['thematic_area_name'];

    /**
     * Get the users associated with the thematic area.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'thematic_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The visitors that belong to the Session
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function visitors()
    {
        return $this->belongsToMany(Visitor::class, 'visitor_session');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Debate extends Model
{
    // Permettiamo il salvataggio del messaggio dal form
    protected $fillable = [
        'title',     // <-- DEVI AGGIUNGERE QUESTO
        'message',
    ];

    // Relazione: questo dibattito appartiene a un utente
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class)->latest();
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy(User $user) {
        return $this->likes->contains('user_id', $user->id);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id', 'tag_id'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }

    public function scopeWhereMine($query)
    {
        $query->where('user_id', auth()->user()->id);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhereHas('author', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        })->when($filters['order'] ?? null, function ($query, $orderBy) {
            if ($orderBy == 'oldest') {
                $query->oldest();
            } else {
                $query->latest();
            }
        }, fn() => $query->latest())->when($filters['mine'] ?? null, function ($query, $mine) {
            if ($mine == 'true') {
                $query->where('user_id', auth()?->user()?->id);
            }
        })->when($filters['filter'] ?? null, function ($query, $filter) {
            $query->where('tag_id', $filter);
        });
    }
}

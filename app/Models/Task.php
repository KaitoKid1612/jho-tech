<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'opportunity_id', 'contact_id', 'title', 'description', 'status', 'due_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'task_tags');
    }
}

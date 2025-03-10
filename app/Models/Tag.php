<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color'];

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'contact_tags');
    }

    public function opportunities()
    {
        return $this->belongsToMany(Opportunity::class, 'opportunity_tags');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_tags');
    }
}

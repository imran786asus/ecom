<?php

namespace App\Models;

use App\Events\CategoryDeleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    /**
     * The event map for the model.
     *
     * @var array<string, string>
     */
    protected $dispatchesEvents = [
        'deleted' => CategoryDeleted::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'status',
        'parent_id'
    ];

    public function parent_category(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children_categories(){
        return $this->hasMany(Category::class, 'parent_id')->where('status',1);
    }
}

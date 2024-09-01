<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Category extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'category';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','slug'];
    public $incrementing = false;

    public function costume()
    {
        return $this->hasMany(Costume::class, 'category_id');
    }
}

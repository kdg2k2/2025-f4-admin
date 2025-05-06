<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentField extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function types()
    {
        return $this->hasMany(DocumentType::class, 'field_id');
    }
}

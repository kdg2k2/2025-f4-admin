<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentType extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function documents()
    {
        return $this->hasMany(Document::class, 'document_id');
    }

    public function field()
    {
        return $this->belongsTo(DocumentField::class, 'field_id');
    }
}

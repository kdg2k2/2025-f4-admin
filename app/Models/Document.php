<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(DocumentType::class, "type_id");
    }

    public function uploader()
    {
        return $this->belongsTo(Admin::class, "uploader_id");
    }

    public function images()
    {
        return $this->hasMany(DocumentImage::class, "document_id");
    }
}

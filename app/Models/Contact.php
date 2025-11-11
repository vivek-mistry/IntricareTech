<?php

namespace App\Models;

use App\Facades\FileUpload;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = ['name', 'email', 'phone', 'gender', 'profile_image', 'document_file', 'contact_custom_fields'];

    protected $casts = [
        'contact_custom_fields' => 'array',
    ];

    const FOLDER_NAME = 'contacts_images';

    public $appends = ['image_url', 'error_image'];

    /**
     * Interact with the name
     */
    protected function email(): Attribute
    {
        return Attribute::make(set: fn(string $value) => Str::lower($value));
    }

    /**
     * Interact with the name
     */
    protected function name(): Attribute
    {
        return Attribute::make(set: fn(string $value) => Str::title($value));
    }

    /**
     * Error Image
     */
    public function getErrorImageAttribute(): string
    {
        return asset('backend/images/users/avatar-1.jpg');
    }

    /**
     * IMAGE URL
     */
    public function getImageUrlAttribute(): string
    {
        return FileUpload::getURL(self::FOLDER_NAME . '/' . $this->profile_image);
    }
}

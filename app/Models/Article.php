<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const MEDIA_IMAGE = 'image';
    const MEDIA_DISK = 'public';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'published_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    protected $appends = ['image_url'];


    /**
     * Get the URL of the image of the article
     */
    public function getImageUrlAttribute(): ?string
    {
        $media = $this->getFirstMedia(self::MEDIA_IMAGE);
        
        if (!$media) {
            return null;
        }
        
        // getUrl() retourne une URL relative, on la convertit en URL absolue
        $url = $media->getUrl();
        
        // Si l'URL commence déjà par http:// ou https://, c'est déjà une URL absolue
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }
        
        // Sinon, on utilise asset() pour générer une URL absolue
        return asset($url);
    }

    /**
     * Register media collections for the model.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_IMAGE)
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->useDisk(self::MEDIA_DISK);
    }
}


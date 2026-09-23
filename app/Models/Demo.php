<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Surcouche éditable en back-office d'une démo déclarée dans
 * App\Http\Controllers\DemoController::registry().
 *
 * Seuls les éléments qui bougent réellement sont stockés ici (captures,
 * tarif, URL de la démo). Les textes marketing et la FAQ restent dans le
 * code : ajouter une démo reste un acte de développement.
 */
class Demo extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const MEDIA_SCREENSHOT_DESKTOP = 'screenshot_desktop';

    const MEDIA_SCREENSHOT_MOBILE = 'screenshot_mobile';

    const MEDIA_DISK = 'public';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'name',
        'price',
        'demo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'integer',
        ];
    }

    /**
     * Register media collections for the model.
     */
    public function registerMediaCollections(): void
    {
        foreach ([self::MEDIA_SCREENSHOT_DESKTOP, self::MEDIA_SCREENSHOT_MOBILE] as $collection) {
            $this->addMediaCollection($collection)
                ->singleFile()
                ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
                ->useDisk(self::MEDIA_DISK);
        }
    }

    /**
     * URL absolue de la capture d'écran d'une collection, ou null si aucune
     * image n'a été déposée en back-office.
     */
    public function getScreenshotUrl(string $collection): ?string
    {
        $media = $this->getFirstMedia($collection);

        if (! $media) {
            return null;
        }

        $url = $media->getUrl();

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }

        return asset($url);
    }
}

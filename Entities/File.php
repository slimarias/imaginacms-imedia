<?php

namespace Modules\Media\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Media\Helpers\FileHelper;
use Modules\Media\Image\Facade\Imagy;
use Modules\Media\ValueObjects\MediaPath;
use Modules\Tag\Contracts\TaggableInterface;
use Modules\Tag\Traits\TaggableTrait;
use Modules\User\Entities\Sentinel\User;

/**
 * Class File
 * @package Modules\Media\Entities
 * @property \Modules\Media\ValueObjects\MediaPath path
 */
class File extends Model implements TaggableInterface, Responsable
{
    use Translatable, NamespacedEntity, TaggableTrait;
    /**
     * All the different images types where thumbnails should be created
     * @var array
     */
    private $imageExtensions = ['jpg', 'png', 'jpeg', 'gif'];

    protected $table = 'media__files';
    public $translatedAttributes = ['description', 'alt_attribute', 'keywords'];
    protected $fillable = [
        'id',
        'is_folder',
        'description',
        'alt_attribute',
        'keywords',
        'filename',
        'path',
        'extension',
        'mimetype',
        'width',
        'height',
        'filesize',
        'folder_id',
    'created_by',
        'disk'
    ];
    protected $appends = ['path_string', 'media_type'];
  protected $casts = ['is_folder' => 'boolean'];
    protected static $entityNamespace = 'asgardcms/media';

    public function parent_folder()
    {
        return $this->belongsTo(__CLASS__, 'folder_id');
    }

    public function getPathAttribute($value)
    {
        $disk = is_null($this->disk)? config('asgard.media.config.filesystem') : $this->disk;
        return new MediaPath($value,$disk);
    }

    public function getPathStringAttribute()
    {
        return (string) $this->path;
    }

    public function getMediaTypeAttribute()
    {
        return FileHelper::getTypeByMimetype($this->mimetype);
    }

    public function isFolder(): bool
    {
        return $this->is_folder;
    }

    public function isImage()
    {
        return in_array(pathinfo($this->path, PATHINFO_EXTENSION), $this->imageExtensions);
    }

    public function getThumbnail($type)
    {
        if ($this->isImage() && $this->getKey()) {
            return Imagy::getThumbnail($this->path, $type, $this->disk);
        }

        return false;
    }

    /**
     * Create an HTTP response that represents the object.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return response()
            ->file(public_path($this->path->getRelativeUrl()), [
                'Content-Type' => $this->mimetype,
            ]);
    }

  /**
   * Created by relation
   * @return mixed
   */
  public function createdBy()
  {
    return $this->belongsTo(User::class, 'created_by');
  }
  /**
   * Created by relation
   * @return mixed
   */
  public function folder()
  {
    return $this->belongsTo(File::class, 'folder_id');
  }


}

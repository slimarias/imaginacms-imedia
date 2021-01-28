<?php

namespace Modules\Media\View\Components;

use Illuminate\View\Component;


class SingleImage extends Component
{
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public $src;
  public $alt;
  public $title;
  public $extension;
  public $url;
  public $extraLargeSrc;
  public $fallback;
  public $largeSrc;
  public $mediumSrc;
  public $smallSrc;
  public $imgClasses;
  public $width;

  public function __construct($src = '', $alt = '', $title = null, $url = null, $isMedia = false, $mediaFiles = null,
                              $zone = 'mainimage', $extraLargeSrc = null, $largeSrc = null, $mediumSrc = null,
                              $smallSrc = null, $fallback = null, $imgClasses = '', $width = "300px")
  {
    $this->src = $src;
    $this->alt = $alt;
    $this->title = $title;
    $this->url = $url;
    $this->imgClasses = $imgClasses;
    $this->width = $width;

    if (!empty($fallback)) {
      $this->extension = pathinfo($fallback, PATHINFO_EXTENSION);
      if ($this->extension == "jpg") $this->extension = "jpeg";
    }


    if($isMedia && !empty($mediaFiles)){
      $this->src = $mediaFiles->{$zone}->relativeExtraLargeThumb;
      $this->fallback = $mediaFiles->{$zone}->relativePath;
      $this->extraLargeSrc = $mediaFiles->{$zone}->relativeExtraLargeThumb;
      $this->largeSrc = $mediaFiles->{$zone}->relativeLargeThumb;
      $this->mediumSrc = $mediaFiles->{$zone}->relativeMediumThumb;
      $this->smallSrc = $mediaFiles->{$zone}->relativeSmallThumb;
    }else{
      $this->extraLargeSrc = $extraLargeSrc;
      $this->largeSrc = $largeSrc;
      $this->mediumSrc = $mediumSrc;
      $this->smallSrc = $smallSrc;
    }

  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return view('media::frontend.components.singleimage');
  }
}

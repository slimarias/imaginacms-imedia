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
    public $url;
    public $mediumSrc;
    public $smallSrc;
    public $allowedPictureSourceTypes;
    
    public function __construct( $src, $alt, $title = null, $url = null, $mediumSrc = null, $smallSrc = null)
    {
      $this->src = $src;
      $this->alt = $alt;
      $this->title = $title;
      $this->url = $url;
      $this->mediumSrc = $mediumSrc;
      $this->smallSrc = $smallSrc;
      $this->allowedPictureSourceTypes = config('asgard.media.config.allowed-picture-source-types');
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

<div class="bg-img d-flex justify-content-center align-items-center overflow-hidden">
  @if(!empty($url))
    <a href="{{$url}}" title="{{$title}}">
      @endif

        <picture>
          <!--[if IE 9]><video style="display: none;><![endif]-->
          @if(!empty($smallSrc))
          <source
            data-srcset="{{$smallSrc}}"
            media="--small" />
          @endif
  
          @if(!empty($mediumSrc))
          <source
            data-srcset="{{$mediumSrc}}"
            media="--medium" />
          @endif
          
          <source
            data-srcset="{{$src}}" />
          
           <!--[if IE 9]></video><![endif]-->
          <img
            data-src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVQYV2NgYAAAAAMAAWgmWQ0AAAAASUVORK5CYII="
            alt="{{$alt}}"
            class="lazyload"/>
        </picture>

      @if(!empty($url))
    </a>
  @endif
</div>


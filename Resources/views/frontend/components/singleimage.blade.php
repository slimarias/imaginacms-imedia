@if(!empty($url))
  <a href="{{$url}}" title="{{$title}}" class="w-100">
    @endif
  
        <img
        data-sizes="auto"
        data-src="{{$src}}"
          src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVQYV2NgYAAAAAMAAWgmWQ0AAAAASUVORK5CYII="
        alt="{{$alt}}"
        data-srcset=" @php echo (!empty($smallSrc) ? $smallSrc." 300w,": '') @endphp
        @php echo (!empty($mediumSrc) ? $mediumSrc." 600w," : '') @endphp
        @php echo (!empty($largeSrc) ? $largeSrc." 900w," : '') @endphp
        @php echo (!empty($extraLargeSrc) ? $extraLargeSrc." 1200w," : '') @endphp
          "
      class="lazyload img-fluid w-100 {{$imgClasses}}"/>
  
    @if(!empty($url))
  </a>
@endif



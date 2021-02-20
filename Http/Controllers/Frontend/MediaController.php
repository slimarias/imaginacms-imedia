<?php

namespace Modules\Media\Http\Controllers\Frontend;

use Illuminate\Routing\Controller;
use Intervention\Image\Facades\Image;
use Modules\Media\Repositories\FileRepository;
use Illuminate\Http\Request;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

class MediaController extends BaseApiController
{
    /**
     * @var FileRepository
     */
    private $file;

    public function __construct(FileRepository $file)
    {
        $this->file = $file;
    }
    
    
    /**
       * GET A ITEM
       *
       * @param $criteria
       * @return mixed
       */
      public function show($criteria,Request $request)
      {
        try {
          //Get Parameters from URL.
          $params = $this->getParamsRequest($request);
         
          $file = $this->file->findForVirtualPath($criteria,$params);
     
  
          //Break if no found item
          if(!$file) throw new Exception('Item not found',404);
          
          $type = $file->mimetype;
  
          $privateDisk = config('filesystems.disks.privatemedia');
          $path = $privateDisk["root"]. $file->path->getRelativeUrl();
  
          return response()->file($path, [
            'Content-Type' => $type,
          ]);
          
        } catch (\Exception $e) {

          return abort(404);
        }
        
        
      }
      
}

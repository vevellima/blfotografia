<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->loggedUser = Auth::user();
    }

    public function upload(Request $request)
    {
        $array = ['error' => ''];

        $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png'];

        $image = $request->file('photo');
        $service_id = $request->input('service_id');

        if ($image) {
            if (in_array($image->getClientMimeType(), $allowedTypes)) {
                $filename = md5(time() . rand(0, 9999)) . '.jpg';
                $destPath = public_path('/media/photos');

                $img = Image::make($image->path())
                    ->fit(1024, 680)
                    ->save($destPath . '/' . $filename);

                $photo = new Photo();
                $photo->service_id = $service_id;
                $photo->name = $filename;
                $photo->created_at = date('Y-m-d H:i:s', strtotime(now()));
                $photo->save();
            } else {
                $array['error'] = 'Arquivo não suportado!';
                return $array;
            }
        } else {
            $array['error'] = 'Arquivo não enviado';
            return $array;
        }

        return $array;
    }
}

<?php


namespace App\Http\Services;

use App\Http\Requests\CasesRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DashboardService
{
    public function checking_form(CasesRequest $request, $case)
    {
        if($request->full_form){
            $case->update($request->all());

            return response('', 200);
        }else{
            $case->update($request->all());
            return;
        }
    }

    public function checking_exist_image($item)
    {
        if($item->picture){
            Storage::disk('public')->delete('user_image/'.$item->picture);
            return false;
        }
        return true;
    }

    public function upload_image($image)
    {
        Storage::disk(
            'public')
            ->put('user_image/'.$image->getClientOriginalName(),
                File::get($image));
    }
}

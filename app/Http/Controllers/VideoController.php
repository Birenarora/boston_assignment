<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class VideoController extends Controller
{
    public function processVideo (Request $request) {
        $data = $request->all();

        $validator = Validator::make($data, [
            'video' => 'required|mimes:mp4'
        ]);

        $uploadsPath = 'uploads';
        $processedPath = 'processed';

        if ($validator->fails()) {
            $response = ['status' => 'Failed', 'statusCode' => 404, 'data' => $validator->errors()->messages(), 'message' => 'Error'];
        } else {
            if (!Storage::exists($uploadsPath) && !Storage::exists($processedPath)) {
                Storage::createDirectory($uploadsPath);
                Storage::createDirectory($processedPath);
            }

            $video = $request->file('video');
            $videoPath = $video->storeAs($uploadsPath, $video->getClientOriginalName(), 'local');
            
            FFMpeg::fromDisk('local')
                ->open($videoPath)
                ->addFilter(function ($filters) {
                    // $filters->custom('[in]colorchannelmixer=rr=0.3:rg=0.59:rb=0.11[out]');
                    $filters->custom('[in]colorchannelmixer=rr=0.3:rg=0.59:rb=0.11:gr=0.3:gg=0.59:gb=0.11:br=0.3:bg=0.59:bb=0.11[out]');
                })
                ->export()
                ->toDisk('local')
                ->inFormat(new \FFMpeg\Format\Video\X264)
                ->save($processedPath.'/'.$video->getClientOriginalName());

            $response = ['status' => 'Success', 'statusCode' => 200, 'data' => '', 'message' => 'Video Processed Successfully!'];
        }

        return response()->json($response);
    }
}

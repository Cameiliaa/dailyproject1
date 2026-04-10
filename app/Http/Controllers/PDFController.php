<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReadingProgress;

class PDFController extends Controller
{
    public function show($file_id)
    {
        $user_id = 1;

        $progress = ReadingProgress::where('user_id', $user_id)
                    ->where('file_id', $file_id)
                    ->first();

        $lastPage = $progress ? $progress->last_page : 1;

        return view('pdf_viewer', compact('file_id', 'lastPage'));
    }

    public function saveProgress(Request $request)
    {
        ReadingProgress::updateOrCreate(
            [
                'user_id' => 1,
                'file_id' => $request->file_id
            ],
            [
                'last_page' => $request->last_page
            ]
        );

        return response()->json(['status' => 'saved']);
    }
  public function getPDF($file_id)
{
    $url = "https://drive.google.com/uc?export=download&id=" . $file_id;

    $client = new \GuzzleHttp\Client();
    $response = $client->get($url);

    return response($response->getBody(), 200)
        ->header('Content-Type', 'application/pdf');
}
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\HTTPRequest;
use Illuminate\Http\Request;
use stdClass;


class HTTPController extends Controller
{
    private function generateID($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function uniqueID() {
        $found = 1;

        while ($found > 0) {
            $newID = $this->generateID();
            $found = HTTPRequest::where('request_id', $newID)->count();
        }

        return $newID;
    }

    public function get(Request $request)
    {
        $found= HTTPRequest::where('request_id', $request['request_id'])->first();
        
        return response()->json($found);
    }

    public function post(Request $request)    
    {
        
        $newID = $this->uniqueID();
        $new = new HTTPRequest();
        $new->request_id = $newID;
        $new->status_code = $request['statusCode'];
        $new->status_text = $request['statusText'];
        $new->errors = $request['errors'];
        $new->url = $request['url'];
        $new->request = $request['request'];
        $new->response = $request['response']; 
        $new->save();       
        
        $response = [
            'request_id' => $newID,
            'status' => '200 OK',
            'errors' => new stdClass(),
            'data' => [
                'url' => new stdClass(),
                'response' => new stdClass(),
                'request' => new stdClass()
            ]
        ];

        return response()->json($response);
    }

    public function put()
    {
        $data = [];

        return response()->json($data);
    }

    public function delete()
    {
        $data = [];

        return response()->json($data);
    }
}

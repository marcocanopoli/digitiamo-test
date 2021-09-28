<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\HTTPRequest;
use Illuminate\Http\Request;
use stdClass;


class HTTPController extends Controller
{
    private function generateID($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
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
        $found = HTTPRequest::where('request_id', $request->request_id)->first();
        
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
            'status' => '200 OK'
        ];

        return response()->json($response);
    }

    public function put(Request $request)
    {
        if($request->request_id) {
            $new = HTTPRequest::where('request_id', $request->request_id)->first();
            $new->request_id = $request->request_id;
        }else{
            $new = new HTTPRequest();
            $newID = $this->uniqueID();
            $new->request_id = $newID;
        }
        
        $new->status_code = $request['statusCode'];
        $new->status_text = $request['statusText'];
        $new->errors = $request['errors'];
        $new->url = $request['url'];
        $new->request = $request['request'];
        $new->response = $request['response']; 
        $new->save();       
        
        $response = [
            'request_id' => $new->requestID,
            'status' => '200 OK'
        ];

        return response()->json($response);
    }

    public function delete(Request $request)
    {   
        $response = [
            'status' => ''
        ];

        $found = HTTPRequest::where('request_id', $request['request_id'])->first();
        if($found) {
            $found->delete();
            $response['status'] = '200 OK';
        } else {
            $response['status'] = '404 Not Found';
        }
        
        return response()->json($response);
    }
}

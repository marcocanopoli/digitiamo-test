<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HTTPRequest extends Model
{
   protected $fillable = ['request_id', 'status_code', 'status_text', 'url', 'request', 'response'];
   protected $table = 'http_requests';
}

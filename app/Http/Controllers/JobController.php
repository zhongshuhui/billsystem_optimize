<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPodcast;
use App\Models\Podcast;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function start(){
        ProcessPodcast::dispatch();
        echo '分发任务完成';
    }
}

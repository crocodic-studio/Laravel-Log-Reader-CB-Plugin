<?php

namespace App\CBPlugins\LaravelLogReader\Controllers;

use Illuminate\Routing\Controller;
use Jackiedo\LogReader\LogReader;

class LaravelLogReaderController extends Controller
{

    protected $reader;

    public function __construct(LogReader $reader)
    {
        $this->reader = $reader;
    }

    public function getIndex() {
        $data = [];
        $data['page_title'] = "Laravel Log Reader";
        $data['result'] = $this->reader->orderBy("date","desc")->paginate(10,null,['path'=>'LaravelLogReader']);
        return view('LaravelLogReader::index',$data);
    }

    public function getClearLog()
    {
        $data = glob(storage_path("logs/*.log"));
        foreach($data as $log) {
            @unlink($log);
        }

        return cb()->redirectBack("Log files has been cleared!","success");
    }
}

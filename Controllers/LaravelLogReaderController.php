<?php

namespace App\CBPlugins\LaravelLogReader\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class LaravelLogReaderController extends Controller
{

    public function getIndex() {
        $data = [];
        $data['page_title'] = "Laravel Log Reader";
        $data['result'] = $this->logData();
        return view('LaravelLogReader::index',$data);
    }

    private function logData()
    {

        if($data = Cache::get("LaravelLogReader")) {
            return $data;
        }

        $data = glob(storage_path("logs/*.log"));
        usort( $data, function( $a, $b ) { return filemtime($a) - filemtime($b); } );
        @$logFile = $data[0];

        if($logFile) {
            $dataLog = [];
            if ($fh = fopen($logFile, 'r')) {

                $lineNumber = 0;
                $open = null;
                while (!feof($fh)) {
                    $line = fgets($fh);

                    if(substr($line,0,1)=="[") {
                        $description = trim(substr($line,28));
                        if($description) {
                            $dataLog[$lineNumber+1] = [
                                "description"=> $description,
                                "time"=> substr($line,1, 19),
                                "line"=> $lineNumber
                            ];
                            $open = $lineNumber+1;
                        }
                    }

                    if($open !== null && $open != "" && substr($line,0,1) == "#") {
                        if($open !== null) {
                            $dataLog[$open]["detail"][] = $line;
                        }

                        if(Str::contains($line,"[internal function]")) {
                            $open = null;
                        }
                    }

                    if(count($dataLog)>1000) {
                        break;
                    }
                    $lineNumber++;
                }
                fclose($fh);
            }

            $dataLog = collect($dataLog)->sortByDesc("time")->values()->all();

            Cache::put("LaravelLogReader", $dataLog,1);

            return $dataLog;
        }
        return [];
    }
}

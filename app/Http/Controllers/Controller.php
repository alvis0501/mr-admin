<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Write documents
     *
     * @param \PhpOffice\PhpWord\PhpWord $phpWord
     * @param string $filename
     * @param array $writers
     *
     * @return string
     */
    function write($phpWord, $filename, $writers)
    {
        $result = '';

        // Write documents
        foreach ($writers as $format => $extension) {
            $result .= date('H:i:s') . " Write to {$format} format";
            if (null !== $extension) {
                $targetFile = __DIR__ . "/results/{$filename}.{$extension}";
                $phpWord->save($targetFile, $format);
            } else {
                $result .= ' ... NOT DONE!';
            }
            $result .= EOL;
        }

        $result .= getEndingNotes($writers);

        return $result;
    }

    /**
     * Get ending notes
     *
     * @param array $writers
     *
     * @return string
     */
    function getEndingNotes($writers)
    {
        $result = '';

        // Do not show execution time for index
        if (!IS_INDEX) {
            $result .= date('H:i:s') . " Done writing file(s)" . EOL;
            $result .= date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB" . EOL;
        }

        // Return
        if (CLI) {
            $result .= 'The results are stored in the "results" subdirectory.' . EOL;
        } else {
            if (!IS_INDEX) {
                $types = array_values($writers);
                $result .= '<p>&nbsp;</p>';
                $result .= '<p>Results: ';
                foreach ($types as $type) {
                    if (!is_null($type)) {
                        $resultFile = 'results/' . SCRIPT_FILENAME . '.' . $type;
                        if (file_exists($resultFile)) {
                            $result .= "<a href='{$resultFile}' class='btn btn-primary'>{$type}</a> ";
                        }
                    }
                }
                $result .= '</p>';
            }
        }

        return $result;
    }

    /**
     * @param string $msg
     * @param string $param
     * @return array
     */
    protected function configSuccessArray($msg = "", $param = "")
    {
        return ["type" => "ok", "msg" => $msg, "param" => $param];
    }

    /**
     * @param string $msg
     * @param string $param
     * @return array
     *
     */
    protected function configFailArray($msg = "", $param = "")
    {
        return ["type" => "fail", "msg" => $msg, "param" => $param];
    }

    public function getUserId()
    {
        return session()->get(SESSION_UID);
    }

    public function is_url($uri){
        if(preg_match( '/^(http|https):\\/\\/[a-z0-9]+([\\-\\.]{1}[a-z0-9]+)*\\.[a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' , $uri)){
            return false;
        }
        else{
            return true;
        }
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    /**
     * @param $data
     * @param $total
     * @return array
     *
     */
    public function dataTableFormat($data, $total)
    {
        if(count($data) > 0)
        {
            $start = request('start');

            $i = 1;
            if(is_array($data[0]))
            {
                foreach ($data as &$one)
                {
                    $one["no"] = $start + $i;
                    $i++;
                }
            }
            else
            {
                foreach ($data as &$one)
                {
                    $one->no = $start + $i;
                    $i++;
                }
            }
        }

        $result = array(
            "data" => $data,
            "draw" => request("draw") + 1,
            "recordsFiltered" => $total,
            "recordsTotal" => $total
        );

        return $result;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getDataTableParams(Request $request)
    {
        $search_key = $request->get("search")["value"];
        $search_column = $request->get("aoSearchCols");
        $temp_sort = $request->get("order");
        $sort_num = $temp_sort[0]["column"];
        $sort_dir = $temp_sort[0]["dir"];
        $sort_col_name = $request->get("columns")[$sort_num]["name"];
        $start_val = $request->get("start");
        $length_val = $request->get("length");


        $dt_data = array();
        $dt_data["search_key"] = $search_key;
        $dt_data["search_column"] = $search_column;
        $dt_data["sort_col_num"] = $sort_num;
        $dt_data["sort_col"] = $sort_col_name;
        $dt_data["sort_direction"] = $sort_dir;
        $dt_data["start"] = $start_val;
        $dt_data["length"] = $length_val;

        return $dt_data;
    }


}

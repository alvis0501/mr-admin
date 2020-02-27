<?php
/**
 * Created by PhpStorm.
 * User: BlueSky
 * Date: 2018-02-18
 * Time: 06:27 PM
 */

namespace App\Model;


use Illuminate\Support\Facades\DB;

class DataModel extends BaseModel
{

    public function getData() {
        return DB::table('t_data')
            ->orderBy('id', 'desc')
            ->first();
    }

    public function insertData($app_name, $link, $notification, $about_us, $contact_us) {

        DB::table('t_data')
            ->insertGetId(
                [
                    'app_name' => $app_name,
                    'link' => $link,
                    'notification' => $notification,
                    'about_us' => $about_us,
                    'contact_us' => $contact_us
                ]
            );

    }

}
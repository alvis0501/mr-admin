<?php
/**
 * Created by PhpStorm.
 * User: BlueSky
 * Date: 2018-02-18
 * Time: 06:27 PM
 */

namespace App\Http\Controllers;


use App\Model\DataModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataController extends Controller
{

    public function index() {

        $dataModel = new DataModel();
        $data = $dataModel->getData();

        if ($this->getUserId() == null) {
            return redirect('login');
        } else {
            if ($data == null) {
                return view('index',
                    [
                        'app_name' => '',
                        'notification' => '',
                        'link' => '',
                        'about_us' => '',
                        'contact_us' => ''
                    ]);
            } else {
                return view('index',
                    [
                        'app_name' => $data->app_name,
                        'notification' =>$data->notification,
                        'link' => $data->link,
                        'about_us' => $data->about_us,
                        'contact_us' => $data->contact_us
                    ]);
            }

        }

    }

    public function setData() {

        $app_name = request('app_name');
        $link = request('link');
        $notification = request('notification');
        $about_us = request('about_us');
        $contact_us = request('contact_us');

        if ($app_name == null || $app_name == '' ||
            $link == null || $link == '' ||
            $notification == null || $notification == '' ||
            $about_us == null || $about_us == '' ||
            $contact_us == null || $contact_us == '')
        {
            return response()->json($this->configFailArray('Parameter invalid'));
        }

        $data = new DataModel();
        $data->insertData($app_name, $link, $notification, $about_us, $contact_us);

        $apiKey = "AAAA1UzvOes:APA91bFgjfUOTcN8asAdp4TEUqYoCvjEjXzCgFOqq2DQ6C8s28f8_wwGgclxMfwoBpB7EXocDW-DGo_tQVf3wTMid_1lKXcYMTd1gQAjxqJ5JqYdqUYJIUkq4kzTR-HKXgJOsj6-UHTj";
        $token = "/topics/mr-notification";
        //$token = "cXZ8nEcdYs4:APA91bHR59CoIm-KHVEzIO1NPhZ8YRTVqd-rmSNX2h-MRf2bB6nL9iauNEF_zfhFwf-lSf3y09YL27ED0F243EvZVTwwKwv8nbtp3O-ZaKHVTFFs54KXKT9XluJspITiCo8P7P7mWEu3";
        $shell = 'curl -X POST --header "Authorization: key='.$apiKey.'" --header "Content-Type: application/json" https://fcm.googleapis.com/fcm/send -d "{\"to\":\"'.$token.'\",\"priority\":\"high\",\"notification\":{\"body\": \"'.stripslashes($notification).'\"},\"data\":{\"title\":\"'.stripslashes($app_name).'\",\"message\":\"'.stripslashes($notification).'\"}}"';
        
        shell_exec($shell);

        return response()->json($this->configSuccessArray('Data saved successfully'));
    }

    public function getData() {

        /*$header = $request->header('Authorization');

        if (base64_decode($header) != 'bluesky123456') {
            return response()->json(
                [
                    'data' => [],
                    'status' => false,
                    'message' => 'Header info not match.'
                ]
            );
        }*/

        $dataModel = new DataModel();
        $data = $dataModel->getData();

        return response()->json(
            [
                'data' => $data,
                'status' => true,
                'message' => ''
            ]
        );

    }

}
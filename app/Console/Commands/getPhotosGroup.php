<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
ini_set('max_execution_time', 6000);

class getPhotosGroup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getPhotosGroup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command getPhotosGroup';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $s = microtime(true);
        $e = microtime(true);
        $this->info(Carbon::now() .'. START JOB: ' . round($e - $s, 2) . " Sec");
        $id_group = '1173636692750000';
        $token = env('TOKEN_FB');
        $url = 'https://graph.facebook.com/'. $id_group .'?fields=feed.limit(300){id,from,message,link,type,full_picture}&access_token=' . $token;
        $client = new Client([
            'base_uri' => '',
            // 'timeout'  => 2.0,
        ]);
        $flag = true;
        $flag_2 = true;
        $i = 1;
        while (true) {
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody()->getContents());
            if ($flag == true) {
                $datas = $data->feed;
                $flag = false;
            } else {
                $datas = $data;
            }
            if (count($datas->data) == 0) {break;}
            $e = microtime(true);
            $this->info("START LOAD: " . $i . '. Time:  '. round($e - $s, 2) . " Sec");
            foreach ($datas->data as $data) {
                if ($data->type == 'photo' && isset($data->message)) {
                    if ($flag_2 == true) {
                        $num_row = DB::table('photos')->count();
                        if ($num_row > 0) {
                            DB::table('photos')->delete();
                        }
                        $flag_2 = false;
                    }
                    $value = [
                        'id_image' => $data->id,
                        'id_fb' => $data->from->id,
                        'name_fb' => $data->from->name,
                        'message' => $data->message,
                        'link' => $data->link,
                        'type' => $data->type,
                        'full_picture' => $data->full_picture,
                        'updated_time' => $data->updated_time,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                    DB::table('photos')->insertGetId($value);
                }
            }
            $e = microtime(true);
            $this->info("END LOAD: " . $i . '. Time:  '. round($e - $s, 2) . " Sec");
            $i++;
            if (!empty($datas->paging->next)) {
                $url = $datas->paging->next;
            } else {
                break;
            }
        }
        $e = microtime(true);
        $this->info(Carbon::now() .'. END JOB: ' . round($e - $s, 2) . " Sec");
    }
}

<?php

namespace App\Console\Commands;

use App\Models\NameDays;
use Illuminate\Console\Command;

class NameDaysUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'name-days:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update name days';

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
     * @return int
     */
    public function handle()
    {
        $url = 'https://raw.githubusercontent.com/zoltancsontos/slovak-name-days-json/master/slovak-nameday-list-shorter.json';
        $json = file_get_contents($url);
        $all_names = json_decode($json, true);
        if (!$all_names) {
            throw new \Exception('name days source not found!');
        }
        $data = [];
        foreach($all_names as $month => $month_names) {
            foreach($month_names as $day => $name) {
                $nameDay = new \DateTime();
                $nameDay->setDate(1972, $month+1, $day); // 1972 ma prvy prestupny rok den 1972-02-29
                $data[] = [
                    'name_day' => $nameDay,
                    'name' => $name,
                ];
            }
        }
        if (!$data) {
            throw new \Exception('name days not found!');
        }
        NameDays::truncate();
        if (!NameDays::insert($data)) {
            throw new \Exception('name days not inserted!');
        }
        $this->comment('done');
        return 0;
    }
}

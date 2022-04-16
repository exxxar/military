<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class AnnounceQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send message to users';

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
        ini_set('memory_limit', '2560M');
        ini_set('max_execution_time', 16200);


        $users = \App\Models\User::query()->get();
        $announceQueues = \App\Models\AnnounceQueue::query()
            ->whereNull("sent_at")
            ->get();

        if (empty($announceQueues))
            return 0;


        foreach ($announceQueues as $announceQueue) {

            if (Carbon::parse($announceQueue->need_send_at)->timestamp>Carbon::now("+3:00")->timestamp)
                continue;

            $announceQueue->sent_at = Carbon::now("+3:00");
            $announceQueue->save();
            
            foreach ($users as $user) {

                $images = $announceQueue->images ?? [];

                if (empty($images))
                    \App\Facades\MilitaryServiceFacade::bot()
                        ->sendMessage($user->telegram_chat_id,
                            "<b>" . $announceQueue->title . "</b>\n" .
                            $announceQueue->text
                        );
                else
                    \App\Facades\MilitaryServiceFacade::bot()
                        ->sendPhoto($user->telegram_chat_id,
                            "<b>" . $announceQueue->title . "</b>\n" .
                            $announceQueue->text,
                            $images[0]
                        );

            }


        }

        return 0;
    }
}

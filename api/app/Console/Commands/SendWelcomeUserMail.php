<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendWelcomeUserMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:welcomeUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'E-mail de boas vindas para os usuários quando se registram.';

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
        return 0;
    }
}

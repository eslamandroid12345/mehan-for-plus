<?php

namespace App\Console\Commands;

use App\Repository\AdRepositoryInterface;
use Illuminate\Console\Command;

class EndExpiredAds extends Command
{
    private AdRepositoryInterface $adRepository;
    public function __construct(
        AdRepositoryInterface $adRepository,
    )
    {
        parent::__construct();
        $this->adRepository = $adRepository;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'end:ads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'End all expired ads.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return $this->adRepository->endExpiredAds();
    }
}

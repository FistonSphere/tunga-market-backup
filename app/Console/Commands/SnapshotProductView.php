<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\ProductViewSnapshot;
use Carbon\Carbon;


class SnapshotProductViews extends Command
{
    protected $signature = 'snapshot:product-views';
    protected $description = 'Take a snapshot of product views_count for trending calculations';

    public function handle()
    {
        $now = Carbon::now();
        Product::select('id', 'views_count')->chunk(200, function ($products) use ($now) {
            $inserts = [];
            foreach ($products as $p) {
                $inserts[] = [
                    'product_id'  => $p->id,
                    'views_count' => $p->views_count ?? 0,
                    'recorded_at' => $now,
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ];
            }
            if (!empty($inserts)) {
                ProductViewSnapshot::insert($inserts);
            }
        });

        $this->info('Product view snapshots saved at ' . $now);
        return 0;
    }
}

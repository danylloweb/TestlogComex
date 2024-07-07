<?php

namespace Database\Seeders;

use App\Entities\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $totalProducts = 4000;
        $output        = new ConsoleOutput();
        $progress      = new ProgressBar($output, $totalProducts);
        $progress->start();
        for ($i = 1; $i < $totalProducts ; $i++) {
            $progress->advance();
            Product::create([
                'name'        => 'Produto ' . $i,
                'description' => 'Descrição ' . $i . ' do produto '. Str::random(5). ' lorem ipsum dolor sit amet',
                'price'       => mt_rand (10.00 * 10, 105.00 * 10) / 10,
                'status'      => $i % 2 === 0 ? 1 : 0,
                'warranty'    => $i > 1500 ? 2 : ($i % 2 === 0 ? 1 : 0),
                'type'        => $i % 2 === 0 ? 'Novo' : 'Seminovo',
            ]);
        }
        $progress->finish();
    }
}

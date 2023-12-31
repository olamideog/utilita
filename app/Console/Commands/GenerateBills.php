<?php

namespace App\Console\Commands;

use App\Enums\PaymentStatus;
use App\Enums\ReconciliationStatus;
use App\Models\Bill;
use App\Models\BillItem;
use App\Models\User;
use Illuminate\Console\Command;

class GenerateBills extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'utilita:generate-bills';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To generate bills for all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::whereHas('meter')->get();
        foreach ($users as $user) {
            $meter = $user->meter;
            $readings = $meter->readings()->where('status', ReconciliationStatus::PENDING)->get();
            if (($readings != null) && ($readings->count() > 0)) {
                $bill = new Bill();
                $bill['meter_id'] = $meter->id;
                $bill['status'] = PaymentStatus::DEFAULT->value;
                $bill->save();

                $total = 0;
                $usage = 0;

                foreach ($readings as $reading) {
                    $amount = $reading->rate * $reading->reading;
                    $total += $amount;
                    $usage += $reading->reading;
                    BillItem::create([
                        'bill_id' => $bill->id,
                        'meter_reading_id' => $reading->id,
                        'amount' => $amount,
                    ]);

                    $reading->status = ReconciliationStatus::RESOLVED;
                    $reading->save();
                }

                $bill['total'] = $total;
                $bill['usage'] = $usage;
                $bill->save();
            }
            $this->info('Bill Generated for '.$user->first_name.' '.$user->last_name);
        }
    }
}

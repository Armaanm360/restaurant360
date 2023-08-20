<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function createAndDownloadBackup()
    {
        // Create a database backup using Laravel's built-in command
        Artisan::call('backup:run');

        // Get the path to the latest backup file
        $backupPath = storage_path('app' . DIRECTORY_SEPARATOR . 'backups' . DIRECTORY_SEPARATOR . Artisan::output());

        // Download the backup file
        return Storage::download($backupPath);
    }


    public function newMyEvent()
    {

        $responseData = [
            "success" => true,
            "message" => "Successfully Done",
            "data" => [
                [
                    "order_id" => 7,
                    "order_status" => "PENDING",
                    "invoice_no" => 5590973,
                    "food_items" => [
                        [
                            "item" => "Soup",
                            "quantity" => 1
                        ],
                        [
                            "item" => "Fish Fry",
                            "quantity" => 33
                        ]
                    ]
                ],
                [
                    "order_id" => 8,
                    "order_status" => "FINISHED",
                    "invoice_no" => 5590973,
                    "food_items" => [
                        [
                            "item" => "Fried Chicken",
                            "quantity" => 321
                        ],
                        [
                            "item" => "Soup",
                            "quantity" => 41
                        ],
                        [
                            "item" => "Fish Fry",
                            "quantity" => 33
                        ]
                    ]
                ]
            ]
        ];

        event(new MyEvent($responseData));
    }
}

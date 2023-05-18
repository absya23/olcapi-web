<?php

namespace App\Logging;

use Illuminate\Support\Facades\DB;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class DatabaseLogger extends AbstractProcessingHandler
{
    protected function write(array $record): void
    {
        DB::table('logs')->insert([
            'channel' => $record['channel'],
            'message' => $record['message'],
            'context' => json_encode($record['context']),
            'level' => $record['level'],
            'level_name' => $record['level_name'],
            'extra' => json_encode($record['extra']),
            'created_at' => $record['datetime']->format('Y-m-d H:i:s'),
        ]);
    }
}

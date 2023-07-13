<?php
namespace App\Logging;
// use Illuminate\Log\Logger;
use App\Models\ActionLogs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
class MySQLLoggingHandler extends AbstractProcessingHandler{

    /**
     *
     * Reference:
     * https://github.com/markhilton/monolog-mysql/blob/master/src/Logger/Monolog/Handler/MysqlHandler.php
     */
    public function __construct($level = Logger::DEBUG, $bubble = true) {
        $this->connection = 'mysql';
        $this->table = 'action_logs';
        parent::__construct($level, $bubble);
    }
    protected function write(array $record):void
    {
//         dd($record);
        $data = array(
            'user_id'       => Auth::user()->id,
            'status'       => Auth::user()->status,
            'message'       => $record['message'],
//            'context'       => json_encode($record['context'],JSON_UNESCAPED_UNICODE),
            'formatted'     => $record['formatted'],
//            'remote_addr'   => $_SERVER['REMOTE_ADDR'],
            'remote_addr'   => $_SERVER['PATH_INFO'] ?? $_SERVER['REQUEST_URI'] ,
            'user_agent'    => $_SERVER['HTTP_USER_AGENT'],
            'level'         => $record['level'],
            'level_name'    => $record['level_name'],
            'channel'       => $record['channel'],
            'extra'         => json_encode($record['extra']),
            'record_datetime' => $record['datetime']->format('Y-m-d H:i:s'),
        );
//        DB::connection()->table($this->table)->insert($data);
            ActionLogs::create($data);
    }
}

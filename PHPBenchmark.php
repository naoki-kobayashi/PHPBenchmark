<?
date_default_timezone_set('Asia/Tokyo');
require "./vendor/autoload.php";

class CreateTimestamp
{
    public function exec()
    {
        $testCase1 = new Ubench;
        $testCase1->start();
        $this->repeat(function() {
            $timestamp = strtotime("2015-06-09 12:00:00");
        });
        $testCase1->end();

        echo "\n";

        $testCase2 = new Ubench;
        $testCase2->start();
        $this->repeat(function() {
            $date = new DateTime("2015-06-09 12:00:00");
            $timestamp = $date->getTimestamp();
        });
        $testCase2->end();
        
        echo "*** compare create time stmap ***\n";
        echo 'time:strtotime():'.$testCase1->getTime();
        echo "\n";
        echo 'memory:strtotime():'.$testCase1->getMemoryPeak();
        echo "\n";
        echo 'time:DateTime->getTimestamp():'.$testCase2->getTime();
        echo "\n";
        echo 'memory:DateTime->getTimestamp():'.$testCase2->getMemoryPeak();
        echo "\n";
    }

    private function repeat($callback)
    {
        for($i=0 ; $i<10000 ; $i++){
            call_user_func($callback);
        }
    }
}

class CompareTimestamp
{
    public function exec()
    {
        $testCase1 = new Ubench;
        $testCase1->start();
        $this->repeat(function() {
            $timestamp1 = strtotime("2015-06-09 12:00:00");
            $timestamp2 = strtotime("2015-06-10 12:00:00");
            return $timestamp1 < $timestamp2;
        });
        $testCase1->end();

        echo "\n";

        $testCase2 = new Ubench;
        $testCase2->start();
        $this->repeat(function() {
            $date1 = new DateTime("2015-06-09 12:00:00");
            $date2 = new DateTime("2015-06-10 12:00:00");
            return $date1 < $date2;
        });
        $testCase2->end();
        
        echo "*** compare create time stmap ***\n";
        echo 'time:strtotime():'.$testCase1->getTime();
        echo "\n";
        echo 'memory:strtotime():'.$testCase1->getMemoryPeak();
        echo "\n";
        echo 'time:DateTime->getTimestamp():'.$testCase2->getTime();
        echo "\n";
        echo 'memory:DateTime->getTimestamp():'.$testCase2->getMemoryPeak();
        echo "\n";
    }

    private function repeat($callback)
    {
        for($i=0 ; $i<10000 ; $i++){
            call_user_func($callback);
        }
    }
}


$createTimestamp = new CreateTimestamp;
$createTimestamp->exec();
$compareTimestamp = new CompareTimestamp;
$compareTimestamp->exec();

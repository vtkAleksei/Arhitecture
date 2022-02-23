<?php

class Job
{
    public $name;
    public $language;


    public function __construct($name, $language)
    {
        $this->name = $name;
        $this->language = $language;
    }
}

class DeveloperObserver
{
    private $name;
    public $language;

    public function __construct($name, $language)
    {
        $this->name = $name;
        $this->language = $language;
    }


    public function update(SplSubject $subject)
    {
        echo "Оповестить $this->name $this->language подписчика о новой вакансии " .
            $subject->lastAddedJob->name . PHP_EOL;
    }
}

trait TSingletone
{
    private static $instance;
    private function __construct()
    {
    }
    private function __clone()
    {
    }
    private function __wakeup()
    {
    }
    public static function getInstance()
    {
        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new self();
    }
}

class DeveloperJobs
{
    use TSingletone;

    private $jobs;
    private $observers;
    public $lastAddedJob;



    public function attach(SplObserver $observer)
    {
        $this->observers[$observer->language][] = $observer;
    }

    public function detach(SplObserver $observer)
    {
        foreach ($this->observers[$observer->language] as $key => $value) {
            if ($value === $observer) {
                unset($this->observers[$observer->language][$key]);
                return;
            }
        }
    }

    public function notify()
    {
        $data = $this->lastAddedJob;
        if (!isset($data)) {
            echo 'Error';
            return;
        }
        foreach ($this->observers[$data->language] as $observer) {
            $observer->update($this);
        }
    }
    public function addJob(Job $job)
    {
        $this->jobs[$job->language][] = $job;
        $this->lastAddedJob = $job;
        $this->notify();
    }
}

spl_autoload_register(function ($classname) {
    require_once $classname . '.php';
});

$subject = DeveloperJobs::getInstance();
$newJob = new Job('Google', 'PHP');
$php1 = new DeveloperObserver('User1', 'PHP');

$java1 = new DeveloperObserver('User2', 'Java');
$newJavaJob = new Job('Yandex', 'Java');
$subject->attach($php1);
$subject->addJob($newJob);
echo '<br>' . PHP_EOL;
$subject->attach($java1);
$subject->addJob($newJavaJob);

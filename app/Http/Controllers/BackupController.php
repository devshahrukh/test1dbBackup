<?php

namespace App\Http\Controllers;

class BackupController extends Controller
{
    protected $databaseArray;
    protected $dumpPath;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->databaseArray[] = config('database.connections.mysql.database');
        $this->databaseArray[] = config('database.connections.mysql1.database');
        $this->databaseArray[] = config('database.connections.mysql2.database');
        $this->databaseArray[] = config('database.connections.mysql3.database');
        $this->dumpPath        = storage_path('app/public/' . time() . 'backup.sql');
        $this->username        = config('database.connections.mysql.username');
        $this->password        = config('database.connections.mysql.password');
    }
    public function index()
    {
        $databases = $this->databaseArray[0] .' '. $this->databaseArray[1] .' '. $this->databaseArray[2] .' '. $this->databaseArray[3];
        `mysqldump -u$this->username -p$this->password --databases $databases > $this->dumpPath`;
        return 'The backup has been proceed successfully.';
    }
}

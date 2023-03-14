<?php
    require __DIR__.'/vendor/autoload.php';

    use Kreait\Firebase\Factory;
    use Kreait\Firebase\Contract\Storage;
    
    $factory = (new Factory)
        ->withServiceAccount(__DIR__.'/bustransitsystem-241e3-firebase-adminsdk-n47oj-c0c9f21b78.json')
        ->withDatabaseUri('https://bustransitsystem-241e3-default-rtdb.asia-southeast1.firebasedatabase.app/');

    $database = $factory->createDatabase();
    $auth = $factory->createAuth();  
    $storage = $factory->createStorage();
?>
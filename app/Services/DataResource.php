<?php

namespace App\Services;

interface DataResource {

    public function setURL();
    
    public function setAPIKey();

    public function fetchData();

}

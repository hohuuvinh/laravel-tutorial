<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendWelcomeEmail;
use Carbon\Carbon;

class JobController extends Controller
{
    /**
     * Handle Queue Process
     */
    public function processQueue()
    {	
    	// for ($i = 0; $i < 2; $i++) {
    		$emailJob = new SendWelcomeEmail();
    		dispatch($emailJob);
    	// }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function message($isSuccess, $successMessage, $failedMessage)
    {
        if ($isSuccess) {
            Session::flash('success', $successMessage);
        } else {
            Session::flash('failed', $failedMessage);
        }
    }
}

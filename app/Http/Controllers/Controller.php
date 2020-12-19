<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use IsaEken\PluginSystem\PluginSystem;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var PluginSystem $pluginSystem
     */
    public PluginSystem $pluginSystem;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->pluginSystem = new PluginSystem;
        $this->pluginSystem->autoload(base_path('plugins'));
    }
}

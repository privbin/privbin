<?php

namespace App\Http\Controllers;

use App\Models\ContentType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $highlighters = ContentType::highlighters($this->pluginSystem);
        return response()->view('web.home.index', compact('highlighters'));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function dashboard(Request $request): Response
    {
        return response()->view('web.home.dashboard');
    }
}

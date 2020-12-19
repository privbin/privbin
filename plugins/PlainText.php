<?php

use Illuminate\Http\Request;
use \IsaEken\PluginSystem\Plugin;

class PlainText extends Plugin
{
    /**
     * @var string $author
     */
    protected string $author = 'İsa Eken';

    /**
     * @var string $name
     */
    protected string $name = 'Plain Text';

    /**
     * @var string $version
     */
    protected string $version = 'v1.0';

    /**
     * @var string $description
     */
    protected string $description = 'Plain text plugin for privbin.';

    /**
     * @var string $compilerName
     */
    public string $compilerName = 'plain_text';

    /**
     * Returns plain text
     *
     * @param Request $request
     * @param string $text
     * @return string
     */
    public static function compile(Request $request, string $text): string
    {
        return '<pre><code>'.$text.'</code></pre>';
    }
}

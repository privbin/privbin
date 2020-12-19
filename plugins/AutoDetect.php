<?php

use \IsaEken\PluginSystem\Plugin;

class AutoDetect extends Plugin
{
    /**
     * @var string $author
     */
    protected string $author = 'İsa Eken';

    /**
     * @var string $name
     */
    protected string $name = 'Auto Detect';

    /**
     * @var string $version
     */
    protected string $version = 'v1.0';

    /**
     * @var string $description
     */
    protected string $description = 'Auto language detect and highlight plugin for privbin.';

    /**
     * @var string $compilerName
     */
    public string $compilerName = 'auto_detect';

    /**
     * Compile text to markdown
     *
     * @param string $text
     * @return string
     */
    public static function compile(string $text): string
    {
        $highlighter = new \Highlight\Highlighter;
        try {
            return '<pre><code>'.($highlighter->highlightAuto($text)->value).'</code></pre>';
        }
        catch (Exception $exception) {
            return '<pre><code>'.$text.'</code></pre>';
        }
    }
}

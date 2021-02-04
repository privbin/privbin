<?php

use App\Interfaces\HighlighterPluginInterface;
use Illuminate\Http\Request;
use \IsaEken\PluginSystem\Plugin;

class PlainTextHighlighter extends Plugin implements HighlighterPluginInterface
{
    /**
     * Plugin unique name.
     *
     * @return string
     */
    public static function getName() : string
    {
        return "privbin/plain_text";
    }

    /**
     * Plugin version.
     *
     * @return string
     */
    public static function getVersion() : string
    {
        return "v1.1";
    }

    /**
     * Plugin description.
     *
     * @return string
     */
    public static function getDescription() : string
    {
        return "Returns text to clean html.";
    }

    /**
     * Plugin author.
     *
     * @return string
     */
    public static function getAuthor() : string
    {
        return "İsa Eken";
    }

    /**
     * Convert text to highlighted text.
     *
     * @param string $text
     * @param Request|null $request
     * @return string
     */
    public static function convert(string $text, Request $request = null) : string
    {
        return "<pre class=\"p-2\"><code>$text</code></pre>";
    }
}

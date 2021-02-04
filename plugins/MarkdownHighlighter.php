<?php

use App\Interfaces\HighlighterPluginInterface;
use Illuminate\Http\Request;
use \IsaEken\PluginSystem\Plugin;
use \League\CommonMark\CommonMarkConverter;

class MarkdownHighlighter extends Plugin implements HighlighterPluginInterface
{
    /**
     * Plugin unique name.
     *
     * @return string
     */
    public static function getName(): string
    {
        return "privbin/markdown";
    }

    /**
     * Plugin version.
     *
     * @return string
     */
    public static function getVersion(): string
    {
        return "v1.1";
    }

    /**
     * Plugin description.
     *
     * @return string
     */
    public static function getDescription(): string
    {
        return "Markdown highlighter";
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
        $commonMarkConverter = new CommonMarkConverter([
            'html_input' => 'escape',
            'allow_unsafe_links' => false,
            'max_nesting_level' => 25,
        ]);
        return '<div class="p-2" style="font-family: sans-serif">'.$commonMarkConverter->convertToHtml($text).'</pre>';
    }
}

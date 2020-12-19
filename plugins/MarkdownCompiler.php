<?php

use Illuminate\Http\Request;
use \IsaEken\PluginSystem\Plugin;
use \League\CommonMark\CommonMarkConverter;

class MarkdownCompiler extends Plugin
{
    /**
     * @var string $author
     */
    protected string $author = 'İsa Eken';

    /**
     * @var string $name
     */
    protected string $name = 'Markdown Compiler';

    /**
     * @var string $version
     */
    protected string $version = 'v1.0';

    /**
     * @var string $description
     */
    protected string $description = 'Markdown compiler plugin for privbin.';

    /**
     * @var string $compilerName
     */
    public string $compilerName = 'markdown';

    /**
     * Compile text to markdown
     *
     * @param Request $request
     * @param string $text
     * @return string
     */
    public static function compile(Request $request, string $text): string
    {
        $commonMarkConverter = new CommonMarkConverter([
            'html_input' => 'escape',
            'allow_unsafe_links' => false,
            'max_nesting_level' => 25,
        ]);
        return $commonMarkConverter->convertToHtml($text);
    }
}

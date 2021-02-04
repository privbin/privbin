<?php

use App\Interfaces\HighlighterPluginInterface;
use Highlight\Highlighter;
use Illuminate\Http\Request;
use \IsaEken\PluginSystem\Plugin;
use function HighlightUtilities\splitCodeIntoArray;

class AutoDetectHighlighter extends Plugin implements HighlighterPluginInterface
{
    /**
     * Plugin unique name.
     *
     * @return string
     */
    public static function getName(): string
    {
        return "privbin/auto_detect";
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
        return "Auto highlighter";
    }

    /**
     * Plugin author.
     *
     * @return string
     */
    public static function getAuthor(): string
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
    public static function convert(string $text, Request $request = null): string
    {
        $highlightedLine = null;
        $highlighter = new Highlighter;

        if ($request->has('highlight')) {
            $highlightedLine = (int) $request->get("highlight");
        }

        try {
            $highlighted = $highlighter->highlightAuto($text);
            $lines = splitCodeIntoArray($highlighted->value);

            $response = '<table>';
            $response.= '<tbody>';

            foreach ($lines as $number => $line) {
                $response.= '<tr class="'.($highlightedLine === $number ? 'highlighted' : '').'">';
                $response.= "<td id=\"L{$number}\" data-line-number=\"{$number}\"></td>";
                $response.= "<td id=\"LC{$number}\" class=\"blob-code\"><pre><code>{$line}</code></pre></td>";
                $response.= '</tr>';
            }
            $response.= '</tbody>';
            $response.= '</table>';

            return $response;
        }
        catch (Exception $exception) {
            return "<pre><code>$text</code></pre>";
        }
    }
}

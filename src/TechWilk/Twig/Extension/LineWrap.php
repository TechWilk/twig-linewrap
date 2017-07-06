<?php

namespace TechWilk\Twig\Extension;

use Twig_Environment;
use Twig_SimpleFilter;

class LineWrap extends \Twig_Extension
{

    // based on Twig-extensions\Text\WordWrap (https://github.com/twigphp/Twig-extensions)
    function lineWrap(Twig_Environment $env, $value, $length = 80, $separator = "\n")
    {
        $shortenedLines = [];

        $previous = mb_regex_encoding();
        mb_regex_encoding($env->getCharset());

        $lines = mb_split("\n", $value);
        mb_regex_encoding($previous);

        foreach ($lines as $line) {
            $shortenedLine = '';
            while (mb_strlen($line, $env->getCharset()) > $length) {
                $shortenedLine .= mb_substr($line, 0, $length, $env->getCharset()) . $separator;
                $line = mb_substr($line, $length, 2048, $env->getCharset());
            }
            if (mb_strlen($shortenedLine) > 0) {
                $line = $shortenedLine . $line;
            }

            $shortenedLines[] = $line;
        }

        return implode("\n", $shortenedLines);
    }

    public function getFilters()
    {
        return [
      new Twig_SimpleFilter(
          'linewrap',
          [$this, 'lineWrap'],
          ['needs_environment' => true]
      ),
    ];
    }
}

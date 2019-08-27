<?php

namespace UrlMonitor\Output;

class Console
{
	private $tableCellLen = 28;

	public function logLine($line, $blankLine = false)
	{
		echo $line . "\n";

		if ($blankLine === true) {
			echo "\n";
		}
	}

	public function logCell($line)
	{
		if (is_array($line)) {
			foreach ($line as $text) {
				if (is_float($text)) {
					$text = number_format($text, 6);
				}

				echo str_pad($text, $this->tableCellLen, " ", STR_PAD_LEFT);
				echo "|";
			}
			echo "\n";
			echo str_repeat("-", (count($line) * $this->tableCellLen) + (count($line)));
			echo "\n";
		}
	}
}

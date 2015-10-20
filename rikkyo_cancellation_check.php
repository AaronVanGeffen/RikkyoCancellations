<?php

const CANCELLATIONS_URL = "http://wwwj.rikkyo.ac.jp/kyomubu/cancel/CancelE.aspx";
const COURSE_FILTER = ["AB123", "CD456", "..."]; // your classes here
const COURSE_PATTERN = '/<td class="colc"[^>]+>(?<date>.+?)<\\/td>' .
	'<td class="colc"[^>]+>(?<campus>.+?)<\\/td>' .
	'<td class="colc"[^>]+>(?<period>.+?)<\\/td>' .
	'<td class="colc"[^>]+>(?<code>.+?)<\\/td>' .
	'<td class="coll"[^>]+>\\s*<span id=".+?">(?<course>.+?)<\\/span>\\s*<\\/td>' .
	'<td class="coll"[^>]+>(?<instructor>.+?)<\\/td>/';

$page = file_get_contents(CANCELLATIONS_URL);

if (!preg_match_all(COURSE_PATTERN, $page, $matches, PREG_SET_ORDER))
	return 1;

$printed_header = false;
foreach ($matches as $course)
{
	if (!in_array('--all', $argv) && !in_array($course['code'], COURSE_FILTER))
		continue;

	if (!$printed_header)
	{
		echo "CANCELLED CLASSES:\n";
		$printed_header = true;
	}

	printf("%s   %s   %s   %-20s   %s\n", $course['date'], $course['period'], $course['code'],
		$course['instructor'], strip_tags($course['course']));
}

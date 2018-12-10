<?php

function reduceQuery($res, $query)
{
    $splitted = explode('=', $query);
    $key = $splitted[0];
    $value = $splitted[1];
    echo PHP_EOL;
    echo 'In reduce:';
    echo PHP_EOL;
    var_export($res);

    $res[$key] = $value;

    return $res;
}

function filterNulls($item)
{
    return boolval($item);
}

$opts = getopt('u:', ['url:']);
$url = $opts['u'] ?? $opts['url'] ?? $argv[1] ?? null;

if ($url === null) {
    echo PHP_EOL;
    echo 'You should pass url as short option "-u", long option "--url" or first comman line argument';
    echo PHP_EOL;
    echo PHP_EOL;

    return;
}

$parsed = parse_url($url);

$host = $parsed['host'] ?? '';
$path = $parsed['path'] ?? '';
$queryString = $parsed['query'] ?? '';
$fragment = $parsed['fragment'] ?? '';

$query = array_reduce(explode('&', $queryString), reduceQuery, []);
$parsed['queryString'] = $queryString;
$parsed['query'] = $query;

$extension = explode('.', $path)[1] ?? null;
$parsed['extension'] = $extension;

$resource = explode($host, $url)[1] ?? null;
$parsed['resource'] = $resource;

$splittedHost = explode('.', $host);
$hostPartsCount = count($splittedHost);

if ($hostPartsCount === 4) {
    $subdomain = array_shift($splittedHost);
    $domain = implode('.', $splittedHost);
    array_shift($splittedHost);
    $top_level_domain = implode('.', $splittedHost);
} elseif ($hostPartsCount === 3 && (strlen($splittedHost[1]) > 3 || strlen($splittedHost[2]) > 2)) {
    $subdomain = array_shift($splittedHost);
    $domain = implode('.', $splittedHost);
    $top_level_domain = $splittedHost[1];
} elseif ($hostPartsCount === 3) {
    $subdomain = null;
    $domain = implode('.', $splittedHost);
    array_shift($splittedHost);
    $top_level_domain = implode('.', $splittedHost);
}

$parsed['subdomain'] = $subdomain;
$parsed['domain'] = $domain;
$parsed['top_level_domain'] = $top_level_domain;

$filtered = array_filter($parsed, filterNulls);

echo 'parsed:';
echo PHP_EOL;
print_r($filtered);
echo PHP_EOL;
echo PHP_EOL;

return;
<?php

$path = __DIR__.'/../database/seeders/PlaceSeeder.php';
if (! file_exists($path)) {
    fwrite(STDERR, "Seeder file not found: $path\n");
    exit(2);
}
$content = file_get_contents($path);

// Desired locales
$locales = ['fr', 'en', 'es', 'de', 'zh', 'ar', 'it', 'pt', 'ru', 'hi'];

// Extract $realPlaces block
if (! preg_match('/\$realPlaces\s*=\s*\[(.*?)\n\s*\];/s', $content, $mReal)) {
    fwrite(STDERR, "Could not find $realPlaces block\n");
    exit(2);
}
$realBlock = $mReal[1];

// Find all place names in $realPlaces (first element of each inner array)
preg_match_all("/\[\s*'([^']+)'\s*,/u", $realBlock, $m);
$realNames = array_unique($m[1]);

// Extract $map block
if (! preg_match('/\$map\s*=\s*\[(.*?)\n\s*\];/s', $content, $mMap)) {
    fwrite(STDERR, "Could not find $map block\n");
    exit(2);
}
$mapBlock = $mMap[1];

// Parse map entries: key => [ 'fr' => ..., 'en' => ... ]
$map = [];
if (preg_match_all("/'([^']+)'\s*=>\s*\[(.*?)\](,|\n)/s", $mapBlock, $entries, PREG_SET_ORDER)) {
    foreach ($entries as $e) {
        $key = $e[1];
        $inside = $e[2];
        $found = [];
        if (preg_match_all("/'([a-z]{2})'\s*=>/", $inside, $ls)) {
            $found = $ls[1];
        }
        $map[$key] = array_unique($found);
    }
}

// For each real name, compute missing locales
$results = [];
foreach ($realNames as $name) {
    $present = $map[$name] ?? [];
    $missing = array_values(array_diff($locales, $present));
    if (count($missing) === 0) {
        $results[] = "$name => OK";
    } else {
        $results[] = "$name => missing: ".implode(',', $missing);
    }
}

// Print report
echo "Missing translations report:\n";
echo str_repeat('=', 40)."\n";
foreach ($results as $r) {
    echo $r."\n";
}

// Summary
$missingCount = 0;
foreach ($results as $r) {
    if (strpos($r, 'missing:') !== false) {
        $missingCount++;
    }
}
echo str_repeat('=', 40)."\n";
echo "Places missing any locale: $missingCount / ".count($results)."\n";

return 0;

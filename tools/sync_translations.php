<?php

// Usage: vendor/bin/sail php tools/sync_translations.php

$baseDir = __DIR__.'/..';
$langDir = $baseDir.'/resources/lang';
$source = $langDir.'/en';

$locales = ['fr', 'en', 'es', 'pt', 'it', 'zh', 'ru', 'ar', 'de', 'hi'];
$files = ['messages.php', 'pagination.php', 'passwords.php', 'auth.php', 'auth-ui.php', 'validation.php'];

// Keep a map of which keys exist per locale/file for a final report
$report = [];

foreach ($files as $file) {
    $sourceFile = $source.'/'.$file;
    if (! file_exists($sourceFile)) {
        echo "Source file missing: $file\n";

        continue;
    }
    $en = include $sourceFile;
    if (! is_array($en)) {
        $en = [];
    }

    foreach ($locales as $locale) {
        $localeDir = $langDir.'/'.$locale;
        if (! is_dir($localeDir)) {
            mkdir($localeDir, 0777, true);
            echo "Created dir: $localeDir\n";
        }
        $targetFile = $localeDir.'/'.$file;
        $existing = [];
        if (file_exists($targetFile)) {
            $existing = include $targetFile;
            if (! is_array($existing)) {
                $existing = [];
            }
        }

        // Preserve existing translations: existing keys take precedence
        $merged = $existing + $en;

        // Write back file
        $export = var_export($merged, true);
        $php = "<?php\n\nreturn ".$export.";\n";
        file_put_contents($targetFile, $php);
        $count = count($merged);
        echo "Synced $targetFile (".$count." keys)\n";

        // Save keys for report
        $report[$file][$locale] = array_keys($merged);
    }
}

// Final comparison report: for each file, find the most advanced locale (max keys)
echo "\nTranslation status report:\n";
foreach ($files as $file) {
    if (! isset($report[$file])) {
        continue;
    }
    $counts = array_map('count', $report[$file]);
    arsort($counts);
    $max = reset($counts);
    $topLocales = array_keys($counts, $max, true);
    $topLabel = implode(', ', $topLocales);
    echo "- $file: most complete locale(s): $topLabel ($max keys)\n";

    // For each locale that's behind, list how many keys missing and which ones
    foreach ($report[$file] as $locale => $keys) {
        $missing = array_diff($report[$file][$topLocales[0]], $keys);
        if (count($missing) === 0) {
            continue;
        }
        echo "  - $locale: missing " . count($missing) . " key(s)\n";
        // list missing keys (one per line, indented)
        foreach ($missing as $k) {
            echo "      - $k\n";
        }
    }
}

echo "\nDone.\n";

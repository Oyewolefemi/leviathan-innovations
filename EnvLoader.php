<?php
/**
 * EnvLoader.php
 * Loads environment variables from a .env file into the $_ENV and $_SERVER superglobals.
 * * --- COMPATIBILITY UPDATE ---
 * Re-written to support very old PHP versions that lack modern file() flags.
 */

if (!function_exists('loadEnv')) {
    function loadEnv(string $path) {
        if (!file_exists($path)) {
            throw new \RuntimeException(sprintf('Environment configuration file (%s) not found.', $path));
        }

        // --- REPLACEMENT FOR LINE 13 ---
        // Read all lines from the file
        $raw_lines = file($path);
        
        // Manually filter out empty lines to support old PHP versions
        $lines = array();
        foreach ($raw_lines as $line) {
            if (!empty(trim($line))) {
                $lines[] = $line;
            }
        }
        // --- END REPLACEMENT ---
        
        foreach ($lines as $line) {
            // Skip comments
            if (str_starts_with(trim($line), '#')) {
                continue;
            }

            // Simple key=value parsing
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                // Remove surrounding quotes from values
                if (str_starts_with($value, '"') && str_ends_with($value, '"')) {
                    $value = substr($value, 1, -1);
                }
                
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}
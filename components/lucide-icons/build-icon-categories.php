<?php
/**
 * Build icon-categories.json from lucide-categories-data.txt
 *
 * This script reads the category data file and generates a JSON file
 * containing the reverse mapping: icon name → categories
 */

$dataFile = __DIR__ . '/lucide-categories-data.txt';
$outputFile = __DIR__ . '/icon-categories.json';

if (!file_exists($dataFile)) {
    die("Error: {$dataFile} not found\n");
}

// Category slug mapping
$categoryMap = [
    'accessibility' => 'Accessibility',
    'accounts-access' => 'Accounts & Access',
    'animals' => 'Animals',
    'arrows' => 'Arrows',
    'buildings' => 'Buildings',
    'charts' => 'Charts',
    'communication' => 'Communication',
    'connectivity' => 'Connectivity',
    'cursors' => 'Cursors',
    'design' => 'Design',
    'coding-development' => 'Coding & Development',
    'devices' => 'Devices',
    'emoji' => 'Emoji',
    'file-icons' => 'File Icons',
    'finance' => 'Finance',
    'food-beverage' => 'Food & Beverage',
    'gaming' => 'Gaming',
    'home' => 'Home',
    'layout' => 'Layout',
    'mail' => 'Mail',
    'mathematics' => 'Mathematics',
    'medical' => 'Medical',
    'multimedia' => 'Multimedia',
    'nature' => 'Nature',
    'navigation-maps-and-pois' => 'Navigation Maps and POIs',
    'notification' => 'Notification',
    'people' => 'People',
    'photography' => 'Photography',
    'science' => 'Science',
    'seasons' => 'Seasons',
    'security' => 'Security',
    'shapes' => 'Shapes',
    'shopping' => 'Shopping',
    'social' => 'Social',
    'sports' => 'Sports',
    'sustainability' => 'Sustainability',
    'text-formatting' => 'Text Formatting',
    'time-calendar' => 'Time & Calendar',
    'tools' => 'Tools',
    'transportation' => 'Transportation',
    'travel' => 'Travel',
    'weather' => 'Weather',
];

// Function to convert category display name to slug
function categoryToSlug($name) {
    $slug = strtolower($name);
    $slug = str_replace('&', '', $slug);
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}

// Read and parse the data file
$lines = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$iconToCategories = [];
$categoriesProcessed = 0;
$totalIcons = 0;

foreach ($lines as $line) {
    // Parse line format: "Category Name: icon1, icon2, icon3"
    if (preg_match('/^([^:]+):\s*(.+)$/', $line, $matches)) {
        $categoryName = trim($matches[1]);
        $iconsStr = trim($matches[2]);

        // Convert category name to slug
        $categorySlug = categoryToSlug($categoryName);

        // Verify the slug exists in our mapping
        if (!isset($categoryMap[$categorySlug])) {
            echo "Warning: Unknown category '{$categoryName}' (slug: {$categorySlug})\n";
            continue;
        }

        // Split icons by comma and trim whitespace
        $icons = array_map('trim', explode(',', $iconsStr));

        foreach ($icons as $icon) {
            if (empty($icon))
                continue;

            // Initialize array if first time seeing this icon
            if (!isset($iconToCategories[$icon])) {
                $iconToCategories[$icon] = [];
                $totalIcons++;
            }

            // Add category slug to this icon's categories
            if (!in_array($categorySlug, $iconToCategories[$icon])) {
                $iconToCategories[$icon][] = $categorySlug;
            }
        }

        $categoriesProcessed++;
    }
}

// Build output structure
$output = [
    'categoryMap' => $categoryMap,
    'iconCategories' => $iconToCategories,
];

// Write JSON file with pretty printing
$json = json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
file_put_contents($outputFile, $json);

echo "✓ Generated icon-categories.json\n";
echo "  - Categories: {$categoriesProcessed}\n";
echo "  - Unique icons: {$totalIcons}\n";
echo "  - Total mappings: " . array_sum(array_map('count', $iconToCategories)) . "\n";

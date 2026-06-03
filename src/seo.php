<?php
/**
 * Volt & Velocity (V&V) - SEO Controller
 * Generates dynamic SEO and OpenGraph tags based on selected vehicle
 */

// 1. Set default metadata
$pageTitle = "Volt & Velocity | Premium Electric Vehicles";
$pageDesc = "Volt & Velocity blends raw electric hypercar dynamics with state-of-the-art autonomous capabilities. Redefine luxury with up to 520 miles of range.";
$pageKeywords = "electric vehicles, EV hypercar, luxury electric sedan, electric SUV, Volt and Velocity";
$pageImage = "assets/images/hero_car.png"; // Fallback preview
$canonicalUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// 2. Load inventory data
$jsonPath = __DIR__ . '/inventory.json';
$inventory = [];

if (file_exists($jsonPath)) {
    $jsonData = file_get_contents($jsonPath);
    $inventory = json_decode($jsonData, true) ?: [];
}

// 3. Process URL dynamic route (e.g., index.php?car=aether)
if (isset($_GET['car']) && !empty($_GET['car'])) {
    $carKey = strtolower(trim($_GET['car']));
    
    if (array_key_exists($carKey, $inventory)) {
        $carData = $inventory[$carKey];
        
        // Override tags with vehicle-specific meta details
        if (isset($carData['seo'])) {
            $pageTitle = $carData['seo']['title'];
            $pageDesc = $carData['seo']['description'];
            $pageKeywords = $carData['seo']['keywords'];
        }
        
        if (isset($carData['image'])) {
            $pageImage = $carData['image'];
        }
    }
}

// Helper function to print tags inline
function renderSeoHeaders() {
    global $pageTitle, $pageDesc, $pageKeywords, $pageImage, $canonicalUrl;
    
    echo "<!-- Dynamic SEO Metadata by V&V Backend -->\n";
    echo "    <title>" . htmlspecialchars($pageTitle) . "</title>\n";
    echo "    <meta name=\"description\" content=\"" . htmlspecialchars($pageDesc) . "\">\n";
    echo "    <meta name=\"keywords\" content=\"" . htmlspecialchars($pageKeywords) . "\">\n";
    echo "    <link rel=\"canonical\" href=\"" . htmlspecialchars($canonicalUrl) . "\">\n";
    
    echo "    <!-- OpenGraph Metadata (Social Media Previews) -->\n";
    echo "    <meta property=\"og:title\" content=\"" . htmlspecialchars($pageTitle) . "\">\n";
    echo "    <meta property=\"og:description\" content=\"" . htmlspecialchars($pageDesc) . "\">\n";
    echo "    <meta property=\"og:image\" content=\"" . htmlspecialchars($pageImage) . "\">\n";
    echo "    <meta property=\"og:url\" content=\"" . htmlspecialchars($canonicalUrl) . "\">\n";
    echo "    <meta property=\"og:type\" content=\"website\">\n";
    
    echo "    <!-- Twitter Card Metadata -->\n";
    echo "    <meta name=\"twitter:card\" content=\"summary_large_image\">\n";
    echo "    <meta name=\"twitter:title\" content=\"" . htmlspecialchars($pageTitle) . "\">\n";
    echo "    <meta name=\"twitter:description\" content=\"" . htmlspecialchars($pageDesc) . "\">\n";
    echo "    <meta name=\"twitter:image\" content=\"" . htmlspecialchars($pageImage) . "\">\n";
}
?>

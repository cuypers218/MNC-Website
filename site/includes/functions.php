<?php
/**
 * My Nest Chapter — Utility Functions
 * Helpers used across the entire site
 */

require_once __DIR__ . '/db.php';

/**
 * Sanitize output for HTML (prevent XSS)
 */
function esc($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Generate a URL-friendly slug from a title
 */
function slugify($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

/**
 * Format a price for display
 */
function formatPrice($price) {
    if ($price == 0) return 'FREE';
    return '$' . number_format($price, 2);
}

/**
 * Get all active products, optionally filtered by category
 */
function getProducts($category = null) {
    $db = getDB();
    
    if ($category && $category !== 'all') {
        $stmt = $db->prepare('SELECT * FROM products WHERE status = "active" AND category = ? ORDER BY sort_order, title');
        $stmt->execute([$category]);
    } else {
        $stmt = $db->query('SELECT * FROM products WHERE status = "active" ORDER BY sort_order, title');
    }
    
    return $stmt->fetchAll();
}

/**
 * Get a single product by slug
 */
function getProductBySlug($slug) {
    $db = getDB();
    $stmt = $db->prepare('SELECT * FROM products WHERE slug = ? AND status IN ("active", "coming_soon")');
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

/**
 * Get the most recent published blog posts
 */
function getRecentPosts($limit = 3) {
    $db = getDB();
    $stmt = $db->prepare('
        SELECT id, title, slug, excerpt, featured_image, category, published_at 
        FROM blog_posts 
        WHERE status = "published" 
        ORDER BY published_at DESC 
        LIMIT ?
    ');
    $stmt->execute([$limit]);
    return $stmt->fetchAll();
}

/**
 * Get a single blog post by slug
 */
function getPostBySlug($slug) {
    $db = getDB();
    $stmt = $db->prepare('SELECT * FROM blog_posts WHERE slug = ? AND status = "published"');
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

/**
 * Get all free products (for freebies page and dashboard defaults)
 */
function getFreeProducts() {
    $db = getDB();
    return $db->query('SELECT * FROM products WHERE price = 0 AND status = "active" ORDER BY sort_order, title')->fetchAll();
}

/**
 * Get featured products for homepage
 */
function getFeaturedProducts($limit = 3) {
    $db = getDB();
    $stmt = $db->prepare('SELECT * FROM products WHERE status = "active" ORDER BY sort_order LIMIT ?');
    $stmt->execute([$limit]);
    return $stmt->fetchAll();
}

/**
 * Format a date for display
 */
function formatDate($date) {
    return date('F j, Y', strtotime($date));
}

/**
 * Truncate text to a word limit
 */
function truncateWords($text, $limit = 30) {
    $words = explode(' ', strip_tags($text));
    if (count($words) <= $limit) return $text;
    return implode(' ', array_slice($words, 0, $limit)) . '...';
}

/**
 * Get the current page slug for active nav highlighting
 */
function currentPage() {
    $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    if ($path === '') return 'home';
    return explode('/', $path)[0];
}

/**
 * Check if we're on a specific page (for nav active state)
 */
function isPage($page) {
    return currentPage() === $page ? 'active' : '';
}

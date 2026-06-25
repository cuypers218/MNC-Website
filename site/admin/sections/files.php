<?php
$baseDir  = __DIR__ . '/../../downloads/';
$baseUrl  = '/downloads/';

$folders = [
    'products'  => $baseDir . 'products/',
    'freebies'  => $baseDir . 'freebies/',
    'exclusive' => $baseDir . 'exclusive/',
];

// Auto-create subfolders if they don't exist
foreach ($folders as $key => $path) {
    if (!is_dir($path)) {
        @mkdir($path, 0755, true);
    }
}

function listFolderFiles($dir) {
    if (!is_dir($dir)) return [];
    $files = [];
    foreach (scandir($dir) as $f) {
        if ($f === '.' || $f === '..' || $f === '.htaccess' || $f === '.gitkeep') continue;
        $fp = $dir . $f;
        if (is_file($fp)) {
            $files[] = [
                'name'     => $f,
                'size'     => filesize($fp),
                'modified' => filemtime($fp),
            ];
        }
    }
    usort($files, function($a, $b) { return $b['modified'] - $a['modified']; });
    return $files;
}

function formatBytes($bytes) {
    if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
    if ($bytes >= 1024)    return round($bytes / 1024, 1) . ' KB';
    return $bytes . ' B';
}

$folderLabels = ['products' => 'Products', 'freebies' => 'Freebies', 'exclusive' => 'Exclusive (Member Drip)'];
?>

<?php foreach ($folders as $key => $path): ?>
    <div class="file-section">
        <div class="file-section-title"><?= $folderLabels[$key] ?></div>
        <?php $files = listFolderFiles($path); ?>
        <?php if (!$files): ?>
            <p style="color:#888;font-size:13px;padding:8px 0;">No files uploaded yet.</p>
        <?php else: ?>
            <?php foreach ($files as $file): ?>
                <div class="file-row">
                    <span class="file-name"><?= esc($file['name']) ?></span>
                    <span class="file-meta"><?= formatBytes($file['size']) ?> &mdash; <?= date('M j, Y', $file['modified']) ?></span>
                    <a href="<?= $baseUrl . $key . '/' . rawurlencode($file['name']) ?>"
                       target="_blank" class="btn btn-ghost btn-sm">View</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<div class="upload-panel">
    <h3>Upload New File</h3>
    <form method="POST" action="/admin/ajax/upload-file.php" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">File (PDF only, max 20 MB)</label>
                <input class="form-control" type="file" name="upload_file" accept=".pdf" required>
            </div>
            <div class="form-group">
                <label class="form-label">Destination Folder</label>
                <select class="form-control" name="folder" required>
                    <option value="products">Products</option>
                    <option value="freebies">Freebies</option>
                    <option value="exclusive">Exclusive</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Filename</label>
            <input class="form-control" type="text" name="filename"
                placeholder="my-file-name.pdf"
                pattern="[a-z0-9\-]+\.pdf"
                title="Lowercase letters, numbers, hyphens, .pdf extension only">
            <p class="form-hint">Lowercase, hyphens only, must end in .pdf. Leave blank to use original filename.</p>
        </div>
        <button type="submit" class="btn btn-primary">Upload File</button>
    </form>
</div>

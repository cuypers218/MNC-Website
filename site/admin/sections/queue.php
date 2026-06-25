<?php
$db    = getDB();
$items = [];
try {
    $items = $db->query("SELECT * FROM exclusive_content_queue ORDER BY sequence_number ASC")->fetchAll();
} catch (Exception $e) {
    // Table may not exist yet; show instructions
}
?>

<div class="callout">
    Each item unlocks for a member based on how many days they have been a member.
    Item 1 unlocks on Day 0 (the day they sign up), Item 2 on Day 30, Item 3 on Day 60, and so on.
    This runs indefinitely — keep adding items so long-term members always have something coming.
</div>

<div class="section-header">
    <span class="section-title">Queue (<?= count($items) ?> items)</span>
    <button class="btn btn-primary" onclick="newQueueItem()">Add Item</button>
</div>

<?php if (!$items && !isset($e)): ?>
    <div class="empty-state">No queue items yet. Add your first exclusive drop above.</div>
<?php elseif (isset($e)): ?>
    <div class="alert alert-error">
        The exclusive_content_queue table does not exist yet.
        Run <code>site/mnc-setup-exclusive.php</code> once on the server to create it, then return here.
    </div>
<?php else: ?>
<div class="table-wrap">
    <table class="admin-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>File</th>
                <th>Unlock Day</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td style="font-family:'Montserrat',Arial,sans-serif;font-weight:800;"><?= (int)$item['sequence_number'] ?></td>
                    <td><?= esc($item['title']) ?></td>
                    <td style="font-size:12px;color:#666;">
                        <?php if (!empty($item['file_path'])): ?>
                            <?= esc($item['file_path']) ?>
                        <?php else: ?>
                            <span class="no-thumb">No File</span>
                        <?php endif; ?>
                    </td>
                    <td>Day <?= (int)$item['unlock_offset_days'] ?></td>
                    <td>
                        <button class="btn btn-sm btn-outline"
                            onclick="editQueueItem(<?= htmlspecialchars(json_encode([
                                'id'                 => $item['id'],
                                'sequence_number'    => $item['sequence_number'],
                                'title'              => $item['title'],
                                'description'        => $item['description'] ?? '',
                                'file_path'          => $item['file_path'] ?? '',
                                'unlock_offset_days' => $item['unlock_offset_days'],
                            ]), ENT_QUOTES) ?>)">
                            Edit
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<!-- QUEUE MODAL -->
<div class="modal-overlay" id="modal-queue">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title">Add Queue Item</span>
            <button class="modal-close" onclick="closeModal('modal-queue')">&times;</button>
        </div>
        <form method="POST" action="/admin/ajax/save-queue-item.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="">

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="q-seq">Sequence Number</label>
                    <input class="form-control" type="number" id="q-seq" name="sequence_number" min="1" required>
                    <p class="form-hint">Determines order — must be unique.</p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="q-offset">Unlock Day Offset</label>
                    <input class="form-control" type="number" id="q-offset" name="unlock_offset_days" min="0" value="0" required>
                    <p class="form-hint">0 = signup day, 30 = 1 month in.</p>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="q-title">Title</label>
                <input class="form-control" type="text" id="q-title" name="title" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="q-desc">Description</label>
                <textarea class="form-control" id="q-desc" name="description" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">PDF Upload</label>
                <input class="form-control" type="file" name="pdf_file" accept=".pdf">
                <p class="form-hint">Saved to /downloads/exclusive/. Leave blank to keep existing.</p>
            </div>

            <div class="form-group">
                <label class="form-label" for="q-filepath">Or: existing file path</label>
                <input class="form-control" type="text" id="q-filepath" name="file_path" placeholder="exclusive-6pm-survival-plan.pdf">
                <p class="form-hint">Only used if no file is uploaded above.</p>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-outline" onclick="closeModal('modal-queue')">Cancel</button>
            </div>
        </form>
    </div>
</div>

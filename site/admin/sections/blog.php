<?php
$db    = getDB();
$posts = $db->query("SELECT id, title, slug, status, published_at, created_at FROM blog_posts ORDER BY created_at DESC")->fetchAll();
?>

<div class="section-header">
    <span class="section-title">All Posts (<?= count($posts) ?>)</span>
    <button class="btn btn-primary" onclick="newPost()">Add Post</button>
</div>

<div class="table-wrap">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Published</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!$posts): ?>
                <tr><td colspan="4" style="text-align:center;color:#888;padding:32px;">No posts yet.</td></tr>
            <?php endif; ?>
            <?php foreach ($posts as $p): ?>
                <tr>
                    <td><?= esc($p['title']) ?></td>
                    <td>
                        <?php if ($p['status'] === 'published'): ?>
                            <span class="badge badge-published">Published</span>
                        <?php else: ?>
                            <span class="badge badge-draft">Draft</span>
                        <?php endif; ?>
                    </td>
                    <td style="color:#666;font-size:13px;">
                        <?= $p['published_at'] ? date('M j, Y', strtotime($p['published_at'])) : '—' ?>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-outline"
                            onclick='editPost(<?= json_encode([
                                "id"      => $p["id"],
                                "title"   => $p["title"],
                                "slug"    => $p["slug"],
                                "excerpt" => "",
                                "body"    => "",
                            ]) ?>)'>
                            Edit
                        </button>
                        <button class="btn btn-sm btn-ghost"
                            onclick="togglePost(<?= (int)$p['id'] ?>, '<?= esc($p['status']) ?>')">
                            <?= $p['status'] === 'published' ? 'Unpublish' : 'Publish' ?>
                        </button>
                        <a href="/blog/<?= esc($p['slug']) ?>" target="_blank" class="btn btn-sm btn-ghost">View</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- BLOG MODAL -->
<div class="modal-overlay" id="modal-blog">
    <div class="modal" style="max-width:720px;">
        <div class="modal-header">
            <span class="modal-title">Add Post</span>
            <button class="modal-close" onclick="closeModal('modal-blog')">&times;</button>
        </div>
        <form method="POST" action="/admin/ajax/save-post.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="">

            <div class="form-group">
                <label class="form-label" for="post-title">Title</label>
                <input class="form-control" type="text" id="post-title" name="title" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="post-slug">URL Slug</label>
                    <input class="form-control" type="text" id="post-slug" name="slug" required>
                    <p class="form-hint">Lowercase, hyphens only, URL-safe</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Social Image</label>
                    <input class="form-control" type="file" name="social_image" accept="image/*">
                    <p class="form-hint">Leave blank to keep existing.</p>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="post-excerpt">Excerpt</label>
                <textarea class="form-control" id="post-excerpt" name="excerpt" rows="2"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="post-body">Body</label>
                <textarea class="form-control" id="post-body" name="body" rows="12" style="min-height:240px;"></textarea>
                <p class="form-hint">HTML is allowed.</p>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" id="post-publish" name="publish_now" value="1">
                    <label for="post-publish">Publish immediately</label>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-outline" onclick="closeModal('modal-blog')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
// Load full post body when editing (separate fetch to avoid huge inline JSON)
function editPost(data) {
    fetch('/admin/ajax/save-post.php?action=get&id=' + data.id)
        .then(function(r) { return r.json(); })
        .then(function(post) {
            var m = document.getElementById('modal-blog');
            m.querySelector('[name="id"]').value      = post.id;
            m.querySelector('[name="title"]').value   = post.title;
            m.querySelector('[name="slug"]').value    = post.slug;
            m.querySelector('[name="excerpt"]').value = post.excerpt || '';
            m.querySelector('[name="body"]').value    = post.body || '';
            m.querySelector('.modal-title').textContent = 'Edit Post';
            m.querySelector('[name="slug"]').dataset.manual = '1';
            openModal('modal-blog');
        })
        .catch(function() {
            var m = document.getElementById('modal-blog');
            m.querySelector('[name="id"]').value      = data.id;
            m.querySelector('[name="title"]').value   = data.title;
            m.querySelector('[name="slug"]').value    = data.slug;
            m.querySelector('[name="excerpt"]').value = '';
            m.querySelector('[name="body"]').value    = '';
            m.querySelector('.modal-title').textContent = 'Edit Post';
            m.querySelector('[name="slug"]').dataset.manual = '1';
            openModal('modal-blog');
        });
}
initSlugField('post-title', 'post-slug');
</script>

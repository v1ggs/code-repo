<?php

namespace Code_Repo;

// First Attached Image as Featured Image
function auto_featured_image($post_id)
{
    // Skip autosaves:
    //  - WordPress autosaves a temporary version every few seconds.
    //  - Running set_post_thumbnail() during an autosave is pointless,
    //    it would assign the thumbnail to a temp draft, not the actual post.
    //  - It may also overwrite the real featured image unintentionally.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Skip revisions:
    //  - Revisions are non-publishable snapshots of content.
    //  - Setting a thumbnail on a revision makes no sense — it won’t be shown,
    //    and it can even throw errors or corrupt data.
    if (wp_is_post_revision($post_id)) {
        return;
    }

    // Skip if featured image alredy exists.
    if (get_post_thumbnail_id($post_id)) {
        return;
    }

    $attachments = get_children([
        'post_parent'    => $post_id,
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'numberposts'    => 1,
        'order'          => 'ASC',
        'orderby'        => 'menu_order ID',
    ]);

    if (!empty($attachments)) {
        $attachment = array_shift($attachments);
        set_post_thumbnail($post_id, $attachment->ID);
    }
}

add_action('save_post', __NAMESPACE__ . '\\auto_featured_image');

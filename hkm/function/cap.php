<?php


/***************** MAP META CAPABILITIES **************** */

add_filter( 'map_meta_cap', 'my_map_meta_cap', 10, 4 );

function my_map_meta_cap( $caps, $cap, $user_id, $args ) {

    // If editing, deleting, or reading a review, get the post and post type object.
    if ( 'edit_review' == $cap || 'delete_review' == $cap || 'read_review' == $cap ) {
        $post = get_post( $args[0] );
        $post_type = get_post_type_object( $post->post_type );

        // Set an empty array for the caps.
        $caps = array();
    }

    //  If editing a review, assign the required capability.
    if ( 'edit_review' == $cap ) {
        if ( $user_id == $post->post_author )
            $caps[] = $post_type->cap->edit_posts;
        else
            $caps[] = $post_type->cap->edit_others_posts;
    }

    // If deleting a review, assign the required capability.
    elseif ( 'delete_review' == $cap ) {
        if ( $user_id == $post->post_author )
            $caps[] = $post_type->cap->delete_posts;
        else
            $caps[] = $post_type->cap->delete_others_posts;
    }

    // If reading a private review, assign the required capability.
    elseif ( 'read_review' == $cap ) {

        if ( 'private' != $post->post_status )
            $caps[] = 'read';
        elseif ( $user_id == $post->post_author )
            $caps[] = 'read';
        else
            $caps[] = $post_type->cap->read_private_posts;
    }

// Return the capabilities required by the user.
    return $caps;
}

?>
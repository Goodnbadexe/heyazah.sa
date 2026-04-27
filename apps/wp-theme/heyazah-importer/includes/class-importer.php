<?php
/**
 * Core importer logic.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Heyazah_Importer {

    public function run() {
        $json_path = HEYAZAH_IMPORTER_DIR . 'data/projects.json';
        if ( ! file_exists( $json_path ) ) {
            return false;
        }

        $json_data = file_get_contents( $json_path );
        $parsed  = json_decode( $json_data, true );

        if ( ! $parsed || empty( $parsed['projects'] ) ) return false;
        $projects = $parsed['projects'];

        foreach ( $projects as $project ) {
            $this->import_project( $project );
        }

        return true;
    }

    private function import_project( $data ) {
        // Find existing to make idempotent
        $args = array(
            'post_type'  => 'project',
            'meta_key'   => '_heyazah_json_slug',
            'meta_value' => $data['slug'],
            'post_status'=> 'any',
            'fields'     => 'ids'
        );
        $existing = get_posts( $args );

        // Handle bilingual name mapping using qTranslate-XT markers
        $name_ar = isset($data['name']['ar']) ? $data['name']['ar'] : '';
        $name_en = isset($data['name']['en']) ? $data['name']['en'] : $data['slug'];
        $post_title = "[:ar]{$name_ar}[:en]{$name_en}[:]";
        
        // Pipeline/New projects must remain visible on the public pipeline page.
        $is_pipeline = ( isset( $data['is_placeholder'] ) && $data['is_placeholder'] ) ||
                       ( isset( $data['status'] ) && $data['status'] === 'new' );

        $post_data = array(
            'post_title'   => wp_strip_all_tags( $post_title ),
            'post_name'    => sanitize_title( $data['slug'] ),
            'post_status'  => 'publish',
            'post_type'    => 'project',
        );

        if ( ! empty( $existing ) ) {
            $post_data['ID'] = $existing[0];
            $post_id = wp_update_post( $post_data );
        } else {
            $post_id = wp_insert_post( $post_data );
        }

        if ( is_wp_error( $post_id ) ) return;

        // Save reference slug
        update_post_meta( $post_id, '_heyazah_json_slug', $data['slug'] );

        // Taxonomies
        if ( isset( $data['status'] ) && is_string( $data['status'] ) ) {
            $status_slug = $data['status'];
            if ( $data['status'] === 'old' ) $status_slug = 'completed';
            elseif ( $data['status'] === 'continuing' ) $status_slug = 'ongoing';
            elseif ( $data['status'] === 'new' ) $status_slug = 'pipeline';
            
            wp_set_object_terms( $post_id, $status_slug, 'project_status' );
        }

        if ( ! empty( $data['type'] ) ) {
            wp_set_object_terms( $post_id, $data['type'], 'project_category' );
        }
        if ( ! empty( $data['sector'] ) ) {
            wp_set_object_terms( $post_id, $data['sector'], 'sector' );
        }

        // ACF and Bilingual Description
        if ( isset( $data['description'] ) ) {
            // Can be extended as needed for specific ACF blocks
            update_field( 'hero_description', $data['description'], $post_id );
            update_post_meta( $post_id, '_heyazah_description', wp_json_encode( $data['description'] ) );
        }

        if ( isset( $data['location'] ) ) {
            update_post_meta( $post_id, '_heyazah_location', wp_json_encode( $data['location'] ) );
            update_field( 'project_location', $this->qt( $data['location']['ar'] ?? '', $data['location']['en'] ?? '' ), $post_id );
        }

        if ( isset( $data['location_short'] ) ) {
            update_post_meta( $post_id, '_heyazah_location_short', wp_json_encode( $data['location_short'] ) );
        }

        if ( isset( $data['metrics'] ) && is_array( $data['metrics'] ) ) {
            update_post_meta( $post_id, '_heyazah_metrics', wp_json_encode( $data['metrics'] ) );
            $metric_field_map = array(
                'total_units'             => 'project_total_units',
                'rental_area_m2'          => 'project_rental_area',
                'parking_spaces'          => 'project_parking_spaces',
                'office_area_m2'          => 'project_office_area',
                'commercial_galleries_m2' => 'project_commercial_galleries',
            );
            foreach ( $metric_field_map as $json_key => $acf_key ) {
                if ( isset( $data['metrics'][ $json_key ] ) && '' !== $data['metrics'][ $json_key ] && null !== $data['metrics'][ $json_key ] ) {
                    update_post_meta( $post_id, $acf_key, $data['metrics'][ $json_key ] );
                    update_field( $acf_key, $data['metrics'][ $json_key ], $post_id );
                }
            }
        }

        if ( isset( $data['media'] ) && is_array( $data['media'] ) ) {
            update_post_meta( $post_id, '_heyazah_media', wp_json_encode( $data['media'] ) );
        }

        if ( isset( $data['map_embed'] ) ) {
            update_post_meta( $post_id, '_heyazah_map_embed', $data['map_embed'] );
        }

        if ( isset( $data['images']['gallery'] ) && is_array( $data['images']['gallery'] ) ) {
            update_post_meta( $post_id, '_heyazah_gallery', wp_json_encode( $data['images']['gallery'] ) );
        }
        
        // Immersive 3D/360 Cloud Embed
        if ( isset( $data['cloud_embed'] ) ) {
            $ce = $data['cloud_embed'];
            update_field('cloud_embed_enabled', isset($ce['enabled']) ? $ce['enabled'] : false, $post_id);
            if (isset($ce['embed_url'])) update_field('cloud_embed_url', $ce['embed_url'], $post_id);
            if (isset($ce['fallback_url'])) update_field('cloud_fallback_url', $ce['fallback_url'], $post_id);
            // $ce['poster_url'] would need to be sideloaded or just saved as URL if text field
            if (isset($ce['poster_url'])) update_field('cloud_embed_poster_url', $ce['poster_url'], $post_id);
        }
        
        if ( isset( $data['project_experience'] ) ) {
            $pe = $data['project_experience'];
            if (isset($pe['default_tab'])) update_field('project_experience_default', $pe['default_tab'], $post_id);
            if (isset($pe['model']['glb_url'])) update_field('project_model_url', $pe['model']['glb_url'], $post_id);
            if (isset($pe['model']['poster_url'])) update_field('project_model_poster_url', $pe['model']['poster_url'], $post_id);
            
            if (isset($pe['tours']) && is_array($pe['tours'])) {
                $tours = array();
                foreach($pe['tours'] as $tour) {
                    $tours[] = array(
                        'title_en' => isset($tour['title_en']) ? $tour['title_en'] : '',
                        'title_ar' => isset($tour['title_ar']) ? $tour['title_ar'] : '',
                        'type'     => isset($tour['type']) ? $tour['type'] : 'iframe',
                        'url'      => isset($tour['url']) ? $tour['url'] : ''
                    );
                }
                update_field('project_360_tours', $tours, $post_id);
            }
        }
        
        // Image Sideloading
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        
        if ( ! empty( $data['images']['hero'] ) && ! has_post_thumbnail( $post_id ) ) {
            $hero_url = $data['images']['hero'];
            $attachment_id = media_sideload_image( $hero_url, $post_id, $post_title, 'id' );
            if ( ! is_wp_error( $attachment_id ) ) {
                set_post_thumbnail( $post_id, $attachment_id );
            } else {
                update_post_meta( $post_id, '_heyazah_needs_upload', $hero_url );
            }
        }

        // Checklist for pipeline
        if ( $is_pipeline && isset($data['fill_in_checklist']) ) {
            $checklist = $data['fill_in_checklist'];
            $missing = is_array($checklist) && isset($checklist['missing_items']) ? $checklist['missing_items'] : $checklist;
            if ( !empty($missing) && is_array($missing) ) {
                update_post_meta( $post_id, '_heyazah_missing_items', wp_json_encode($missing) );
            }
        }
    }

    private function qt( $ar, $en ) {
        $ar = is_string( $ar ) ? $ar : '';
        $en = is_string( $en ) ? $en : '';
        return "[:ar]{$ar}[:en]{$en}[:]";
    }
}

<?php
/**
 * Register the ElggBlog class for the object/blog subtype
 */

if (get_subtype_id('object', 'projects')) {
	update_subtype('object', 'projects', 'ElggProject');
} else {
	add_subtype('object', 'projects', 'ElggProject');
}

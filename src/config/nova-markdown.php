<?php

/**
 * Configuration for nova-markdown
 */

return [

    /**
     * Enable or disable uploads entirely
     */

    'uploads' => env("NOVA_MARKDOWN_UPLOADS", true),

    /**
     * Enable uploads by default.
     * Note, this has no effect up uploads are disabled entirely.
     */

    'uploads-default-enabled' => env("NOVA_MARKDOWN_UPLOADS_DEFAULT_ENABLED", true),

    /**
     * The path prefix that will be used by nova-markdown routes
     */

    'route-prefix' => env("NOVA_MARKDOWN_ROUTE_PREFIX", 'nova-markdown'),

    /**
     * The disk on which to store uploaded images, choose a disk as
     * configured in config/filesystems.php.
     */

    'disk' => env("NOVA_MARKDOWN_DISK", 'public'),

    /**
     * The directory where to place uploaded images within the disk.
     *
     * Can be a string with the directoryname. Alternatively, it's possible
     * to configure a function, which takes the uploading $user as argument and
     * returns the directory. This can be used to group uploads in a folder
     * by user.
     *
     * Example:
     * function($user) { return "uploads/" . \Str::slug($user->name); }
     */

    'directory' => env("NOVA_MARKDOWN_DIRECTORY", "uploads"),

    /**
     * The maximum size for uploaded images in kilobytes
     */

    'max-size' => env("NOVA_MARKDOWN_MAX_SIZE", 8 * 1024),

    /**
     * The maximum width for uploaded images in pixels.
     * Uploaded images will be scaled down to this width.
     * Use null to disable image scaling.
     */

    'max-width' => env("NOVA_MARKDOWN_MAX_WIDTH", 1920),

    /**
     * Uploaded images will be converted to this quality.
     * Integer between 0 and 100. Use null to disable quality adjustments.
     */

    'quality' => env("NOVA_MARKDOWN_QUALITY", 85),

    /**
     * Define the middleware stack to be used by nova-markdown routes.
     * A sensible default has been set.
     */

    'middleware' => config("nova.middleware"),

    /**
     * Uploaded images will be stored by default using a slug version of its
     * original filename. You can set this to true to use a random filename.
     */

    'random_filename' => env("NOVA_MARKDOWN_RANDOM_FILENAME", false),

];

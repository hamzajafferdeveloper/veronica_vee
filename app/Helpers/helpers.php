<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

if (!function_exists('get_initial_helper')) {
    function get_initial_helper($name)
    {
        // Split the name by space
        $parts = explode(' ', trim($name));

        // Take first letter of first name
        $first = isset($parts[0][0]) ? strtoupper($parts[0][0]) : '';

        // Take first letter of last name (if exists)
        $last = isset($parts[1][0]) ? strtoupper($parts[1][0]) : '';

        return $first . $last;
    }
}

if (!function_exists('create_unique_slug')) {

    /**
     * Generate a unique slug for a given table and column.
     *
     * @param string $title
     * @param string $table
     * @param string $column
     * @param int|null $idToIgnore
     * @return string
     */
    function create_unique_slug($title, $table, $column = 'slug', $idToIgnore = null)
    {
        // Convert title to slug
        $slug = Str::slug($title);

        // Initialize counter
        $originalSlug = $slug;
        $counter = 1;

        // Check for existing slugs
        while (
            DB::table($table)
                ->when($idToIgnore, fn($query) => $query->where('id', '!=', $idToIgnore))
                ->where($column, $slug)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }
}

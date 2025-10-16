<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * AnnouncementModel
 * 
 * This model handles all database operations for the announcements table.
 * It extends CodeIgniter's base Model class which provides built-in methods
 * like find(), findAll(), insert(), update(), delete(), etc.
 */
class AnnouncementModel extends Model
{
    // Specify the table name this model interacts with
    protected $table            = 'announcements';
    
    // Specify the primary key column name
    protected $primaryKey       = 'id';
    
    // Set to true to enable automatic INSERT operations
    protected $useAutoIncrement = true;
    
    // Specify the return type for query results
    // 'array' returns data as associative arrays
    // You can also use 'object' to return as objects
    protected $returnType       = 'array';
    
    // Enable soft deletes (if you want to keep deleted records)
    // Set to false since we don't need soft deletes for announcements
    protected $useSoftDeletes   = false;
    
    // Protection: Specify which fields can be inserted/updated
    // This prevents mass assignment vulnerabilities
    protected $allowedFields    = ['title', 'content', 'created_at'];
    
    // Skip validation for now (you can add validation rules later if needed)
    protected $skipValidation   = false;
    
    // Validation rules for the announcements table
    // These rules ensure data integrity before saving to database
    protected $validationRules = [
        'title'   => 'required|min_length[3]|max_length[255]',  // Title must be 3-255 characters
        'content' => 'required|min_length[10]',                  // Content must be at least 10 characters
    ];
    
    // Custom validation error messages
    protected $validationMessages = [
        'title' => [
            'required'   => 'Announcement title is required.',
            'min_length' => 'Title must be at least 3 characters long.',
            'max_length' => 'Title cannot exceed 255 characters.',
        ],
        'content' => [
            'required'   => 'Announcement content is required.',
            'min_length' => 'Content must be at least 10 characters long.',
        ],
    ];
    
    // Callbacks: Code that runs before/after certain events
    // We'll use beforeInsert to automatically set created_at timestamp
    protected $beforeInsert = ['setCreatedAt'];
    
    /**
     * Callback method to set created_at timestamp before inserting
     * This ensures every announcement has a creation timestamp
     * 
     * @param array $data The data being inserted
     * @return array Modified data with created_at timestamp
     */
    protected function setCreatedAt(array $data)
    {
        // If created_at is not provided, set it to current date and time
        if (!isset($data['data']['created_at'])) {
            $data['data']['created_at'] = date('Y-m-d H:i:s');
        }
        
        return $data;
    }
}

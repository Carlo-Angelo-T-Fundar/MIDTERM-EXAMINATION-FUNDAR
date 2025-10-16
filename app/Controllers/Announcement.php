<?php

namespace App\Controllers;

use App\Models\AnnouncementModel;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * Announcement Controller
 * Handles displaying announcements to all logged-in users
 */
class Announcement extends BaseController
{
    protected $session;
    protected $announcementModel;

    /**
     * Constructor - Initialize session and model
     */
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->announcementModel = new AnnouncementModel();
    }

    /**
     * Index method - Display all announcements
     * 
     * This method fetches all announcements from the database
     * ordered by newest first (created_at DESC) and displays them
     * in the announcements view.
     * 
     * @return mixed The announcements view with data or redirect
     */
    public function index()
    {
        // Check if user is logged in - only logged-in users can view announcements
        if (!$this->session->get('isLoggedIn')) {
            $this->session->setFlashdata('error', 'Please login to view announcements.');
            return redirect()->to(base_url('login'));
        }

        // Fetch all announcements from the database
        // orderBy('created_at', 'DESC') sorts by newest first
        // findAll() retrieves all records from the announcements table
        $announcements = $this->announcementModel
                              ->orderBy('created_at', 'DESC')
                              ->findAll();

        // Prepare data to pass to the view
        $data = [
            'title' => 'Announcements',                    // Page title
            'announcements' => $announcements,             // Array of announcement objects
            'user_name' => $this->session->get('name'),    // Current user's name
            'user_role' => $this->session->get('role')     // Current user's role
        ];

        // Load the announcements view and pass the data
        return view('announcements', $data);
    }
}
